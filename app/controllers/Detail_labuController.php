<?php 
/**
 * Detail_labu Page Controller
 * @category  Controller
 */
class Detail_labuController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "detail_labu";
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
		$fields = array("detail_labu.id", 
			"detail_labu.id_transaksi", 
			"transaksi.tanggal AS transaksi_tanggal", 
			"transaksi.nama AS transaksi_nama", 
			"transaksi.mrn AS transaksi_mrn", 
			"detail_labu.jumlah", 
			"detail_labu.no_kantong", 
			"detail_labu.petugas", 
			"detail_labu.perawat", 
			"detail_labu.waktu");
		$pagination = $this->get_pagination(50); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				detail_labu.id LIKE ? OR 
				detail_labu.id_transaksi LIKE ? OR 
				transaksi.tanggal LIKE ? OR 
				transaksi.nama LIKE ? OR 
				transaksi.mrn LIKE ? OR 
				detail_labu.jumlah LIKE ? OR 
				detail_labu.no_kantong LIKE ? OR 
				detail_labu.petugas LIKE ? OR 
				detail_labu.perawat LIKE ? OR 
				detail_labu.waktu LIKE ? OR 
				transaksi.id LIKE ? OR 
				transaksi.keterangan LIKE ? OR 
				transaksi.jenis_id LIKE ? OR 
				transaksi.status LIKE ? OR 
				transaksi.menerima LIKE ? OR 
				transaksi.no_kantong LIKE ? OR 
				transaksi.pmi LIKE ? OR 
				transaksi.jam_mulai LIKE ? OR 
				transaksi.jam_selesai LIKE ? OR 
				transaksi.memberi LIKE ? OR 
				transaksi.goldar LIKE ? OR 
				transaksi.kondisi LIKE ? OR 
				transaksi.jumlah LIKE ? OR 
				transaksi.pengembalian LIKE ? OR 
				transaksi.jumlah_kembali LIKE ? OR 
				transaksi.tgl_kembali LIKE ? OR 
				transaksi.no_labu_kembali LIKE ? OR 
				transaksi.tgl_kadaluarsa LIKE ? OR 
				transaksi.alasan LIKE ? OR 
				transaksi.harga LIKE ? OR 
				transaksi.crosscheck LIKE ? OR 
				transaksi.mayor LIKE ? OR 
				transaksi.minor LIKE ? OR 
				transaksi.auto_control LIKE ? OR 
				transaksi.kesimpulan LIKE ? OR 
				transaksi.petugas_bdrs LIKE ? OR 
				transaksi.pengambilan LIKE ? OR 
				transaksi.perawat LIKE ? OR 
				transaksi.diagnosa LIKE ? OR 
				transaksi.reaksi LIKE ? OR 
				transaksi.gejala LIKE ? OR 
				transaksi.tindak_lanjut LIKE ? OR 
				transaksi.pelapor LIKE ? OR 
				transaksi.jam_reaksi LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "detail_labu/search.php";
		}
		$db->join("transaksi", "detail_labu.id_transaksi = transaksi.id", "LEFT");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("transaksi_tanggal", "DESC");
			$db->orderBy("transaksi_mrn", "ASC");
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
		if(	!empty($records)){
			foreach($records as &$record){
				$record['transaksi_tanggal'] = format_date($record['transaksi_tanggal'],'d-m-Y');
$record['waktu'] = format_date($record['waktu'],'d-m-Y H:i:s');
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
		$page_title = $this->view->page_title = "Detail Labu";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "detail_labu/ajax-list.php" : "detail_labu/list.php");
		$this->render_view($view_name, $data);
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("detail_labu.id", 
			"detail_labu.id_transaksi", 
			"detail_labu.jumlah", 
			"detail_labu.no_kantong", 
			"detail_labu.perawat", 
			"detail_labu.waktu", 
			"transaksi.id AS transaksi_id", 
			"transaksi.tanggal AS transaksi_tanggal", 
			"transaksi.keterangan AS transaksi_keterangan", 
			"transaksi.jenis_id AS transaksi_jenis_id", 
			"transaksi.status AS transaksi_status", 
			"transaksi.menerima AS transaksi_menerima", 
			"transaksi.no_kantong AS transaksi_no_kantong", 
			"transaksi.pmi AS transaksi_pmi", 
			"transaksi.jam_mulai AS transaksi_jam_mulai", 
			"transaksi.jam_selesai AS transaksi_jam_selesai", 
			"transaksi.memberi AS transaksi_memberi", 
			"transaksi.goldar AS transaksi_goldar", 
			"transaksi.kondisi AS transaksi_kondisi", 
			"transaksi.jumlah AS transaksi_jumlah", 
			"transaksi.mrn AS transaksi_mrn", 
			"transaksi.nama AS transaksi_nama", 
			"transaksi.pengembalian AS transaksi_pengembalian", 
			"transaksi.jumlah_kembali AS transaksi_jumlah_kembali", 
			"transaksi.tgl_kembali AS transaksi_tgl_kembali", 
			"transaksi.no_labu_kembali AS transaksi_no_labu_kembali", 
			"transaksi.tgl_kadaluarsa AS transaksi_tgl_kadaluarsa", 
			"transaksi.alasan AS transaksi_alasan", 
			"transaksi.harga AS transaksi_harga", 
			"transaksi.crosscheck AS transaksi_crosscheck", 
			"transaksi.mayor AS transaksi_mayor", 
			"transaksi.minor AS transaksi_minor", 
			"transaksi.auto_control AS transaksi_auto_control", 
			"transaksi.kesimpulan AS transaksi_kesimpulan", 
			"transaksi.petugas_bdrs AS transaksi_petugas_bdrs", 
			"transaksi.pengambilan AS transaksi_pengambilan", 
			"transaksi.perawat AS transaksi_perawat", 
			"transaksi.diagnosa AS transaksi_diagnosa", 
			"transaksi.reaksi AS transaksi_reaksi", 
			"transaksi.gejala AS transaksi_gejala", 
			"transaksi.tindak_lanjut AS transaksi_tindak_lanjut", 
			"transaksi.pelapor AS transaksi_pelapor", 
			"transaksi.jam_reaksi AS transaksi_jam_reaksi", 
			"detail_labu.petugas");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("detail_labu.id", $rec_id);; //select record based on primary key
		}
		$db->join("transaksi", "detail_labu.id_transaksi = transaksi.id", "LEFT ");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['waktu'] = format_date($record['waktu'],'d-m-Y H:i:s');
