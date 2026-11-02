<?php 
/**
 * Dropping Page Controller
 * @category  Controller
 */
class DroppingController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "dropping";
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
			"prca", 
			"prcb", 
			"prcab", 
			"prco", 
			"tca", 
			"tcb", 
			"tcab", 
			"tco", 
			"ffpa", 
			"ffpb", 
			"ffpab", 
			"ffpo", 
			"wba", 
			"wbb", 
			"wbab", 
			"wbo", 
			"lpa", 
			"lpb", 
			"lpab", 
			"lpo", 
			"prclda", 
			"prcldab", 
			"prcldb", 
			"prcldo", 
			"prca+prcb+prcab+prco+tca+tcb+tcab+tco+ffpa+ffpb+ffpab+ffpo+wba+wbb+wbab+wbo+lpa+lpab+lpb+lpo+prclda+prcldb+prcldo+prcldab AS total");
		$pagination = $this->get_pagination(200); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				dropping.tanggal LIKE ? OR 
				dropping.pmi LIKE ? OR 
				dropping.prca LIKE ? OR 
				dropping.prcb LIKE ? OR 
				dropping.prcab LIKE ? OR 
				dropping.prco LIKE ? OR 
				dropping.tca LIKE ? OR 
				dropping.tcb LIKE ? OR 
				dropping.tcab LIKE ? OR 
				dropping.tco LIKE ? OR 
				dropping.ffpa LIKE ? OR 
				dropping.ffpb LIKE ? OR 
				dropping.ffpab LIKE ? OR 
				dropping.ffpo LIKE ? OR 
				dropping.wba LIKE ? OR 
				dropping.wbb LIKE ? OR 
				dropping.wbab LIKE ? OR 
				dropping.wbo LIKE ? OR 
				dropping.lpa LIKE ? OR 
				dropping.lpb LIKE ? OR 
				dropping.lpab LIKE ? OR 
				dropping.lpo LIKE ? OR 
				dropping.prclda LIKE ? OR 
				dropping.prcldab LIKE ? OR 
				dropping.prcldb LIKE ? OR 
				dropping.prcldo LIKE ? OR 
				prca+prcb+prcab+prco+tca+tcb+tcab+tco+ffpa+ffpb+ffpab+ffpo+wba+wbb+wbab+wbo+lpa+lpab+lpb+lpo+prclda+prcldb+prcldo+prcldab LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "dropping/search.php";
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
		if(!empty($request->dropping_tanggal)){
			$vals = explode("-to-", str_replace(" ", "", $request->dropping_tanggal));
			$startdate = $vals[0];
			$enddate = $vals[1];
			$db->where("dropping.tanggal BETWEEN '$startdate' AND '$enddate'");
		}
		if(!empty($request->dropping_pmi)){
			$val = $request->dropping_pmi;
			$db->where("dropping.pmi", $val , "=");
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
		$page_title = $this->view->page_title = "Rekap Dropping";
		$this->view->report_filename = date('d-m-Y') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("dropping/list.php", $data); //render the full page
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
}
