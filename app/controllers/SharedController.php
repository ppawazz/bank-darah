<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * jenis_darah_goldar_option_list Model Action
     * @return array
     */
	function jenis_darah_goldar_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,golongan_darah AS label FROM goldar";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * kultur_ruangan_option_list Model Action
     * @return array
     */
	function kultur_ruangan_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT penerima AS value,penerima AS label FROM penerima ORDER BY penerima";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * transaksi_jenis_id_option_list Model Action
     * @return array
     */
	function transaksi_jenis_id_option_list($lookup_goldar){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT jenis_id AS value,jenis AS label FROM jenis_darah WHERE goldar= ? ORDER BY jenis ASC" ;
		$queryparams = array($lookup_goldar);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * transaksi_menerima_option_list Model Action
     * @return array
     */
	function transaksi_menerima_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,penerima AS label FROM penerima ORDER BY penerima";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * transaksi_memberi_option_list Model Action
     * @return array
     */
	function transaksi_memberi_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,pemberi AS label FROM pemberi";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * transaksi_goldar_option_list Model Action
     * @return array
     */
	function transaksi_goldar_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,golongan_darah AS label FROM goldar ORDER BY golongan_darah ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * transaksi_goldar_option_list_2 Model Action
     * @return array
     */
	function transaksi_goldar_option_list_2(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,golongan_darah AS label FROM goldar";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * transaksi_memberi_option_list_2 Model Action
     * @return array
     */
	function transaksi_memberi_option_list_2(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,pemberi AS label FROM pemberi ORDER BY pemberi";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * perawat_nama_value_exist Model Action
     * @return array
     */
	function perawat_nama_value_exist($val){
		$db = $this->GetModel();
		$db->where("nama", $val);
		$exist = $db->has("perawat");
		return $exist;
	}

	/**
     * detail_labu_petugas_option_list Model Action
     * @return array
     */
	function detail_labu_petugas_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT nama AS value,nama AS label FROM petugas_lab ORDER BY nama ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * detail_labu_perawat_option_list Model Action
     * @return array
     */
	function detail_labu_perawat_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT nama AS value,nama AS label FROM perawat ORDER BY nama ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * detail_labu_id_transaksi_option_list Model Action
     * @return array
     */
	function detail_labu_id_transaksi_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value, concat (nama,' - ',no_kantong,'- PMI ',pmi) AS label FROM transaksi where kondisi = 'Ready' ORDER BY nama";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * user_userid_value_exist Model Action
     * @return array
     */
	function user_userid_value_exist($val){
		$db = $this->GetModel();
		$db->where("userid", $val);
		$exist = $db->has("user");
		return $exist;
	}

	/**
     * user_email_value_exist Model Action
     * @return array
     */
	function user_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("user");
		return $exist;
	}

	/**
     * transaksi_jenis_darahjenis_option_list Model Action
     * @return array
     */
	function transaksi_jenis_darahjenis_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT jenis AS value,jenis AS label FROM jenis_darah ORDER BY jenis_id";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * getcount_prca Model Action
     * @return Value
     */
	function getcount_prca(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'PRC A'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_tca Model Action
     * @return Value
     */
	function getcount_tca(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'TC A'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_ffpa Model Action
     * @return Value
     */
	function getcount_ffpa(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'FFP A'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_wba Model Action
     * @return Value
     */
	function getcount_wba(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'WB A'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_lpa Model Action
     * @return Value
     */
	function getcount_lpa(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'LP A'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_prclda Model Action
     * @return Value
     */
	function getcount_prclda(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'PRC LD A'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_prcab Model Action
     * @return Value
     */
	function getcount_prcab(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'PRC AB'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_tcab Model Action
     * @return Value
     */
	function getcount_tcab(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'TC AB'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_ffpab Model Action
     * @return Value
     */
	function getcount_ffpab(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'FFP AB'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_wbab Model Action
     * @return Value
     */
	function getcount_wbab(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'WB AB'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_lpab Model Action
     * @return Value
     */
	function getcount_lpab(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'LP AB'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_prcldab Model Action
     * @return Value
     */
	function getcount_prcldab(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'PRC LD AB'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_prcb Model Action
     * @return Value
     */
	function getcount_prcb(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'PRC B'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_tcb Model Action
     * @return Value
     */
	function getcount_tcb(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'TC B'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_ffpb Model Action
     * @return Value
     */
	function getcount_ffpb(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'FFP B'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_wbb Model Action
     * @return Value
     */
	function getcount_wbb(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'WB B'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_lpb Model Action
     * @return Value
     */
	function getcount_lpb(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'WB B'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_prcldb Model Action
     * @return Value
     */
	function getcount_prcldb(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'PRC LD B'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_prco Model Action
     * @return Value
     */
	function getcount_prco(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'PRC O'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_tco Model Action
     * @return Value
     */
	function getcount_tco(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'TC O'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_ffpo Model Action
     * @return Value
     */
	function getcount_ffpo(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'FFP O'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_wbo Model Action
     * @return Value
     */
	function getcount_wbo(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'WB O'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_lpo Model Action
     * @return Value
     */
	function getcount_lpo(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'LP O'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_prcldo Model Action
     * @return Value
     */
	function getcount_prcldo(){
		$db = $this->GetModel();
		$sqltext = "Select Sum(pengembalian + dropping + sa - ready - selesai) from rekap_stok
where jenis = 'PRC LD O'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

}
