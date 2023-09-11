<?php 
class ModelExtensionPaymentCollectorB2B extends Model {
  	public function getMethod($address, $total) {
		$this->load->language('extension/payment/paytrail_510_jounal');
		if ($this->config->get('paytrail_510_status') && $this->config->get('payment_collectorb2b_status')) {
      		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('payment_paytrail_510_journal_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");
			
			if (!$this->config->get('payment_paytrail_510_journal_geo_zone_id')) {
        		$status = true;
      		} elseif ($query->num_rows) {
      		  	$status = true;
      		} else {
     	  		$status = false;
			   }	
    } else {
			     $status = false;
	  }
	
		$method_data = array();
    
	
		if ($status) {  
      		$method_data = array( 
        		    'code'       => 'collectorb2b',
                'title'      => $this->language->get('text_walley_yrityslasku'),
				        'terms'      => '',
				        'sort_order' => $this->config->get('payment_collectorb2b_sort_order')
      		);
    	}

    	return $method_data;
  	}
}
?>