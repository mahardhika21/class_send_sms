<?php

class ZenzivaLib {
	private $user_key;
	private $pass_key;
	private $url;
	private $ci;
	
	
	
	function send_sms($telepon, $message){
		// $userkey = "xxxxxx";
		// $passkey = "xxxxxx";
		// $telepon = "081234567890";
		// $message = "Terima Kasih, pendaftaran atas nama $nama telah.";
		// $url = "https://reguler.zenziva.net/apps/smsapi.php";
		$curlHandle = curl_init();
		curl_setopt($curlHandle, CURLOPT_URL, $this->url);
		curl_setopt($curlHandle, CURLOPT_POSTFIELDS,
		'userkey='.$this->user_key.'&passkey='.$this->pass_key.'&nohp='.$telepon.'&pesan='.urlencode($message));
		curl_setopt($curlHandle, CURLOPT_HEADER, 0);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
		curl_setopt($curlHandle, CURLOPT_POST, 1);
		$results = curl_exec($curlHandle);
		curl_close($curlHandle);
		// $XMLdata = new SimpleXMLElement($results);
		$xml = simplexml_load_string($results);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);
		// $status = $XMLdata->message[0]->text;
		return $array;
	
	}
}
