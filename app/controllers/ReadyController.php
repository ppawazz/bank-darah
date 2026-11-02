<?php 
/**
 * Ready Page Controller
 * @category  Controller
 */
class ReadyController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "ready";
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
			"keterangan", 
			"jenis", 
			"jumlah", 
			"penerima", 
			"jam_mulai", 
			"jam_selesai", 
			"total_waktu", 
			"diagnosa");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				ready.tanggal LIKE ? OR 
				ready.mrn LIKE ? OR 
				ready.nama LIKE ? OR 
				ready.keterangan LIKE ? OR 
				ready.jenis LIKE ? OR 
				ready.jumlah LIKE ? OR 
				ready.penerima LIKE ? OR 
				ready.jam_mulai LIKE ? OR 
				ready.jam_selesai LIKE ? OR 
				ready.total_waktu LIKE ? OR 
				ready.diagnosa LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "ready/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("ready.tanggal", ORDER_TYPE);
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
		if(	!empty($records)){
			foreach($records as &$record){
				$record['tanggal'] = format_date($record['tanggal'],'d-m-Y');
$record['mrn'] = format_date($record['mrn'],'d-m-Y');
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
		$page_title = $this->view->page_title = "Labu Darah Ready";
		$view_name = (is_ajax() ? "ready/ajax-list.php" : "ready/list.php");
		$this->render_view($view_name, $data);
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
}
