<?php 
class ThalasemiaMayorController extends SecureController{
    function __construct(){
        parent::__construct();
        $this->tablename = "thalasemiamayor";
    }

    function index($fieldname = null , $fieldvalue = null){
        $request = $this->request;
        $db = $this->GetModel();
        $tablename = $this->tablename;
        $fields = array("tanggal", "nama", "mrn", "penerima", "diagnosa",
            "golongan_darah", "jenis", "pmi", "jumlah", "no_kantong",
            "mayor", "minor", "auto_control", "kesimpulan");
        $pagination = $this->get_pagination(350);

        // --- AMBIL PARAMETER DARI $_GET LANGSUNG ---
        $search_text = isset($_GET['search']) ? trim($_GET['search']) : '';
        $tanggal_range = isset($_GET['thalasemiamayor_tanggal']) ? $_GET['thalasemiamayor_tanggal'] : '';

        // ---- Pencarian global ----
        if(!empty($search_text)){
            $search_condition = "(
                thalasemiamayor.tanggal LIKE ? OR 
                thalasemiamayor.nama LIKE ? OR 
                thalasemiamayor.mrn LIKE ? OR 
                thalasemiamayor.penerima LIKE ? OR 
                thalasemiamayor.diagnosa LIKE ? OR 
                thalasemiamayor.golongan_darah LIKE ? OR 
                thalasemiamayor.jenis LIKE ? OR 
                thalasemiamayor.pmi LIKE ? OR 
                thalasemiamayor.jumlah LIKE ? OR 
                thalasemiamayor.no_kantong LIKE ? OR 
                thalasemiamayor.mayor LIKE ? OR 
                thalasemiamayor.minor LIKE ? OR 
                thalasemiamayor.auto_control LIKE ? OR 
                thalasemiamayor.kesimpulan LIKE ?
            )";
            $search_params = array(
                "%$search_text%","%$search_text%","%$search_text%","%$search_text%","%$search_text%",
                "%$search_text%","%$search_text%","%$search_text%","%$search_text%","%$search_text%",
                "%$search_text%","%$search_text%","%$search_text%","%$search_text%"
            );
            $db->where($search_condition, $search_params);
            $this->view->search_template = "thalasemiamayor/search.php";
        } else {
            $search_condition = "";
            $search_params = array();
        }

        if(!empty($request->orderby)){
            $db->orderBy($request->orderby, (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE));
        } else {
            $db->orderBy("thalasemiamayor.tanggal", ORDER_TYPE);
        }

        if($fieldname){
            $db->where($fieldname , $fieldvalue);
        }

        // ---- Filter tanggal ----
        $startdate = $enddate = null;
        if(!empty($tanggal_range)){
            $vals = explode("-to-", str_replace(" ", "", $tanggal_range));
            if(count($vals) == 2){
                $startdate = $vals[0];
                $enddate = $vals[1];
                $db->where("thalasemiamayor.tanggal BETWEEN ? AND ?", array($startdate, $enddate));
            }
        }

        // ---- Ambil data utama ----
        $tc = $db->withTotalCount();
        $records = $db->get($tablename, $pagination, $fields);
        $records_count = count($records);
        $total_records = intval($tc->totalCount);
        $page_limit = $pagination[1];
        $total_pages = ceil($total_records / $page_limit);

        if(!empty($records)){
            foreach($records as &$record){
                $record['tanggal'] = format_date($record['tanggal'],'d-m-Y');
            }
        }

        // ---- Hitung total dengan filter (gunakan $_GET) ----
        $where_filtered = array();
        $bind_params = array();

        if(!empty($search_text)){
            $where_filtered[] = $search_condition;
            $bind_params = array_merge($bind_params, $search_params);
        }
        if($startdate && $enddate){
            $where_filtered[] = "thalasemiamayor.tanggal BETWEEN ? AND ?";
            $bind_params[] = $startdate;
            $bind_params[] = $enddate;
        }

        $sql_filtered = "SELECT SUM(jumlah) as total FROM $tablename";
        if(!empty($where_filtered)){
            $sql_filtered .= " WHERE " . implode(" AND ", $where_filtered);
        }

        $db_filtered = $this->GetModel();
        $sum_filtered = $db_filtered->rawQuery($sql_filtered, $bind_params);
        $total_jumlah_filtered = $sum_filtered[0]['total'] ?? 0;

        // ---- Hitung total keseluruhan (tanpa filter) ----
        $db_all = $this->GetModel();
        $sum_all = $db_all->rawQuery("SELECT SUM(jumlah) as total FROM $tablename");
        $total_jumlah_all = $sum_all[0]['total'] ?? 0;

        // ---- Kirim data ke view ----
        $data = new stdClass;
        $data->records = $records;
        $data->record_count = $records_count;
        $data->total_records = $total_records;
        $data->total_page = $total_pages;
        $data->total_jumlah_filtered = $total_jumlah_filtered;
        $data->total_jumlah_all = $total_jumlah_all;

        if($db->getLastError()){
            $this->set_page_error();
        }

        $page_title = $this->view->page_title = "Laporan Thalasemia Mayor";
        $this->view->report_filename = date('Y-m-d') . '-' . $page_title;
        $this->view->report_title = $page_title;
        $this->view->report_layout = "report_layout.php";
        $this->view->report_paper_size = "A4";
        $this->view->report_orientation = "portrait";

        $view_name = (is_ajax() ? "thalasemiamayor/ajax-list.php" : "thalasemiamayor/list.php");
        $this->render_view($view_name, $data);
    }
}