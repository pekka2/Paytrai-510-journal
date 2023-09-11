<?php
class ControllerExtensionPaymentAlandsbanken extends Controller {
	public function index() {

		$this->load->language('extension/payment/paytrail_510_journal');

        $data['postcode'] = '';

        if(isset($this->session->data['payment_method']['postcode']) && $this->session->data['payment_method']['postcode'] !='') {
           $data['postcode'] = $this->session->data['payment_method']['postcode'];
        }
		return $this->load->view('extension/payment/paytrail_510_journal', $data);
	}

}
?>
