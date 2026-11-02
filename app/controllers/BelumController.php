<?php 
/**
 * Belum Page Controller
 * @category  Controller
 */
class BelumController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "belum";
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
			"diagnosa");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				belum.tanggal LIKE ? OR 
				belum.mrn LIKE ? OR 
				belum.nama LIKE ? OR 
				belum.jenis LIKE ? OR 
				belum.jumlah LIKE ? OR 
				belum.penerima LIKE ? OR 
				belum.keterangan LIKE ? OR 
				belum.jam_selesai LIKE ? OR 
				belum.total_waktu LIKE ? OR 
				belum.jam_mulai LIKE ? OR 
				belum.diagnosa LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "belum/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("belum.keterangan", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Belum";
		$view_name = (is_ajax() ? "belum/ajax-list.php" : "belum/list.php");
		$this->render_view($view_name, $data);
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
}
