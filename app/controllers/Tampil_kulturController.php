<?php 
/**
 * Tampil_kultur Page Controller
 * @category  Controller
 */
class Tampil_kulturController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "tampil_kultur";
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
			"tgl_terima", 
			"diagnosa", 
			"hasil", 
			"jenis_pemeriksaan", 
			"jaminan", 
			"penerima", 
			"petugas", 
			"file");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				tampil_kultur.tgl_sampling LIKE ? OR 
				tampil_kultur.mrn LIKE ? OR 
				tampil_kultur.nama LIKE ? OR 
				tampil_kultur.tgl_terima LIKE ? OR 
				tampil_kultur.diagnosa LIKE ? OR 
				tampil_kultur.hasil LIKE ? OR 
				tampil_kultur.jenis_pemeriksaan LIKE ? OR 
				tampil_kultur.jaminan LIKE ? OR 
				tampil_kultur.penerima LIKE ? OR 
				tampil_kultur.petugas LIKE ? OR 
				tampil_kultur.file LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "tampil_kultur/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("tampil_kultur.tgl_sampling", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Tampil Kultur";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("tampil_kultur/list.php", $data); //render the full page
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
}
