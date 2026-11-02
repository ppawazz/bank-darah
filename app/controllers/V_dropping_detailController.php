<?php 
/**
 * V_dropping_detail Page Controller
 * @category  Controller
 */
class V_dropping_detailController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "v_dropping_detail";
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
			"pmi", 
			"jenis", 
			"golongan_darah", 
			"jumlah", 
			"no_kantong");
		$pagination = $this->get_pagination(1000); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				v_dropping_detail.tanggal LIKE ? OR 
				v_dropping_detail.pmi LIKE ? OR 
				v_dropping_detail.jenis LIKE ? OR 
				v_dropping_detail.golongan_darah LIKE ? OR 
				v_dropping_detail.jumlah LIKE ? OR 
				v_dropping_detail.no_kantong LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "v_dropping_detail/search.php";
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
		if(!empty($request->v_dropping_detail_tanggal)){
			$vals = explode("-to-", str_replace(" ", "", $request->v_dropping_detail_tanggal));
			$startdate = $vals[0];
			$enddate = $vals[1];
			$db->where("v_dropping_detail.tanggal BETWEEN '$startdate' AND '$enddate'");
		}
		if(!empty($request->v_dropping_detail_pmi)){
			$val = $request->v_dropping_detail_pmi;
			$db->where("v_dropping_detail.pmi", $val , "=");
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
		$page_title = $this->view->page_title = "Laporan Dropping";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "v_dropping_detail/ajax-list.php" : "v_dropping_detail/list.php");
		$this->render_view($view_name, $data);
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
}
