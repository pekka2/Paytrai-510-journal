<?php
class ControllerExtensionPaymentpaytrail510Journal extends Controller {
	private $error = array(); 

	public function index() {
		$data = array();
		$data = array_merge($data,$this->load->language('extension/payment/paytrail_510_journal'));
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {	
			$this->model_setting_setting->editSetting('paytrail_510', $this->request->post, $this->request->post['payment_paytrail_510_journal_store_id']);
			$this->model_setting_setting->editSetting('payment_paytrail_510', $this->request->post, $this->request->post['payment_paytrail_510_journal_store_id']);
			$this->model_setting_setting->editSetting('payment_aktia', $this->request->post, $this->request->post['payment_paytrail_510_journal_store_id']);
			$this->model_setting_setting->editSetting('payment_alandsbanken', $this->request->post, $this->request->post['payment_paytrail_510_journal_store_id']);
			$this->model_setting_setting->editSetting('payment_danske', $this->request->post, $this->request->post['payment_paytrail_510_journal_store_id']);
			$this->model_setting_setting->editSetting('payment_handelsbanken', $this->request->post, $this->request->post['payment_paytrail_510_journal_store_id']);
			$this->model_setting_setting->editSetting('payment_mastercard', $this->request->post, $this->request->post['payment_paytrail_510_journal_store_id']);
			$this->model_setting_setting->editSetting('payment_nordea', $this->request->post, $this->request->post['payment_paytrail_510_journal_store_id']);
			$this->model_setting_setting->editSetting('payment_omasp', $this->request->post, $this->request->post['payment_paytrail_510_journal_store_id']);
			$this->model_setting_setting->editSetting('payment_osuuspankki', $this->request->post, $this->request->post['payment_paytrail_510_journal_store_id']);
			$this->model_setting_setting->editSetting('payment_pivo', $this->request->post, $this->request->post['payment_paytrail_510_journal_store_id']);
			$this->model_setting_setting->editSetting('payment_pop', $this->request->post, $this->request->post['payment_paytrail_510_journal_store_id']);
			$this->model_setting_setting->editSetting('payment_spankki', $this->request->post, $this->request->post['payment_paytrail_510_journal_store_id']);
			$this->model_setting_setting->editSetting('payment_saastopankki', $this->request->post, $this->request->post['payment_paytrail_510_journal_store_id']);
			$this->model_setting_setting->editSetting('payment_visa', $this->request->post, $this->request->post['payment_paytrail_510_journal_store_id']);
			$this->model_setting_setting->editSetting('payment_visa_electron', $this->request->post, $this->request->post['payment_paytrail_510_journal_store_id']);
			$this->model_setting_setting->editSetting('payment_collectorb2c', $this->request->post, $this->request->post['payment_paytrail_510_journal_store_id']);
			$this->model_setting_setting->editSetting('payment_collectorb2b', $this->request->post, $this->request->post['payment_paytrail_510_journal_store_id']);
			$this->session->data['success'] = $this->language->get('text_success');
			//$this->response->redirect($this->url->link('marketplace/extension','user_token=' . $this->session->data['user_token'] . '&type=payment',true));
		}

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

 		if (isset($this->error['merchant'])) {
			$data['error_merchant'] = $this->error['merchant'];
		} else {
			$data['error_merchant'] = '';
		}

 		if (isset($this->error['security'])) {
			$data['error_security'] = $this->error['security'];
		} else {
			$data['error_security'] = '';
		}
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'href'      => $this->url->link('common/dashboard','user_token=' . $this->session->data['user_token'], true),
       		'text'      => $this->language->get('text_home'),
      		'separator' => FALSE
   		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true)
		);

   		$data['breadcrumbs'][] = array(
       		'href'      => $this->url->link('extension/payment/paytrail_510_journal','user_token=' . $this->session->data['user_token'],true),
       		'text'      => $this->language->get('heading_title'),
      		'separator' => ' :: '
   		);
				
		$data['action'] = $this->url->link('extension/payment/paytrail_510_journal','user_token=' . $this->session->data['user_token'],true);
		$data['clear'] = $this->url->link('extension/payment/paytrail_510_journal/clear','user_token=' . $this->session->data['user_token'],true);
		
		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment',true);
		
		if (isset($this->request->post['payment_paytrail_510_journal_merchant'])) {
			$data['payment_paytrail_510_journal_merchant'] = $this->request->post['payment_paytrail_510_journal_merchant'];
		} else {
			$data['payment_paytrail_510_journal_merchant'] = $this->config->get('payment_paytrail_510_journal_merchant');
		}

		if (isset($this->request->post['payment_paytrail_510_journal_security'])) {
			$data['payment_paytrail_510_journal_security'] = $this->request->post['payment_paytrail_510_journal_security'];
		} else {
			$data['payment_paytrail_510_journal_security'] = $this->config->get('payment_paytrail_510_journal_security');
		}
		
		if (isset($this->request->post['payment_paytrail_510_journal_order_status_id'])) {
			$data['payment_paytrail_510_journal_order_status_id'] = $this->request->post['payment_paytrail_510_journal_order_status_id'];
		} else {
			$data['payment_paytrail_510_journal_order_status_id'] = $this->config->get('payment_paytrail_510_journal_order_status_id'); 
		} 
		
		if (isset($this->request->post['payment_paytrail_510_journal_order_cancel_status_id'])) {
			$data['payment_paytrail_510_journal_order_cancel_status_id'] = $this->request->post['payment_paytrail_510_journal_order_cancel_status_id'];
		} else {
			$data['payment_paytrail_510_journal_order_cancel_status_id'] = $this->config->get('payment_paytrail_510_journal_order_cancel_status_id'); 
		} 
		
		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();			

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['payment_paytrail_510_journal_geo_zone_id'])) {
			$data['payment_paytrail_510_journal_geo_zone_id'] = $this->request->post['payment_paytrail_510_journal_geo_zone_id'];
		} else {
			$data['payment_paytrail_510_journal_geo_zone_id'] = $this->config->get('payment_paytrail_510_journal_geo_zone_id'); 
		} 
		
		if (isset($this->request->post['paytrail_510_status'])) {
			$data['paytrail_510_status'] = $this->request->post['paytrail_510_status'];
		} else {
			$data['paytrail_510_status'] = $this->config->get('paytrail_510_status');
		}
		
		if (isset($this->request->post['payment_paytrail_510_journal_sandbox'])) {
			$data['payment_paytrail_510_journal_sandbox'] = $this->request->post['payment_paytrail_510_journal_sandbox'];
		} else {
			$data['payment_paytrail_510_journal_sandbox'] = $this->config->get('payment_paytrail_510_journal_sandbox');
		}
		
		if (isset($this->request->post['payment_paytrail_510_journal_text'])) {
			$data['payment_paytrail_510_journal_text'] = $this->request->post['payment_paytrail_510_journal_text'];
		} else {
			$data['payment_paytrail_510_journal_text'] = $this->config->get('payment_paytrail_510_journal_text');
		}
         // Payment details

		if (isset($this->request->post['payment_aktia_status'])) {
			$data['payment_aktia_status'] = $this->request->post['payment_aktia_status'];
		} else {
			$data['payment_aktia_status'] = $this->config->get('payment_aktia_status');
		}

		if (isset($this->request->post['payment_alandsbanken_status'])) {
			$data['payment_alandsbanken_status'] = $this->request->post['payment_alandsbanken_status'];
		} else {
			$data['payment_alandsbanken_status'] = $this->config->get('payment_alandsbanken_status');
		}

		if (isset($this->request->post['payment_handelsbanken_status'])) {
			$data['payment_handelsbanken_status'] = $this->request->post['payment_handelsbanken_status'];
		} else {
			$data['payment_handelsbanken_status'] = $this->config->get('payment_handelsbanken_status');
		}

		if (isset($this->request->post['payment_danske_status'])) {
			$data['payment_danske_status'] = $this->request->post['payment_danske_status'];
		} else {
			$data['payment_danske_status'] = $this->config->get('payment_danske_status');
		}

		if (isset($this->request->post['payment_mastercard_status'])) {
			$data['payment_mastercard_status'] = $this->request->post['payment_mastercard_status'];
		} else {
			$data['payment_mastercard_status'] = $this->config->get('payment_mastercard_status');
		}

		if (isset($this->request->post['payment_nordea_status'])) {
			$data['payment_nordea_status'] = $this->request->post['payment_nordea_status'];
		} else {
			$data['payment_nordea_status'] = $this->config->get('payment_nordea_status');
		}

		if (isset($this->request->post['payment_omasp_status'])) {
			$data['payment_omasp_status'] = $this->request->post['payment_omasp_status'];
		} else {
			$data['payment_omasp_status'] = $this->config->get('payment_omasp_status');
		}
		
		if (isset($this->request->post['payment_osuuspankki_status'])) {
			$data['payment_osuuspankki_status'] = $this->request->post['payment_osuuspankki_status'];
		} else {
			$data['payment_osuuspankki_status'] = $this->config->get('payment_osuuspankki_status');
		}

		if (isset($this->request->post['payment_pivo_status'])) {
			$data['payment_pivo_status'] = $this->request->post['payment_pivo_status'];
		} else {
			$data['payment_pivo_status'] = $this->config->get('payment_pivo_status');
		}

		if (isset($this->request->post['payment_pop_status'])) {
			$data['payment_pop_status'] = $this->request->post['payment_pop_status'];
		} else {
			$data['payment_pop_status'] = $this->config->get('payment_pop_status');
		}

		if (isset($this->request->post['payment_spankki_status'])) {
			$data['payment_spankki_status'] = $this->request->post['payment_spankki_status'];
		} else {
			$data['payment_spankki_status'] = $this->config->get('payment_spankki_status');
		}

		if (isset($this->request->post['payment_saastopankki_status'])) {
			$data['payment_saastopankki_status'] = $this->request->post['payment_saastopankki_status'];
		} else {
			$data['payment_saastopankki_status'] = $this->config->get('payment_saastopankki_status');
		}

		if (isset($this->request->post['payment_visa_status'])) {
			$data['payment_visa_status'] = $this->request->post['payment_visa_status'];
		} else {
			$data['payment_visa_status'] = $this->config->get('payment_visa_status');
		}

		if (isset($this->request->post['payment_visa_electron_status'])) {
			$data['payment_visa_electron_status'] = $this->request->post['payment_visa_electron_status'];
		} else {
			$data['payment_visa_electron_status'] = $this->config->get('payment_visa_electron_status');
		}

		if (isset($this->request->post['payment_collectorb2c_status'])) {
			$data['payment_collectorb2c_status'] = $this->request->post['payment_collectorb2c_status'];
		} else {
			$data['payment_collectorb2c_status'] = $this->config->get('payment_collectorb2c_status');
		}

		if (isset($this->request->post['payment_collectorb2b_status'])) {
			$data['payment_collectorb2b_status'] = $this->request->post['payment_collectorb2b_status'];
		} else {
			$data['payment_collectorb2b_status'] = $this->config->get('payment_collectorb2b_status');
		}

		if (isset($this->request->post['payment_aktia_sort_order'])) {
			$data['payment_aktia_sort_order'] = $this->request->post['payment_aktia_sort_order'];
		} else {
			$data['payment_aktia_sort_order'] = $this->config->get('payment_aktia_sort_order');
		}
		if (isset($this->request->post['payment_alandsbanken_sort_order'])) {
			$data['payment_alandsbanken_sort_order'] = $this->request->post['payment_alandsbanken_sort_order'];
		} else {
			$data['payment_alandsbanken_sort_order'] = $this->config->get('payment_alandsbanken_sort_order');
		}

		if (isset($this->request->post['payment_handelsbanken_sort_order'])) {
			$data['payment_handelsbanken_sort_order'] = $this->request->post['payment_handelsbanken_sort_order'];
		} else {
			$data['payment_handelsbanken_sort_order'] = $this->config->get('payment_handelsbanken_sort_order');
		}

		if (isset($this->request->post['payment_danske_sort_order'])) {
			$data['payment_danske_sort_order'] = $this->request->post['payment_danske_sort_order'];
		} else {
			$data['payment_danske_sort_order'] = $this->config->get('payment_danske_sort_order');
		}

		if (isset($this->request->post['payment_mastercard_sort_order'])) {
			$data['payment_mastercard_sort_order'] = $this->request->post['payment_mastercard_sort_order'];
		} else {
			$data['payment_mastercard_sort_order'] = $this->config->get('payment_mastercard_sort_order');
		}

		if (isset($this->request->post['payment_nordea_sort_order'])) {
			$data['payment_nordea_sort_order'] = $this->request->post['payment_nordea_sort_order'];
		} else {
			$data['payment_nordea_sort_order'] = $this->config->get('payment_nordea_sort_order');
		}

		if (isset($this->request->post['payment_omasp_sort_order'])) {
			$data['payment_omasp_sort_order'] = $this->request->post['payment_omasp_sort_order'];
		} else {
			$data['payment_omasp_sort_order'] = $this->config->get('payment_omasp_sort_order');
		}
		
		if (isset($this->request->post['payment_osuuspankki_sort_order'])) {
			$data['payment_osuuspankki_sort_order'] = $this->request->post['payment_osuuspankki_sort_order'];
		} else {
			$data['payment_osuuspankki_sort_order'] = $this->config->get('payment_osuuspankki_sort_order');
		}

		if (isset($this->request->post['payment_pivo_sort_order'])) {
			$data['payment_pivo_sort_order'] = $this->request->post['payment_pivo_sort_order'];
		} else {
			$data['payment_pivo_sort_order'] = $this->config->get('payment_pivo_sort_order');
		}

		if (isset($this->request->post['payment_pop_sort_order'])) {
			$data['payment_pop_sort_order'] = $this->request->post['payment_pop_sort_order'];
		} else {
			$data['payment_pop_sort_order'] = $this->config->get('payment_pop_sort_order');
		}

		if (isset($this->request->post['payment_spankki_sort_order'])) {
			$data['payment_spankki_sort_order'] = $this->request->post['payment_spankki_sort_order'];
		} else {
			$data['payment_spankki_sort_order'] = $this->config->get('payment_spankki_sort_order');
		}

		if (isset($this->request->post['payment_saastopankki_sort_order'])) {
			$data['payment_saastopankki_sort_order'] = $this->request->post['payment_saastopankki_sort_order'];
		} else {
			$data['payment_saastopankki_sort_order'] = $this->config->get('payment_saastopankki_sort_order');
		}

		if (isset($this->request->post['payment_visa_sort_order'])) {
			$data['payment_visa_sort_order'] = $this->request->post['payment_visa_sort_order'];
		} else {
			$data['payment_visa_sort_order'] = $this->config->get('payment_visa_sort_order');
		}

		if (isset($this->request->post['payment_visa_electron_sort_order'])) {
			$data['payment_visa_electron_sort_order'] = $this->request->post['payment_visa_electron_sort_order'];
		} else {
			$data['payment_visa_electron_sort_order'] = $this->config->get('payment_visa_electron_sort_order');
		}

		if (isset($this->request->post['payment_collectorb2c_sort_order'])) {
			$data['payment_collectorb2c_sort_order'] = $this->request->post['payment_collectorb2c_sort_order'];
		} else {
			$data['payment_collectorb2c_sort_order'] = $this->config->get('payment_collectorb2c_sort_order');
		}

		if (isset($this->request->post['payment_collectorb2b_sort_order'])) {
			$data['payment_collectorb2b_sort_order'] = $this->request->post['payment_collectorb2b_sort_order'];
		} else {
			$data['payment_collectorb2b_sort_order'] = $this->config->get('payment_collectorb2b_sort_order');
		}

		$this->load->model('setting/store');

		$data['stores'] = array();
		
		$data['stores'][] = array(
			'store_id' => 0,
			'name'     => $this->language->get('text_default')
		);
		
		$stores = $this->model_setting_store->getStores();

		foreach ($stores as $store) {
			$data['stores'][] = array(
				'store_id' => $store['store_id'],
				'name'     => $store['name']
			);
		}


		$this->load->model('tool/image');
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		$data['images'] = HTTP_CATALOG . 'image/';

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		$file = DIR_LOGS . 'paytrail-510-journal.log';

		if (file_exists($file)) {
			$data['log'] = file_get_contents($file, FILE_USE_INCLUDE_PATH, null);
		} else {
			$data['log'] = '';
		}
		$file2 = DIR_LOGS . 'paytrail-510-journal-failed.log';

		if (file_exists($file2)) {
			$data['failed_log'] = file_get_contents($file2, FILE_USE_INCLUDE_PATH, null);
		} else {
			$data['failed_log'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/payment/paytrail_510_journal', $data));
	}

	public function clear() {
		$this->language->load('extension/payment/paytrail_510_journal');

		$file = DIR_LOGS . 'paytrail-510-journal.log';
		$file2 = DIR_LOGS . 'paytrail-510-journal-failed.log';
        if (file_exists($file) && $this->validateClear()) {
		   $handle = fopen($file, 'w+'); 

	    	fclose($handle); 			

		    $this->session->data['success'] = $this->language->get('text_clear_success');
	   }

        if (file_exists($file2) && $this->validateClear()) {
		   $handle2 = fopen($file2, 'w+'); 

	    	fclose($handle2); 			

		    $this->session->data['success'] = $this->language->get('text_clear_success');
	   }

		$this->response->redirect($this->url->link('extension/payment/paytrail_510_journal', 'user_token=' . $this->session->data['user_token'], true));		
	}

	protected function validateClear() {
		if (!$this->user->hasPermission('modify', 'extension/payment/paytrail_510_journal')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/paytrail_510_journal')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['payment_paytrail_510_journal_sandbox'])  {
		    if (!$this->request->post['payment_paytrail_510_journal_merchant']) {
			   $this->error['merchant'] = $this->language->get('error_merchant');
		   }

		   if (!$this->request->post['payment_paytrail_510_journal_security']) {
			  $this->error['security'] = $this->language->get('error_security');
		   }
		}

		return !$this->error;
	}

	public function install(){

       $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`, `code`, `key`, `value`, `serialized`) VALUES
       (0, 'payment_aktia', 'payment_aktia_status', '1', 0),
       (0, 'payment_alandsbanken', 'payment_alandsbanken_status', '1', 0),
       (0, 'payment_danske', 'payment_danske_status', '1', 0),
       (0, 'payment_handelsbanken', 'payment_handelsbanken_status', '1', 0),
       (0, 'payment_nordea', 'payment_nordea_status', '1', 0),
       (0, 'payment_omasp', 'payment_omasp_status', '1', 0),
       (0, 'payment_osuuspankki', 'payment_osuuspankki_status', '1', 0),
       (0, 'payment_pivo', 'payment_pivo_status', '1', 0),
       (0, 'payment_pop', 'payment_pop_status', '1', 0),
       (0, 'payment_spankki', 'payment_spankki_status', '1', 0),
       (0, 'payment_saastopankki', 'payment_saastopankki_status', '1', 0),
       (0, 'payment_mastercard', 'payment_mastercard_status', '0', 0),
       (0, 'payment_visa', 'payment_visa_status', '0', 0),
       (0, 'payment_visa_electron', 'payment_visa_electron_status', '0', 0),
       (0, 'payment_collectorb2c', 'payment_collectorb2c_status', '0', 0),
       (0, 'payment_collectorb2b', 'payment_collectorb2b_status', '0', 0),

       (0, 'payment_osuuspankki', 'payment_osuuspankki_sort_order', '3', 0),
       (0, 'payment_nordea', 'payment_nordea_sort_order', '4', 0),
       (0, 'payment_danske', 'payment_danske_sort_order', '5', 0),
       (0, 'payment_handelsbanken', 'payment_handelsbanken_sort_order', '6', 0),
       (0, 'payment_alandsbanken', 'payment_alandsbanken_sort_order', '7', 0),
       (0, 'payment_saastopankki', 'payment_saastopankki_sort_order', '8', 0),
       (0, 'payment_aktia', 'payment_aktia_sort_order', '9', 0),
       (0, 'payment_pivo', 'payment_pivo_sort_order', '10', 0),
       (0, 'payment_pop', 'payment_pop_sort_order', '11', 0),
       (0, 'payment_spankki', 'payment_spankki_sort_order', '12', 0),
       (0, 'payment_omasp', 'payment_omasp_sort_order', '13', 0),
       (0, 'payment_mastercard', 'payment_mastercard_sort_order', '14', 0),
       (0, 'payment_visa', 'payment_visa_sort_order', '15', 0),
       (0, 'payment_visa_electron', 'payment_visa_electron_sort_order', '16', 0),
       (0, 'payment_collectorb2c', 'payment_collectorb2c_sort_order', '17', 0),
       (0, 'payment_collectorb2b', 'payment_collectorb2b_sort_order', '18', 0)");

       $this->db->query("INSERT INTO `" . DB_PREFIX . "extension` (`type`, `code`) VALUES
       ('payment', 'aktia'),
       ('payment', 'alandsbanken'),
       ('payment', 'danske'),
       ('payment', 'handelsbanken'),
       ('payment', 'mastercard'),
       ('payment', 'nordea'),
       ('payment', 'omasp'),
       ('payment', 'osuuspankki'),
       ('payment', 'pivo'),
       ('payment', 'pop'),
       ('payment', 'spankki'),
       ('payment', 'saastopankki'),
       ('payment', 'visa'),
       ('payment', 'visa_electron'),
       ('payment', 'collectorb2c'),
       ('payment', 'collectorb2b')");

	}

	public function uninstall(){

       $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'paytrail_510'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'payment_paytrail_510_journal'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'payment_aktia'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'payment_alandsbanken'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'payment_danske'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'payment_handelsbanken'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'payment_mastercard'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'payment_nordea'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'payment_omasp'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'payment_osuuspankki'"); 
       $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'payment_pivo'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'payment_pop'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'payment_spankki'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'payment_saastopankki'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'payment_visa'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'payment_visa_electron'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'payment_collectorb2c'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'payment_collectorb2b'");


       $this->db->query("DELETE FROM `" . DB_PREFIX . "extension` WHERE `code` = 'paytrail_510'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "extension` WHERE `code` = 'paytrail_510_journal'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "extension` WHERE `code` = 'aktia'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "extension` WHERE `code` = 'alandsbanken'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "extension` WHERE `code` = 'danske'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "extension` WHERE `code` = 'handelsbanken'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "extension` WHERE `code` = 'mastercard'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "extension` WHERE `code` = 'nordea'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "extension` WHERE `code` = 'omasp'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "extension` WHERE `code` = 'osuuspankki'"); 
       $this->db->query("DELETE FROM `" . DB_PREFIX . "extension` WHERE `code` = 'pivo'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "extension` WHERE `code` = 'pop'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "extension` WHERE `code` = 'spankki'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "extension` WHERE `code` = 'saastopankki'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "extension` WHERE `code` = 'visa'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "extension` WHERE `code` = 'visa_electron'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "extension` WHERE `code` = 'collectorb2c'");
       $this->db->query("DELETE FROM `" . DB_PREFIX . "extension` WHERE `code` = 'ollectorb2b'");

    }
}
?>