$record['transaksi_tanggal'] = format_date($record['transaksi_tanggal'],'d-m-Y');
			$page_title = $this->view->page_title = "View  Detail Labu";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("detail_labu/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("id_transaksi","jumlah","no_kantong","petugas","perawat","waktu");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'id_transaksi' => 'required',
				'jumlah' => 'required|numeric',
				'no_kantong' => 'required',
				'petugas' => 'required',
				'perawat' => 'required',
				'waktu' => 'required',
			);
			$this->sanitize_array = array(
				'id_transaksi' => 'sanitize_string',
				'jumlah' => 'sanitize_string',
				'no_kantong' => 'sanitize_string',
				'petugas' => 'sanitize_string',
				'perawat' => 'sanitize_string',
				'waktu' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Data Berhasil ditambah", "success");
					return	$this->redirect("detail_labu");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Detail Labu";
		$this->render_view("detail_labu/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","id_transaksi","jumlah","no_kantong","petugas","perawat","waktu");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'id_transaksi' => 'required',
				'jumlah' => 'required|numeric',
				'no_kantong' => 'required',
				'petugas' => 'required',
				'perawat' => 'required',
				'waktu' => 'required',
			);
			$this->sanitize_array = array(
				'id_transaksi' => 'sanitize_string',
				'jumlah' => 'sanitize_string',
				'no_kantong' => 'sanitize_string',
				'petugas' => 'sanitize_string',
				'perawat' => 'sanitize_string',
				'waktu' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("detail_labu.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Data berhasil dirubah", "success");
					return $this->redirect("detail_labu");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("detail_labu");
					}
				}
			}
		}
		$db->where("detail_labu.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Detail Labu";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("detail_labu/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("id","id_transaksi","jumlah","no_kantong","petugas","perawat","waktu");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'id_transaksi' => 'required',
				'jumlah' => 'required|numeric',
				'no_kantong' => 'required',
				'petugas' => 'required',
				'perawat' => 'required',
				'waktu' => 'required',
			);
			$this->sanitize_array = array(
				'id_transaksi' => 'sanitize_string',
				'jumlah' => 'sanitize_string',
				'no_kantong' => 'sanitize_string',
				'petugas' => 'sanitize_string',
				'perawat' => 'sanitize_string',
				'waktu' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("detail_labu.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No record updated";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("detail_labu.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Data berhasil di hapus", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("detail_labu");
	}
}
