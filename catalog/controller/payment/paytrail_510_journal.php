<?php

class ControllerPaymentPaytrail510Journal extends Controller {
	
  private $paytrail_merchant = false;
  private $paytrail_secret = '';

  public function paytrail(){

        if($this->config->get('payment_paytrail_510_journal_sandbox')){
           $this->paytrail_merchant = 375917;
           $this->paytrail_secret = 'SAIPPUAKAUPPIAS';
        } else {
            $this->paytrail_merchant = trim($this->config->get('payment_paytrail_510_journal_merchant'));
            $this->paytrail_secret = trim($this->config->get('payment_paytrail_510_journal_security'));
        }

    $this->load->model('checkout/order');

    $json = array();
    $error = array();

    $json = $this->session->data;
    $jsons = '';

    if( isset($this->session->data['order_id']) ){
        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

      if( $this->request->get['method'] && (isset($order_info['email']) && $order_info['email'] !='') && 
                                           (isset($order_info['telephone']) && $order_info['telephone'] !='') && 
                                           (isset($order_info['payment_code']) && $order_info['payment_code'] !='') && 
                                           (isset($order_info['payment_firstname']) && $order_info['payment_firstname'] !='') && 
                                           (isset($order_info['payment_lastname']) && $order_info['payment_lastname'] !='') && 
                                           (isset($order_info['payment_postcode']) && $order_info['payment_postcode'] !='') && 
                                           (isset($order_info['payment_address_1']) && $order_info['payment_address_1'] !='') && 
                                           (isset($order_info['payment_city']) && $order_info['payment_city'] !='')){

          $checked = $this->getBody();

          if(isset($checked['error'])){
            $jsons = "<pre>";
            $jsons .= $checked['error'];
            $jsons .= "</pre>";

               $string =  $checked['error'];
               $logs = new Log('paytrail-510-journal-failed.log');
               $logs->write($string);
          }

           if($jsons){
             $error = $jsons;
           }

         if(!$error){
           $name = '';

          if($this->request->get['method'] == 'visa' || $this->request->get['method'] == 'visa_electron' || $this->request->get['method'] == 'mastercard'){

            if($this->request->get['method'] == 'visa'){
               $name = 'Visa';
            }
            if($this->request->get['method'] == 'mastercard'){
               $name = 'Mastercard';
            }
            if($this->request->get['method'] == 'visa_electron'){
               $name = 'Visa Electron';
            }
          }

           require_once(DIR_SYSTEM . 'library/paytrail_510_journal.php');
           
          $paytrail = new Paytrail510Journal($this->paytrail_merchant,$this->paytrail_secret, $this->getHeader(), $this->getBody());

           $response = $paytrail->send();

           $cof_request_id = $paytrail->getRequestId();

           $payment = json_decode($response);

           $provider = array();
           
           if(isset($payment->providers)){
              $providers = $payment->providers;

              foreach ($providers as $provider){
                  $i = 0;
                if(!$name && $provider->id == $this->request->get['method']){

                  $json = $provider;

                  break;

                } 
                if($name && $provider->name == $name){

                  $json = $provider;

                  break;

                } 
              } 

           } else {
              $error = $response;
           } 
         }
        }
      } 

           if($error){
               $json = $error;
           }

    $this->response->setOutput(json_encode($json));

  }

  public function getHeader() {
        $headers = array(
                         'checkout-account' => $this->paytrail_merchant,
                         'checkout-algorithm' => 'sha256',
                         'checkout-method' => 'POST',
                         'checkout-nonce' => '564635208570151',
                         'checkout-timestamp' => date('Y-m-d\TH:i:s.Z\Z', time()),
                         'content-type' => 'application/json; charset=utf-8',
                         'checkout-transaction-id' => $this->session->data['order_id']
                );
          
            $headers['signature'] = $this->calculateHmac($headers, $this->getBody());
        return $headers;
  }

