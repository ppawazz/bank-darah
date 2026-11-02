<?php 
/**
 * Rekap_harian Page Controller
 * @category  Controller
 */
class Rekap_harianController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "rekap_harian";
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
			"prcldb", 
			"prcldab", 
			"prcldo", 
			"prca+prcb+prcab+prco+tca+tcb+tcab+tco+ffpa+ffpb+ffpab+ffpo+wba+wbb+wbab+wbo+lpa+lpb+lpab+lpo+prclda+prcldb+prcldab+prcldo AS total_darah", 
			"kondisi");
		$pagination = $this->get_pagination(100); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				rekap_harian.tanggal LIKE ? OR 
				rekap_harian.pmi LIKE ? OR 
				rekap_harian.prca LIKE ? OR 
				rekap_harian.prcb LIKE ? OR 
				rekap_harian.prcab LIKE ? OR 
				rekap_harian.prco LIKE ? OR 
				rekap_harian.tca LIKE ? OR 
				rekap_harian.tcb LIKE ? OR 
				rekap_harian.tcab LIKE ? OR 
				rekap_harian.tco LIKE ? OR 
				rekap_harian.ffpa LIKE ? OR 
				rekap_harian.ffpb LIKE ? OR 
				rekap_harian.ffpab LIKE ? OR 
				rekap_harian.ffpo LIKE ? OR 
				rekap_harian.wba LIKE ? OR 
				rekap_harian.wbb LIKE ? OR 
				rekap_harian.wbab LIKE ? OR 
				rekap_harian.wbo LIKE ? OR 
				rekap_harian.lpa LIKE ? OR 
				rekap_harian.lpb LIKE ? OR 
				rekap_harian.lpab LIKE ? OR 
				rekap_harian.lpo LIKE ? OR 
				rekap_harian.prclda LIKE ? OR 
				rekap_harian.prcldb LIKE ? OR 
				rekap_harian.prcldab LIKE ? OR 
				rekap_harian.prcldo LIKE ? OR 
				prca+prcb+prcab+prco+tca+tcb+tcab+tco+ffpa+ffpb+ffpab+ffpo+wba+wbb+wbab+wbo+lpa+lpb+lpab+lpo+prclda+prcldb+prcldab+prcldo LIKE ? OR 
				rekap_harian.kondisi LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "rekap_harian/search.php";
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
		if(!empty($request->rekap_harian_tanggal)){
			$vals = explode("-to-", str_replace(" ", "", $request->rekap_harian_tanggal));
			$startdate = $vals[0];
			$enddate = $vals[1];
			$db->where("rekap_harian.tanggal BETWEEN '$startdate' AND '$enddate'");
		}
		if(!empty($request->rekap_harian_pmi)){
			$val = $request->rekap_harian_pmi;
			$db->where("rekap_harian.pmi", $val , "=");
		}
		if(!empty($request->rekap_harian_kondisi)){
			$val = $request->rekap_harian_kondisi;
			$db->where("rekap_harian.kondisi", $val , "=");
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
		$page_title = $this->view->page_title = "Rekap Harian";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("rekap_harian/list.php", $data); //render the full page
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
}
