<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Captcha_Controller extends CI_Controller {

	// Load Helper in and Start session.
	function __construct() {
		parent::__construct();
		$this->load->helper('captcha');
		session_start();
	}
// This function show values in view page and check captcha value.
	public function form() {
		if(empty($_POST)){
			$this->captcha_setting();
		}
		else{
			// Case comparing values.
			if (strcasecmp($_SESSION['captchaWord'], $_POST['captcha']) == 0) {
				echo "<script type='text/javascript'> alert('Your form successfully submitted'); </script>";
				$this->captcha_setting();
			} else {
				echo "<script type='text/javascript'> alert('Try Again'); </script>";
				$this->captcha_setting();
			}
		}
	}
// This function generates CAPTCHA image and store in "image folder".
	public function captcha_setting(){
		$values = array(
		'word' => '',
		'word_length' => 8,
		'img_path' => './images/',
		'img_url' => base_url() .'images/',
		'font_path' => base_url() . 'system/fonts/texb.ttf',
		'img_width' => '150',
		'img_height' => 50,
		'expiration' => 3600
		);
		$data = create_captcha($values);
		$_SESSION['captchaWord'] = $data['word'];
		
		// image will store in "$data['image']" index and its send on view page
		$this->load->view('captcha_view', $data);
	}
	// For new image on click refresh button.
	public function captcha_refresh(){
		$values = array(
		'word' => '',
		'word_length' => 8,
		'img_path' => './images/',
		'img_url' => base_url() .'images/',
		'font_path' => base_url() . 'system/fonts/texb.ttf',
		'img_width' => '150',
		'img_height' => 50,
		'expiration' => 3600
		);
		$data = create_captcha($values);
		$_SESSION['captchaWord'] = $data['word'];
		echo $data['image'];
	
	}
	
	function googleAuth()
	{
		$code = $this->input->post('code');
		$this->load->library('GoogleAuthenticator');
		// generates the secret code
		$data['secret'] = $this->googleauthenticator->createSecret();
		
		// generates the QR code for the link the user's phone with the service
		$data['qrCodeUrl'] = $this->googleauthenticator->getQRCodeGoogleUrl('Google', 'Ezystayz', $data['secret']);
		$data['code'] = isset($code) ? $code : 0;
		if($code>0)
		{
			// get the user's phone code and the secret code that was generated, and verify
			$checkResult = $this->googleauthenticator->verifyCode($this->input->post('secret'), $code, 2); // 2 = 2*30sec clock tolerance
			//print_r($checkResult);exit;
			if ($checkResult) {
				$data['success'] = 'OK';
			} else {
				$data['success'] =  'FAILED';
			}
		}
		else{
				$data['success'] = 'please enter code';
		}
		// also, you can get a code to test the service
		//$oneCode = $this->googleauthenticator->getCode($secret);
		
		$this->load->view('QR_code', $data);
		
	}

}
?>