  public function getBody(){
        $this->load->model('checkout/order');
        $this->load->language('extension/payment/paytrail_510_journal');

        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

        $item = array();

             // Käsittelykult
            if($order_info['total'] > 0) {

                 $item[] = array(
                                      'unitPrice' => (int)round($order_info['total'] * 100,0),
                                      'units' => (int)1,
                                      'vatPercentage' => "25.5",
                                      'productCode' => '#'. $this->session->data['order_id'],
                                      'deliveryDate' => date('Y-m-d')
                 );
            }
        
        $product_total = $this->cart->getTotal();
     
        $error = '';
        $shipping = 0;

            if(isset($this->session->data['shipping_method']['cost'])){
               $shipping = round($this->tax->calculate($this->session->data['shipping_method']['cost'], $this->session->data['shipping_method']['tax_class_id'], $this->config->get('config_tax')),2); 
            }

       $products = round($product_total,2);

        if($products == $order_info['total'] && $shipping > 0){
              $error = $this->language->get('error_order_totals');
        }
        
   
     if(!$error){     
        $body =  json_encode(array(
                    'stamp' =>  '#' . $this->session->data['order_id'] . '_' . date('Y-m-d G:i:s'),
                    'reference' => (string)$this->session->data['order_id'],
                    'amount' => round($order_info['total'] * 100,0),
                    'currency' => 'EUR',
                    'language' => 'FI',
                    'items' => $item,
                    'customer' => array(
                       'email' => $order_info['email'],
                       'firstName' =>  $order_info['firstname'],
                       'lastName' =>  $order_info['lastname'],
                       'phone' =>  $order_info['telephone']
                     ),
                    'deliveryAddress' => array(
                      'streetAddress' => $order_info['shipping_address_1'],
                      'postalCode' => $order_info['shipping_postcode'],
                      'city' => $order_info['shipping_city'],
                      'county' => $order_info['shipping_zone'],
                      'country' => 'FI'
                    ),
                    'invoicingAddress' => array(
                      'streetAddress' => $order_info['payment_address_1'],
                      'postalCode' => $order_info['payment_postcode'],
                      'city' => $order_info['payment_city'],
                      'county' => $order_info['shipping_zone'],
                      'country' => 'FI'
                    ),
                    'redirectUrls' => array(
                       'success' => $this->url->link('payment/paytrail_510_journal/complete'),
                       'cancel' => $this->url->link('payment/paytrail_510_journal/cancel')
                    ),
                    'callbackUrls' => array(
                       'success' => $this->url->link('payment/paytrail_510_journal/complete'),
                       'cancel' => $this->url->link('payment/paytrail_510_journal/cancel')
                    )
              ),
                JSON_UNESCAPED_SLASHES
          );
      } else {
        $body = array( 'error' => $error );
      }
      
        return $body;

  }
    
  protected function calculateHmac($params, $body){
       $includedKeys = array_filter(array_keys($params), function ($key) {
           return  preg_match('/^checkout-/', $key);
       });
        sort($includedKeys, SORT_STRING);
        $hmacPayload = array_map(
            function ($key) use ($params) {
                return join(':', [ $key, $params[$key] ]);
            },
            $includedKeys
        );

        array_push($hmacPayload, $body);

       return hash_hmac('sha256', join("\n", $hmacPayload), $this->paytrail_secret);
    }
    
