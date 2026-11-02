<?php 
/**
 * V_pengembalian Page Controller
 * @category  Controller
 */
class V_pengembalianController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "v_pengembalian";
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
			"diagnosa", 
			"no_kantong", 
			"penerima", 
			"jenis", 
			"pmi", 
			"jumlah", 
			"jumlah_kembali", 
			"no_labu_kembali", 
			"tgl_kadaluarsa", 
			"tgl_kembali", 
			"alasan");
		$pagination = $this->get_pagination(100); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				v_pengembalian.tanggal LIKE ? OR 
				v_pengembalian.nama LIKE ? OR 
				v_pengembalian.mrn LIKE ? OR 
				v_pengembalian.diagnosa LIKE ? OR 
				v_pengembalian.no_kantong LIKE ? OR 
				v_pengembalian.penerima LIKE ? OR 
				v_pengembalian.jenis LIKE ? OR 
				v_pengembalian.pmi LIKE ? OR 
				v_pengembalian.jumlah LIKE ? OR 
				v_pengembalian.jumlah_kembali LIKE ? OR 
				v_pengembalian.no_labu_kembali LIKE ? OR 
				v_pengembalian.tgl_kadaluarsa LIKE ? OR 
				v_pengembalian.tgl_kembali LIKE ? OR 
				v_pengembalian.alasan LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "v_pengembalian/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("tanggal", "ASC");
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->v_pengembalian_tanggal)){
			$vals = explode("-to-", str_replace(" ", "", $request->v_pengembalian_tanggal));
			$startdate = $vals[0];
			$enddate = $vals[1];
			$db->where("v_pengembalian.tanggal BETWEEN '$startdate' AND '$enddate'");
		}
		if(!empty($request->v_pengembalian_pmi)){
			$val = $request->v_pengembalian_pmi;
			$db->where("v_pengembalian.pmi", $val , "=");
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
$record['tgl_kadaluarsa'] = format_date($record['tgl_kadaluarsa'],'d-m-Y');
$record['tgl_kembali'] = format_date($record['tgl_kembali'],'d-m-Y');
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
		$page_title = $this->view->page_title = "Laporan Rekap Pengembalian Darah";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "v_pengembalian/ajax-list.php" : "v_pengembalian/list.php");
		$this->render_view($view_name, $data);
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
}
