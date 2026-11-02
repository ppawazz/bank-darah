<?php 
/**
 * Pengembalian Page Controller
 * @category  Controller
 */
class PengembalianController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "pengembalian";
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
			"mrn", 
			"nama", 
			"jenis", 
			"jumlah", 
			"penerima", 
			"keterangan", 
			"alasan", 
			"jumlah_kembali", 
			"status", 
			"hbawal", 
			"jaminan");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				pengembalian.tanggal LIKE ? OR 
				pengembalian.mrn LIKE ? OR 
				pengembalian.nama LIKE ? OR 
				pengembalian.jenis LIKE ? OR 
				pengembalian.jumlah LIKE ? OR 
				pengembalian.penerima LIKE ? OR 
				pengembalian.keterangan LIKE ? OR 
				pengembalian.alasan LIKE ? OR 
				pengembalian.jumlah_kembali LIKE ? OR 
				pengembalian.status LIKE ? OR 
				pengembalian.hbawal LIKE ? OR 
				pengembalian.jaminan LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "pengembalian/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("pengembalian.tanggal", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Pengembalian";
		$view_name = (is_ajax() ? "pengembalian/ajax-list.php" : "pengembalian/list.php");
		$this->render_view($view_name, $data);
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
}
