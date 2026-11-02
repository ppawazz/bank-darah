<?php 
/**
 * V_rekaprujukanpmi Page Controller
 * @category  Controller
 */
class V_rekaprujukanpmiController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "v_rekaprujukanpmi";
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
			"pmi",
			"jaminan",
			"golongan_darah",
			"jenis",
			"no_kantong",
			"jumlah",
			"harga",
			"total",
			"diagnosa",
			"phlebotomy");
		$pagination = $this->get_pagination(1000); // get current pagination e.g array(page_number, page_limit)
		// reusable filter condition applier (used for the listing and for the filtered totals)
		$applyFilters = function($db) use($request, $fieldname, $fieldvalue){
			//search table record
			if(!empty($request->search)){
				$text = trim($request->search); 
				$search_condition = "(
					v_rekaprujukanpmi.tanggal LIKE ? OR 
					v_rekaprujukanpmi.nama LIKE ? OR 
					v_rekaprujukanpmi.mrn LIKE ? OR 
					v_rekaprujukanpmi.pmi LIKE ? OR 
					v_rekaprujukanpmi.golongan_darah LIKE ? OR 
					v_rekaprujukanpmi.jenis LIKE ? OR 
					v_rekaprujukanpmi.no_kantong LIKE ? OR 
					v_rekaprujukanpmi.jumlah LIKE ? OR 
					v_rekaprujukanpmi.harga LIKE ? OR 
					v_rekaprujukanpmi.total LIKE ? OR 
					v_rekaprujukanpmi.diagnosa LIKE ? OR 
					v_rekaprujukanpmi.phlebotomy LIKE ?
				)";
				$search_params = array(
					"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
				);
				//setting search conditions
				$db->where($search_condition, $search_params);
				 //template to use when ajax search
				$this->view->search_template = "v_rekaprujukanpmi/search.php";
			}
			if($fieldname){
				$db->where($fieldname , $fieldvalue); //filter by a single field name
			}
			if(!empty($request->v_rekaprujukanpmi_tanggal)){
				$vals = explode("-to-", str_replace(" ", "", $request->v_rekaprujukanpmi_tanggal));
				$startdate = $vals[0];
				$enddate = $vals[1];
				$db->where("v_rekaprujukanpmi.tanggal BETWEEN '$startdate' AND '$enddate'");
			}
			if(!empty($request->v_rekaprujukanpmi_pmi)){
				$val = $request->v_rekaprujukanpmi_pmi;
				$db->where("v_rekaprujukanpmi.pmi", $val , "=");
			}
			if(!empty($request->v_rekaprujukanpmi_jaminan)){
				$val = $request->v_rekaprujukanpmi_jaminan;
				$db->where("v_rekaprujukanpmi.jaminan", $val , "=");
			}
		};
		$applyFilters($db);
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("tanggal", "ASC");
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
$record['no_kantong'] = strtoupper($record['no_kantong']);
			}
		}
		//totals for the current filter (tanggal, pmi, jaminan, search)
		$db_filtered = $this->GetModel();
		$applyFilters($db_filtered);
		$filtered_totals = $db_filtered->getOne($tablename, "COALESCE(SUM(jumlah),0) AS sum_jumlah, COALESCE(SUM(total),0) AS sum_total");
		$filtered_sum_jumlah = (!empty($filtered_totals['sum_jumlah']) ? $filtered_totals['sum_jumlah'] : 0);
		$filtered_sum_total = (!empty($filtered_totals['sum_total']) ? $filtered_totals['sum_total'] : 0);
		//grand totals across the whole view (ignores filters)
		$db_overall = $this->GetModel();
		$overall_totals = $db_overall->getOne($tablename, "COALESCE(SUM(jumlah),0) AS sum_jumlah, COALESCE(SUM(total),0) AS sum_total");
		$overall_sum_jumlah = (!empty($overall_totals['sum_jumlah']) ? $overall_totals['sum_jumlah'] : 0);
		$overall_sum_total = (!empty($overall_totals['sum_total']) ? $overall_totals['sum_total'] : 0);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		$data->filtered_sum_jumlah = $filtered_sum_jumlah;
		$data->filtered_sum_total = $filtered_sum_total;
		$data->overall_sum_jumlah = $overall_sum_jumlah;
		$data->overall_sum_total = $overall_sum_total;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Laporan Rekap Rujukan PMI";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("v_rekaprujukanpmi/list.php", $data); //render the full page
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
}
