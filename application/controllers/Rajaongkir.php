<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rajaongkir extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	
	public function province()
	{
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.rajaongkir.com/starter/province".(empty($this->input->get('id')) ? null : '?id='.$this->input->get('id') ),
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			"key: 04419aca2907b96962780057dbc98f5a"
		  ),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			echo $response;
		}
	}
	public function city()
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" .$this->input->get('province'),
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"key: 04419aca2907b96962780057dbc98f5a"
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		echo "cURL Error #:" . $err;
		} else {
			echo $response;
		}
	}
	public function cost($data)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "origin=501&destination={$data['destination']}&weight={$data['weight']}&courier={$data['courier']}",
		// CURLOPT_POSTFIELDS => "origin=501&destination=114&weight=1700&courier=jne",
		CURLOPT_HTTPHEADER => array(
			"content-type: application/x-www-form-urlencoded",
			"key: 04419aca2907b96962780057dbc98f5a"
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			return "cURL Error #:" . $err;
		} else {
			return $response;
		}
	}
	public function courier()
	{
		return [
			'jne',
			'pos',
			'tiki',
		];
	}
	public function cost_all($get=null){
		$data= [];
		foreach ($this->courier() as $key => $value) {
			$kurir= json_decode(
				$this->cost([
					'destination'=> $get['destination'],
					'weight'=> $get['weight'],
					'courier'=> $value,
				])
			)->rajaongkir->results;

			foreach ($kurir as $key_kurir => $value_kurir) {
				$code= strtoupper( $value_kurir->code );
				foreach ($value_kurir->costs as $key_costs => $value_costs) {
					$service= $value_costs->service;
					foreach ($value_costs->cost as $key_cost => $value_cost) {
						$data[]= [
							'code'=> $code,
							'service'=> $service,
							'etd'=> $value_cost->etd .($code=='POS'? null : ' HARI' ),
							'value'=> $value_cost->value,
						];
					}
				}
			}
		}
		return $data;
	}
	public function courier_html_option()
	{
		$this->load->helper('currency');
		$rows= $this->cost_all([
			'destination'=> $this->input->get('destination'),
			'weight'=> $this->input->get('weight'),
		]);
		$html= "";
		foreach ($rows as $key => $value) {
			$html .= "<option value='{$value["value"]}' kurir='{$value["code"]} {$value["service"]} ({$value["etd"]})' >{$value["code"]} {$value["service"]} ({$value["etd"]}) - ".idr($value['value'])."</option>";
		}
		echo $html;
	}
  
}
