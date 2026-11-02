<?php 
/**
 * Kultur_bulan_lalu Page Controller
 * @category  Controller
 */
class Kultur_bulan_laluController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "kultur_bulan_lalu";
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
		$fields = array("id", 
			"tgl_sampling", 
			"mrn", 
			"nama", 
			"jenis_pemeriksaan", 
			"jaminan", 
			"hasil", 
			"diagnosa", 
			"tampil", 
			"tgl_kirim", 
			"tgl_terima", 
			"status", 
			"hasil_bdrs", 
			"ruangan", 
			"petugas");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				kultur_bulan_lalu.id LIKE ? OR 
				kultur_bulan_lalu.tgl_sampling LIKE ? OR 
				kultur_bulan_lalu.mrn LIKE ? OR 
				kultur_bulan_lalu.nama LIKE ? OR 
				kultur_bulan_lalu.jenis_pemeriksaan LIKE ? OR 
				kultur_bulan_lalu.jaminan LIKE ? OR 
				kultur_bulan_lalu.hasil LIKE ? OR 
				kultur_bulan_lalu.diagnosa LIKE ? OR 
				kultur_bulan_lalu.tampil LIKE ? OR 
				kultur_bulan_lalu.tgl_kirim LIKE ? OR 
				kultur_bulan_lalu.tgl_terima LIKE ? OR 
				kultur_bulan_lalu.status LIKE ? OR 
				kultur_bulan_lalu.hasil_bdrs LIKE ? OR 
				kultur_bulan_lalu.ruangan LIKE ? OR 
				kultur_bulan_lalu.petugas LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "kultur_bulan_lalu/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("kultur_bulan_lalu.id", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Kultur Bulan Lalu";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("kultur_bulan_lalu/list.php", $data); //render the full page
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
}
