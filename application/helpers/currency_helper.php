<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('idr')) {
	function idr($angka){
		$jd = number_format($angka, 0, ',', '.');
		return 'Rp. '.$jd;
	}
}