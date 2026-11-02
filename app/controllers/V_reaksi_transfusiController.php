<?php 
/**
 * V_reaksi_transfusi Page Controller
 * @category  Controller
 */
class V_reaksi_transfusiController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "v_reaksi_transfusi";
	}
	/**
     * Custom list page
     * @return BaseView
     */
	function index(){
		$request = $this->request;
		$db = $this->GetModel();
		$pagination = null;
		$sqltext = "SELECT SQL_CALC_FOUND_ROWS  transaksi.tanggal, transaksi.jam_reaksi, transaksi.nama, transaksi.mrn, transaksi.diagnosa, jenis_darah.jenis, transaksi.no_kantong, transaksi.gejala, transaksi.tindak_lanjut, transaksi.jam_lapor, transaksi.pelapor FROM transaksi Left JOIN jenis_darah ON jenis_darah.jenis_id = transaksi.jenis_id where reaksi='Ya' ";
		$queryparams = null;
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("tanggal", ORDER_TYPE);
		}
		$pagination = $this->get_pagination(100); //Get sql limit from url if not set on the sql command text
		$tc = $db->withTotalCount();
		$records = $db->query($sqltext, $pagination, $queryparams);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = (!empty($pagination) ? $pagination[1] : 1);
		$total_pages = ceil($total_records / $page_limit);
		if(	!empty($records)){
			foreach($records as &$record){
				$record['tanggal'] = format_date($record['tanggal'],'d-m-Y');
$record['jam_reaksi'] = format_date($record['jam_reaksi'],'d-m-Y H:i:s');
$record['jam_lapor'] = format_date($record['jam_lapor'],'d-m-Y H:i:s');
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
		$page_title = $this->view->page_title = "Laporan Reaksi Transfusi";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("v_reaksi_transfusi/list.php", $data); //render the full page
	}
}