    public function complete() {
    
      $this->language->load('extension/payment/paytrail_510_journal');
      $this->load->model('checkout/order');

      $amount = trim($this->request->get['checkout-amount']);
      $return_authcode = $this->request->get['signature'];
      $reference = $this->request->get['checkout-reference'];
      $transaction_id = $this->request->get['checkout-transaction-id'];
      $status = $this->request->get['checkout-status'];
      $provider = trim($this->request->get['checkout-provider']);
      $str_len = strlen($return_authcode);

      $order_id = $reference;
  
     if($order_id && $str_len > 20 && $amount > 0 && $status == 'ok'){
            $order_info = $this->model_checkout_order->getOrder($order_id);
    
            $this->db->query("UPDATE `" . DB_PREFIX . "order` SET `payment_method` = '" . $this->language->get('text_title') . " (" . $provider . ")', date_modified = NOW() WHERE order_id = '" . (int)$order_id . "'");

            $this->model_checkout_order->addOrderHistory($order_id, $this->config->get('payment_paytrail_510_journal_order_status_id'));
           
          $string =  'STATUS: ' . $status . ', ' .$this->language->get('text_paid_success') . $provider . '; CHECKOUT TRANSACTION ID: ' . $transaction_id . '; MAKSAJAN PANKKI: ' . $provider . ', ORDER ID: ' . $order_id . '; SUMMA: ' . $amount/100;
          $log = new Log('paytrail-510-journal.log'); 
          $log->write($string);

        $this->response->redirect($this->url->link('checkout/success', true));   
     } elseif($status !='ok'){      
            $this->db->query("UPDATE `" . DB_PREFIX . "order` SET `payment_method` = '" . $this->language->get('text_title') . " (" . $provider . ")', date_modified = NOW() WHERE order_id = '" . (int)$order_id . "'");
            $this->model_checkout_order->addOrderHistory($order_id, $this->config->get('payment_paytrail_510_journal_order_cancel_status_id'));
       
          $string =  'STATUS: ' . $status . ', ' .$this->language->get('text_paid_cancel') . '; CHECKOUT TRANSACTION ID: ' . $transaction_id . '; MAKSAJAN PANKKI: ' . $provider . '; ORDER ID: ' . $order_id . '; SUMMA: ' . $amount/100;

          $log = new Log('paytrail-510-journal.log');
          $log->write($string);
          $log2 = new Log('paytrail-510-journal-failed.log');
          $log2->write($string);
          $this->response->redirect($this->url->link('checkout/cart', true));   
     } 
  }

  public function cancel() {
    
      $this->language->load('extension/payment/paytrail_510_journal');
      $this->load->model('checkout/order');

      $amount = trim($this->request->get['checkout-amount']);
      $return_authcode = $this->request->get['signature'];
      $reference = $this->request->get['checkout-reference'];
      $transaction_id = $this->request->get['checkout-transaction-id'];
      $status = $this->request->get['checkout-status'];
      $provider = trim($this->request->get['checkout-provider']);
      $str_len = strlen($return_authcode);

      $order_id = $reference;
      
     if($order_id && $str_len > 20 && $amount > 0 && $status == 'ok'){
            $order_info = $this->model_checkout_order->getOrder($order_id);
    
            $this->db->query("UPDATE `" . DB_PREFIX . "order` SET `payment_method` = '" . $this->language->get('text_title') . " (" . $provider . ")', date_modified = NOW() WHERE order_id = '" . (int)$order_id . "'");

            $this->model_checkout_order->addOrderHistory($order_id, $this->config->get('payment_paytrail_510_journal_order_status_id'));
           
          $string =  'STATUS: ' . $status . ', ' .$this->language->get('text_paid_success') . $provider . '; CHECKOUT TRANSACTION ID: ' . $transaction_id . '; MAKSAJAN PANKKI: ' . $provider . ', ORDER ID: ' . $order_id . '; SUMMA: ' . $amount/100;
          $log = new Log('paytrail-510-journal.log');
          $log->write($string);

        $this->response->redirect($this->url->link('checkout/success', true));   
     } elseif($status != 'ok') {  
    
            $this->db->query("UPDATE `" . DB_PREFIX . "order` SET `payment_method` = '" . $this->language->get('text_title') . " (" . $provider . ")', date_modified = NOW() WHERE order_id = '" . $order_id . "'");
            $this->model_checkout_order->addOrderHistory($order_id, $this->config->get('payment_paytrail_510_journal_order_cancel_status_id'), "", true);
           
          $string =  'STATUS: ' . $status . ', ' .$this->language->get('text_paid_cancel') . '; CHECKOUT TRANSACTION ID: ' . $transaction_id . '; MAKSAJAN PANKKI: ' . $provider . '; ORDER ID: ' . $order_id . '; SUMMA: ' . $amount/100;

          $log = new Log('paytrail-510-journal.log');
          $log->write($string);
          $log2 = new Log('paytrail-510-journal-failed.log');
          $log2->write($string);

     }
        $this->response->redirect($this->url->link('checkout/failure', true));  
    }
}
?>
