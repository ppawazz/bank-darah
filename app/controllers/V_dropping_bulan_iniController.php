<?php 
/**
 * V_dropping_bulan_ini Page Controller
 * @category  Controller
 */
class V_dropping_bulan_iniController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "v_dropping_bulan_ini";
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
			"prcab", 
			"prcb", 
			"prco", 
			"tca", 
			"tcab", 
			"tcb", 
			"tco", 
			"ffpa", 
			"ffpab", 
			"ffpb", 
			"ffpo", 
			"wba", 
			"wbab", 
			"wbb", 
			"wbo", 
			"lpa", 
			"lpab", 
			"lpb", 
			"lpo", 
			"prclda", 
			"prcldab", 
			"prcldb", 
			"prcldo", 
			"prca+prcb+prcab+prco+tca+tcb+tcab+tco+ffpa+ffpb+ffpab+ffpo+wba+wbb+wbab+wbo+lpa+lpab+lpb+lpo+prclda+prcldb+prcldo+prcldab AS total");
		$pagination = $this->get_pagination(100); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				v_dropping_bulan_ini.tanggal LIKE ? OR 
				v_dropping_bulan_ini.pmi LIKE ? OR 
				v_dropping_bulan_ini.prca LIKE ? OR 
				v_dropping_bulan_ini.prcab LIKE ? OR 
				v_dropping_bulan_ini.prcb LIKE ? OR 
				v_dropping_bulan_ini.prco LIKE ? OR 
				v_dropping_bulan_ini.tca LIKE ? OR 
				v_dropping_bulan_ini.tcab LIKE ? OR 
				v_dropping_bulan_ini.tcb LIKE ? OR 
				v_dropping_bulan_ini.tco LIKE ? OR 
				v_dropping_bulan_ini.ffpa LIKE ? OR 
				v_dropping_bulan_ini.ffpab LIKE ? OR 
				v_dropping_bulan_ini.ffpb LIKE ? OR 
				v_dropping_bulan_ini.ffpo LIKE ? OR 
				v_dropping_bulan_ini.wba LIKE ? OR 
				v_dropping_bulan_ini.wbab LIKE ? OR 
				v_dropping_bulan_ini.wbb LIKE ? OR 
				v_dropping_bulan_ini.wbo LIKE ? OR 
				v_dropping_bulan_ini.lpa LIKE ? OR 
				v_dropping_bulan_ini.lpab LIKE ? OR 
				v_dropping_bulan_ini.lpb LIKE ? OR 
				v_dropping_bulan_ini.lpo LIKE ? OR 
				v_dropping_bulan_ini.prclda LIKE ? OR 
				v_dropping_bulan_ini.prcldab LIKE ? OR 
				v_dropping_bulan_ini.prcldb LIKE ? OR 
				v_dropping_bulan_ini.prcldo LIKE ? OR 
				prca+prcb+prcab+prco+tca+tcb+tcab+tco+ffpa+ffpb+ffpab+ffpo+wba+wbb+wbab+wbo+lpa+lpab+lpb+lpo+prclda+prcldb+prcldo+prcldab LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "v_dropping_bulan_ini/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("v_dropping_bulan_ini.tanggal", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->v_dropping_bulan_ini_tanggal)){
			$vals = explode("-to-", str_replace(" ", "", $request->v_dropping_bulan_ini_tanggal));
			$startdate = $vals[0];
			$enddate = $vals[1];
			$db->where("v_dropping_bulan_ini.tanggal BETWEEN '$startdate' AND '$enddate'");
		}
		if(!empty($request->v_dropping_bulan_ini_pmi)){
			$val = $request->v_dropping_bulan_ini_pmi;
			$db->where("v_dropping_bulan_ini.pmi", $val , "=");
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
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("v_dropping_bulan_ini/list.php", $data); //render the full page
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
}
