<?php 
/**
 * Kultur_negatif_ini Page Controller
 * @category  Controller
 */
class Kultur_negatif_iniController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "kultur_negatif_ini";
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
		$fields = array("tgl_sampling", 
			"mrn", 
			"nama", 
			"jenis_pemeriksaan", 
			"jaminan", 
			"hasil", 
			"diagnosa", 
			"tgl_kirim", 
			"tgl_terima", 
			"status", 
			"penerima", 
			"file");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				kultur_negatif_ini.tgl_sampling LIKE ? OR 
				kultur_negatif_ini.mrn LIKE ? OR 
				kultur_negatif_ini.nama LIKE ? OR 
				kultur_negatif_ini.jenis_pemeriksaan LIKE ? OR 
				kultur_negatif_ini.jaminan LIKE ? OR 
				kultur_negatif_ini.hasil LIKE ? OR 
				kultur_negatif_ini.diagnosa LIKE ? OR 
				kultur_negatif_ini.tgl_kirim LIKE ? OR 
				kultur_negatif_ini.tgl_terima LIKE ? OR 
				kultur_negatif_ini.status LIKE ? OR 
				kultur_negatif_ini.penerima LIKE ? OR 
				kultur_negatif_ini.file LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "kultur_negatif_ini/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("kultur_negatif_ini.tgl_sampling", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Kultur Negatif Ini";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("kultur_negatif_ini/list.php", $data); //render the full page
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
}
