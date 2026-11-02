<?php 
/**
 * Rekap_item_pemeriksaan Page Controller
 * @category  Controller
 */
class Rekap_item_pemeriksaanController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "rekap_item_pemeriksaan";
	}
}
