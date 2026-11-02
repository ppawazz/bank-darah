<?php 
/**
 * Rujukan_bulan_lalu Page Controller
 * @category  Controller
 */
class Rujukan_bulan_laluController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "rujukan_bulan_lalu";
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
			"tgl_pengiriman", 
			"tgl_penerimaan", 
			"qty", 
			"rujukan", 
			"tarif", 
			"total");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				rujukan_bulan_lalu.tanggal LIKE ? OR 
				rujukan_bulan_lalu.mrn LIKE ? OR 
				rujukan_bulan_lalu.nama LIKE ? OR 
				rujukan_bulan_lalu.tgl_pengiriman LIKE ? OR 
				rujukan_bulan_lalu.tgl_penerimaan LIKE ? OR 
				rujukan_bulan_lalu.qty LIKE ? OR 
				rujukan_bulan_lalu.rujukan LIKE ? OR 
				rujukan_bulan_lalu.tarif LIKE ? OR 
				rujukan_bulan_lalu.total LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "rujukan_bulan_lalu/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("rujukan_bulan_lalu.tanggal", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Rujukan Bulan Lalu";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("rujukan_bulan_lalu/list.php", $data); //render the full page
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
}
