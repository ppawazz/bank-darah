<?php 
/**
 * V_register_bankdarah Page Controller
 * @category  Controller
 */
class V_register_bankdarahController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "v_register_bankdarah";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("tanggal", 
			"nama", 
			"mrn", 
			"penerima", 
			"golongan_darah", 
			"jenis", 
			"pmi", 
			"jumlah_permintaan", 
			"jumlah_pengambilan", 
			"no_kantong", 
			"jam_mulai", 
			"mayor", 
			"minor", 
			"auto_control", 
			"kesimpulan", 
			"jam_selesai", 
			"TIMEDIFF (jam_selesai,jam_mulai) AS total_waktu", 
			"petugas", 
			"perawat", 
			"ttd", 
			"waktu", 
			"reaksi", 
			"gejala", 
			"tindak_lanjut", 
			"pengembalian", 
			"jumlah_kembali", 
			"alasan", 
			"tgl_kembali");
		$pagination = $this->get_pagination(350); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				v_register_bankdarah.tanggal LIKE ? OR 
				v_register_bankdarah.nama LIKE ? OR 
				v_register_bankdarah.mrn LIKE ? OR 
				v_register_bankdarah.penerima LIKE ? OR 
				v_register_bankdarah.golongan_darah LIKE ? OR 
				v_register_bankdarah.jenis LIKE ? OR 
				v_register_bankdarah.pmi LIKE ? OR 
				v_register_bankdarah.no_kantong LIKE ? OR 
				v_register_bankdarah.jam_mulai LIKE ? OR 
				v_register_bankdarah.mayor LIKE ? OR 
				v_register_bankdarah.minor LIKE ? OR 
				v_register_bankdarah.auto_control LIKE ? OR 
				TIMEDIFF (jam_selesai,jam_mulai) LIKE ? OR 
				v_register_bankdarah.waktu LIKE ? OR 
				v_register_bankdarah.reaksi LIKE ? OR 
				v_register_bankdarah.gejala LIKE ? OR 
				v_register_bankdarah.tindak_lanjut LIKE ? OR 
				v_register_bankdarah.tgl_kembali LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "v_register_bankdarah/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("tanggal", "DESC");
			$db->orderBy("mrn", "ASC");
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->v_register_bankdarah_tanggal)){
			$vals = explode("-to-", str_replace(" ", "", $request->v_register_bankdarah_tanggal));
			$startdate = $vals[0];
			$enddate = $vals[1];
			$db->where("v_register_bankdarah.tanggal BETWEEN '$startdate' AND '$enddate'");
		}
		if(!empty($request->v_register_bankdarah_pmi)){
			$val = $request->v_register_bankdarah_pmi;
			$db->where("v_register_bankdarah.pmi", $val , "=");
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		if(	!empty($records)){
			foreach($records as &$record){
				$record['tanggal'] = format_date($record['tanggal'],'d-m-Y');
$record['jam_mulai'] = format_date($record['jam_mulai'],'d-m-Y H:i:s');
$record['jam_selesai'] = format_date($record['jam_selesai'],'d-m-Y H:i:s');
$record['waktu'] = format_date($record['waktu'],'d-m-Y H:i:s');
			}
		}
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Laporan Register Bank Darah";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "landscape";
		$view_name = (is_ajax() ? "v_register_bankdarah/ajax-list.php" : "v_register_bankdarah/list.php");
		$this->render_view($view_name, $data);
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
}
