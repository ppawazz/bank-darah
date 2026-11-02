<?php 
/**
 * Transaksi Page Controller
 * @category  Controller
 */
class TransaksiController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "transaksi";
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
		$fields = array("transaksi.id", 
			"transaksi.tanggal", 
			"transaksi.mrn", 
			"transaksi.nama", 
			"transaksi.keterangan", 
			"pemberi.pemberi AS pemberi_pemberi", 
			"transaksi.diagnosa", 
			"penerima.penerima AS penerima_penerima", 
			"goldar.golongan_darah AS goldar_golongan_darah", 
			"jenis_darah.jenis AS jenis_darah_jenis", 
			"transaksi.jumlah", 
			"transaksi.no_kantong", 
			"transaksi.pmi", 
			"transaksi.jam_mulai", 
			"transaksi.jam_selesai", 
			"TIMEDIFF (jam_selesai,jam_mulai) AS waktu_cross", 
			"transaksi.kondisi",
			"transaksi.jaminan",
			"transaksi.pengembalian",
			"transaksi.reaksi",
			"transaksi.phlebotomy");
		$pagination = $this->get_pagination(100); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				transaksi.id LIKE ? OR 
				transaksi.tanggal LIKE ? OR 
				transaksi.mrn LIKE ? OR 
				transaksi.nama LIKE ? OR 
				transaksi.keterangan LIKE ? OR 
				transaksi.jenis_id LIKE ? OR 
				transaksi.status LIKE ? OR 
				pemberi.pemberi LIKE ? OR 
				transaksi.diagnosa LIKE ? OR 
				penerima.penerima LIKE ? OR 
				goldar.golongan_darah LIKE ? OR 
				jenis_darah.jenis LIKE ? OR 
				transaksi.jumlah LIKE ? OR 
				transaksi.jumlah_kembali LIKE ? OR 
				transaksi.no_kantong LIKE ? OR 
				transaksi.pmi LIKE ? OR 
				transaksi.jam_mulai LIKE ? OR 
				transaksi.jam_selesai LIKE ? OR 
				transaksi.menerima LIKE ? OR 
				transaksi.memberi LIKE ? OR 
				transaksi.goldar LIKE ? OR 
				transaksi.kondisi LIKE ? OR 
				transaksi.tgl_kembali LIKE ? OR 
				transaksi.no_labu_kembali LIKE ? OR 
				transaksi.tgl_kadaluarsa LIKE ? OR 
				transaksi.alasan LIKE ? OR 
				transaksi.pengembalian LIKE ? OR 
				transaksi.reaksi LIKE ? OR 
				transaksi.harga LIKE ? OR 
				goldar.id LIKE ? OR 
				jenis_darah.jenis_id LIKE ? OR 
				jenis_darah.stok LIKE ? OR 
				jenis_darah.goldar LIKE ? OR 
				pemberi.id LIKE ? OR 
				penerima.id LIKE ? OR 
				transaksi.crosscheck LIKE ? OR 
				transaksi.mayor LIKE ? OR 
				transaksi.minor LIKE ? OR 
				transaksi.auto_control LIKE ? OR 
				transaksi.kesimpulan LIKE ? OR 
				transaksi.petugas_bdrs LIKE ? OR 
				transaksi.pengambilan LIKE ? OR 
				transaksi.perawat LIKE ? OR 
				transaksi.gejala LIKE ? OR 
				transaksi.tindak_lanjut LIKE ? OR 
				transaksi.pelapor LIKE ? OR 
				transaksi.jam_reaksi LIKE ? OR 
				transaksi.jam_lapor LIKE ? OR 
				transaksi.hbawal LIKE ? OR 
				transaksi.jaminan LIKE ? OR 
				transaksi.phlebotomy LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "transaksi/search.php";
		}
		$db->join("goldar", "transaksi.goldar = goldar.id", "INNER");
		$db->join("jenis_darah", "transaksi.jenis_id = jenis_darah.jenis_id", "INNER");
		$db->join("pemberi", "transaksi.memberi = pemberi.id", "INNER");
		$db->join("penerima", "transaksi.menerima = penerima.id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("id", "DESC");
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->transaksi_tanggal)){
			$vals = explode("-to-", str_replace(" ", "", $request->transaksi_tanggal));
			$startdate = $vals[0];
			$enddate = $vals[1];
			$db->where("transaksi.tanggal BETWEEN '$startdate' AND '$enddate'");
		}
		if(!empty($request->transaksi_pmi)){
			$val = $request->transaksi_pmi;
			$db->where("transaksi.pmi", $val , "=");
		}
		if(!empty($request->jenis_darah_jenis)){
			$val = $request->jenis_darah_jenis;
			$db->where("jenis_darah.jenis", $val , "=");
		}
		if(!empty($request->transaksi_kondisi)){
			$val = $request->transaksi_kondisi;
			$db->where("transaksi.kondisi", $val , "=");
		}
		if(!empty($request->transaksi_jaminan)){
			$val = $request->transaksi_jaminan;
			$db->where("transaksi.jaminan", $val , "=");
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
		$page_title = $this->view->page_title = "Transaksi BDRS";
		$this->view->report_filename = date('d-m-Y') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "transaksi/ajax-list.php" : "transaksi/list.php");
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
		$fields = array("transaksi.id", 
			"transaksi.tanggal", 
			"transaksi.keterangan", 
			"transaksi.jenis_id", 
			"transaksi.status", 
			"transaksi.menerima", 
			"transaksi.no_kantong", 
			"transaksi.pmi", 
			"transaksi.jam_mulai", 
			"transaksi.jam_selesai", 
			"transaksi.memberi", 
			"transaksi.goldar", 
			"transaksi.kondisi", 
			"transaksi.jumlah", 
			"transaksi.mrn", 
			"transaksi.nama", 
			"transaksi.pengembalian", 
			"transaksi.jumlah_kembali", 
			"transaksi.tgl_kembali", 
			"transaksi.no_labu_kembali", 
			"transaksi.tgl_kadaluarsa", 
			"transaksi.alasan", 
			"transaksi.harga", 
			"transaksi.crosscheck", 
			"transaksi.mayor", 
			"transaksi.minor", 
			"transaksi.auto_control", 
			"transaksi.kesimpulan", 
			"transaksi.petugas_bdrs", 
			"transaksi.pengambilan", 
			"transaksi.perawat", 
			"transaksi.diagnosa", 
			"transaksi.reaksi", 
			"transaksi.gejala", 
			"transaksi.tindak_lanjut", 
			"transaksi.pelapor", 
			"transaksi.jam_reaksi", 
			"perawat.id AS perawat_id", 
			"perawat.nama AS perawat_nama", 
			"perawat.ttd AS perawat_ttd", 
			"pemberi.id AS pemberi_id", 
			"pemberi.pemberi AS pemberi_pemberi", 
			"transaksi.jam_lapor", 
			"transaksi.hbawal", 
			"transaksi.jaminan", 
			"penerima.id AS penerima_id", 
			"penerima.penerima AS penerima_penerima", 
			"detail_labu.id AS detail_labu_id", 
			"detail_labu.id_transaksi AS detail_labu_id_transaksi", 
			"detail_labu.jumlah AS detail_labu_jumlah", 
			"detail_labu.no_kantong AS detail_labu_no_kantong", 
			"detail_labu.perawat AS detail_labu_perawat", 
			"detail_labu.waktu AS detail_labu_waktu", 
			"detail_labu.petugas AS detail_labu_petugas", 
			"perawat.id AS perawat_id", 
			"perawat.nama AS perawat_nama", 
			"perawat.ttd AS perawat_ttd", 
			"transaksi.phlebotomy", 
			"jenis_darah.jenis_id AS jenis_darah_jenis_id", 
			"jenis_darah.jenis AS jenis_darah_jenis", 
			"jenis_darah.stok AS jenis_darah_stok", 
			"jenis_darah.goldar AS jenis_darah_goldar", 
			"goldar.id AS goldar_id", 
			"goldar.golongan_darah AS goldar_golongan_darah");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("transaksi.id", $rec_id);; //select record based on primary key
		}
		$db->join("jenis_darah", "transaksi.jenis_id = jenis_darah.jenis_id", "LEFT ");
		$db->join("goldar", "transaksi.goldar = goldar.id", "LEFT ");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['tanggal'] = format_date($record['tanggal'],'d-m-Y');
$record['kondisi'] = format_date($record['kondisi'],'d-m-Y');
$record['no_labu_kembali'] = format_date($record['no_labu_kembali'],'d-m-Y');
$record['pengambilan'] = format_date($record['pengambilan'],'d-m-Y H:i');
			$page_title = $this->view->page_title = "View  Transaksi";
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
		return $this->render_view("transaksi/view.php", $record);
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
			$fields = $this->fields = array("tanggal","mrn","nama","goldar","jenis_id","keterangan","memberi","menerima","jumlah","no_kantong","pmi","diagnosa","jam_mulai","jam_selesai","kondisi","jaminan");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal' => 'required',
				'goldar' => 'required',
				'jenis_id' => 'required',
				'keterangan' => 'required',
				'jumlah' => 'required|numeric',
				'no_kantong' => 'required',
				'pmi' => 'required',
				'diagnosa' => 'required',
				'jam_mulai' => 'required',
				'jam_selesai' => 'required',
				'kondisi' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal' => 'sanitize_string',
				'mrn' => 'sanitize_string',
				'nama' => 'sanitize_string',
				'goldar' => 'sanitize_string',
				'jenis_id' => 'sanitize_string',
				'keterangan' => 'sanitize_string',
				'memberi' => 'sanitize_string',
				'menerima' => 'sanitize_string',
				'jumlah' => 'sanitize_string',
				'no_kantong' => 'sanitize_string',
				'pmi' => 'sanitize_string',
				'diagnosa' => 'sanitize_string',
				'jam_mulai' => 'sanitize_string',
				'jam_selesai' => 'sanitize_string',
				'kondisi' => 'sanitize_string',
				'jaminan' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Data Berhasil ditambah", "success");
					return	$this->redirect("home");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Tambah Transaksi Bank Darah";
		$this->render_view("transaksi/add.php");
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
		$fields = $this->fields = array("id","tanggal","mrn","nama","goldar","jenis_id","keterangan","memberi","menerima","jumlah","no_kantong","pmi","diagnosa","jam_mulai","jam_selesai","kondisi","pengembalian","jumlah_kembali","tgl_kembali","no_labu_kembali","tgl_kadaluarsa","alasan","harga","status","crosscheck","mayor","minor","auto_control","kesimpulan","petugas_bdrs","reaksi","gejala","tindak_lanjut","pelapor","jam_reaksi","jam_lapor","hbawal","jaminan");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal' => 'required',
				'goldar' => 'required',
				'jenis_id' => 'required',
				'keterangan' => 'required',
				'jumlah' => 'required|numeric',
				'no_kantong' => 'required',
				'pmi' => 'required',
				'diagnosa' => 'required',
				'jam_mulai' => 'required',
				'jam_selesai' => 'required',
				'kondisi' => 'required',
				'jumlah_kembali' => 'numeric',
			);
			$this->sanitize_array = array(
				'tanggal' => 'sanitize_string',
				'mrn' => 'sanitize_string',
				'nama' => 'sanitize_string',
				'goldar' => 'sanitize_string',
				'jenis_id' => 'sanitize_string',
				'keterangan' => 'sanitize_string',
				'memberi' => 'sanitize_string',
				'menerima' => 'sanitize_string',
				'jumlah' => 'sanitize_string',
				'no_kantong' => 'sanitize_string',
				'pmi' => 'sanitize_string',
				'diagnosa' => 'sanitize_string',
				'jam_mulai' => 'sanitize_string',
				'jam_selesai' => 'sanitize_string',
				'kondisi' => 'sanitize_string',
				'pengembalian' => 'sanitize_string',
				'jumlah_kembali' => 'sanitize_string',
				'tgl_kembali' => 'sanitize_string',
				'no_labu_kembali' => 'sanitize_string',
				'tgl_kadaluarsa' => 'sanitize_string',
				'alasan' => 'sanitize_string',
				'harga' => 'sanitize_string',
				'status' => 'sanitize_string',
				'crosscheck' => 'sanitize_string',
				'mayor' => 'sanitize_string',
				'minor' => 'sanitize_string',
				'auto_control' => 'sanitize_string',
				'kesimpulan' => 'sanitize_string',
				'petugas_bdrs' => 'sanitize_string',
				'reaksi' => 'sanitize_string',
				'gejala' => 'sanitize_string',
				'tindak_lanjut' => 'sanitize_string',
				'pelapor' => 'sanitize_string',
				'jam_reaksi' => 'sanitize_string',
				'jam_lapor' => 'sanitize_string',
				'hbawal' => 'sanitize_string',
				'jaminan' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("transaksi.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Data berhasil dirubah", "success");
					return $this->redirect("transaksi");
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
						return	$this->redirect("transaksi");
					}
				}
			}
		}
		$db->where("transaksi.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Transaksi";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("transaksi/edit.php", $data);
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
		$fields = $this->fields = array("id","tanggal","mrn","nama","goldar","jenis_id","keterangan","memberi","menerima","jumlah","no_kantong","pmi","diagnosa","jam_mulai","jam_selesai","kondisi","pengembalian","jumlah_kembali","tgl_kembali","no_labu_kembali","tgl_kadaluarsa","alasan","harga","status","crosscheck","mayor","minor","auto_control","kesimpulan","petugas_bdrs","reaksi","gejala","tindak_lanjut","pelapor","jam_reaksi","jam_lapor","hbawal","jaminan");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'tanggal' => 'required',
				'goldar' => 'required',
				'jenis_id' => 'required',
				'keterangan' => 'required',
				'jumlah' => 'required|numeric',
				'no_kantong' => 'required',
				'pmi' => 'required',
				'diagnosa' => 'required',
				'jam_mulai' => 'required',
				'jam_selesai' => 'required',
				'kondisi' => 'required',
				'jumlah_kembali' => 'numeric',
			);
			$this->sanitize_array = array(
				'tanggal' => 'sanitize_string',
				'mrn' => 'sanitize_string',
				'nama' => 'sanitize_string',
				'goldar' => 'sanitize_string',
				'jenis_id' => 'sanitize_string',
				'keterangan' => 'sanitize_string',
				'memberi' => 'sanitize_string',
				'menerima' => 'sanitize_string',
				'jumlah' => 'sanitize_string',
				'no_kantong' => 'sanitize_string',
				'pmi' => 'sanitize_string',
				'diagnosa' => 'sanitize_string',
				'jam_mulai' => 'sanitize_string',
				'jam_selesai' => 'sanitize_string',
				'kondisi' => 'sanitize_string',
				'pengembalian' => 'sanitize_string',
				'jumlah_kembali' => 'sanitize_string',
				'tgl_kembali' => 'sanitize_string',
				'no_labu_kembali' => 'sanitize_string',
				'tgl_kadaluarsa' => 'sanitize_string',
				'alasan' => 'sanitize_string',
				'harga' => 'sanitize_string',
				'status' => 'sanitize_string',
				'crosscheck' => 'sanitize_string',
				'mayor' => 'sanitize_string',
				'minor' => 'sanitize_string',
				'auto_control' => 'sanitize_string',
				'kesimpulan' => 'sanitize_string',
				'petugas_bdrs' => 'sanitize_string',
				'reaksi' => 'sanitize_string',
				'gejala' => 'sanitize_string',
				'tindak_lanjut' => 'sanitize_string',
				'pelapor' => 'sanitize_string',
				'jam_reaksi' => 'sanitize_string',
				'jam_lapor' => 'sanitize_string',
				'hbawal' => 'sanitize_string',
				'jaminan' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("transaksi.id", $rec_id);;
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
		$db->where("transaksi.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Data berhasil di hapus", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("transaksi");
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function pengembalian($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("transaksi.id", 
			"transaksi.tanggal", 
			"transaksi.nama", 
			"transaksi.mrn", 
			"transaksi.diagnosa", 
			"transaksi.no_kantong", 
			"penerima.penerima AS penerima_penerima", 
			"jenis_darah.jenis AS jenis_darah_jenis", 
			"transaksi.pmi", 
			"transaksi.jumlah", 
			"transaksi.jumlah_kembali", 
			"transaksi.no_labu_kembali", 
			"transaksi.tgl_kadaluarsa", 
			"transaksi.tgl_kembali", 
			"transaksi.alasan");
		$pagination = $this->get_pagination(100); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				transaksi.id LIKE ? OR 
				transaksi.tanggal LIKE ? OR 
				transaksi.nama LIKE ? OR 
				transaksi.mrn LIKE ? OR 
				transaksi.diagnosa LIKE ? OR 
				transaksi.no_kantong LIKE ? OR 
				penerima.penerima LIKE ? OR 
				jenis_darah.jenis LIKE ? OR 
				transaksi.pmi LIKE ? OR 
				transaksi.jumlah LIKE ? OR 
				transaksi.jumlah_kembali LIKE ? OR 
				transaksi.no_labu_kembali LIKE ? OR 
				transaksi.tgl_kadaluarsa LIKE ? OR 
				transaksi.tgl_kembali LIKE ? OR 
				transaksi.keterangan LIKE ? OR 
				transaksi.jenis_id LIKE ? OR 
				goldar.golongan_darah LIKE ? OR 
				transaksi.goldar LIKE ? OR 
				transaksi.kondisi LIKE ? OR 
				transaksi.status LIKE ? OR 
				transaksi.menerima LIKE ? OR 
				transaksi.jam_mulai LIKE ? OR 
				transaksi.jam_selesai LIKE ? OR 
				transaksi.memberi LIKE ? OR 
				penerima.id LIKE ? OR 
				goldar.id LIKE ? OR 
				jenis_darah.jenis_id LIKE ? OR 
				jenis_darah.stok LIKE ? OR 
				jenis_darah.goldar LIKE ? OR 
				transaksi.pengembalian LIKE ? OR 
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
				transaksi.reaksi LIKE ? OR 
				transaksi.gejala LIKE ? OR 
				transaksi.tindak_lanjut LIKE ? OR 
				transaksi.pelapor LIKE ? OR 
				transaksi.jam_reaksi LIKE ? OR 
				transaksi.jam_lapor LIKE ? OR 
				transaksi.hbawal LIKE ? OR 
				transaksi.jaminan LIKE ? OR 
				transaksi.phlebotomy LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "transaksi/search.php";
		}
		$db->join("penerima", "transaksi.menerima = penerima.id", "INNER");
		$db->join("goldar", "transaksi.goldar = goldar.id", "INNER");
		$db->join("jenis_darah", "transaksi.jenis_id = jenis_darah.jenis_id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("tanggal", "DESC");
		}
		$db->where("pengembalian = 'Ya' and YEAR(tanggal) = YEAR(CURDATE()) AND Month(tanggal) = Month(CURDATE())");
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->transaksi_tanggal)){
			$vals = explode("-to-", str_replace(" ", "", $request->transaksi_tanggal));
			$startdate = $vals[0];
			$enddate = $vals[1];
			$db->where("transaksi.tanggal BETWEEN '$startdate' AND '$enddate'");
		}
		if(!empty($request->transaksi_pmi)){
			$val = $request->transaksi_pmi;
			$db->where("transaksi.pmi", $val , "=");
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
		$page_title = $this->view->page_title = "Rekap Pengembalian Labu Darah";
		$this->view->report_filename = date('d-m-Y') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "transaksi/ajax-pengembalian.php" : "transaksi/pengembalian.php");
		$this->render_view($view_name, $data);
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function ready($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("transaksi.id", 
			"transaksi.tanggal", 
			"transaksi.mrn", 
			"transaksi.nama", 
			"penerima.penerima AS penerima_penerima", 
			"jenis_darah.jenis AS jenis_darah_jenis", 
			"transaksi.jumlah", 
			"transaksi.keterangan", 
			"transaksi.jam_mulai", 
			"transaksi.jam_selesai", 
			"TIMEDIFF (jam_selesai,jam_mulai) AS total_waktu", 
			"transaksi.diagnosa", 
			"transaksi.kondisi");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				transaksi.id LIKE ? OR 
				transaksi.tanggal LIKE ? OR 
				transaksi.mrn LIKE ? OR 
				transaksi.nama LIKE ? OR 
				penerima.penerima LIKE ? OR 
				jenis_darah.jenis LIKE ? OR 
				transaksi.jml LIKE ? OR 
				transaksi.jumlah LIKE ? OR 
				transaksi.keterangan LIKE ? OR 
				transaksi.status LIKE ? OR 
				transaksi.menerima LIKE ? OR 
				transaksi.jam_mulai LIKE ? OR 
				transaksi.jam_selesai LIKE ? OR 
				transaksi.no_kantong LIKE ? OR 
				transaksi.diagnosa LIKE ? OR 
				transaksi.kondisi LIKE ? OR 
				transaksi.jenis_id LIKE ? OR 
				transaksi.pmi LIKE ? OR 
				transaksi.memberi LIKE ? OR 
				transaksi.goldar LIKE ? OR 
				jenis_darah.jenis_id LIKE ? OR 
				jenis_darah.stok LIKE ? OR 
				jenis_darah.goldar LIKE ? OR 
				penerima.id LIKE ? OR 
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
				transaksi.reaksi LIKE ? OR 
				transaksi.gejala LIKE ? OR 
				transaksi.tindak_lanjut LIKE ? OR 
				transaksi.pelapor LIKE ? OR 
				transaksi.jam_reaksi LIKE ? OR 
				transaksi.jam_lapor LIKE ? OR 
				transaksi.hbawal LIKE ? OR 
				transaksi.jaminan LIKE ? OR 
				transaksi.phlebotomy LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "transaksi/search.php";
		}
		$db->join("jenis_darah", "transaksi.jenis_id = jenis_darah.jenis_id", "INNER");
		$db->join("penerima", "transaksi.menerima = penerima.id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("transaksi.id", ORDER_TYPE);
		}
		$db->where("kondisi = 'Ready'");
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
				$record['tanggal'] = format_date($record['tanggal'],'d-m-Y');
$record['jam_mulai'] = format_date($record['jam_mulai'],'Y-m-d H:i:s');
$record['jam_selesai'] = format_date($record['jam_selesai'],'Y-m-d H:i:s');
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
		$page_title = $this->view->page_title = "Transaksi";
		$view_name = (is_ajax() ? "transaksi/ajax-ready.php" : "transaksi/ready.php");
		$this->render_view($view_name, $data);
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function belum($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("transaksi.id", 
			"transaksi.tanggal", 
			"transaksi.mrn", 
			"transaksi.nama", 
			"jenis_darah.jenis AS jenis_darah_jenis", 
			"transaksi.jumlah", 
			"transaksi.keterangan", 
			"penerima.penerima AS penerima_penerima", 
			"transaksi.diagnosa", 
			"transaksi.kondisi");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				transaksi.id LIKE ? OR 
				transaksi.tanggal LIKE ? OR 
				transaksi.mrn LIKE ? OR 
				transaksi.nama LIKE ? OR 
				transaksi.status LIKE ? OR 
				jenis_darah.jenis LIKE ? OR 
				transaksi.jumlah LIKE ? OR 
				transaksi.keterangan LIKE ? OR 
				penerima.penerima LIKE ? OR 
				transaksi.diagnosa LIKE ? OR 
				transaksi.kondisi LIKE ? OR 
				transaksi.menerima LIKE ? OR 
				transaksi.jenis_id LIKE ? OR 
				transaksi.no_kantong LIKE ? OR 
				transaksi.pmi LIKE ? OR 
				transaksi.jam_mulai LIKE ? OR 
				transaksi.jam_selesai LIKE ? OR 
				transaksi.memberi LIKE ? OR 
				transaksi.goldar LIKE ? OR 
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
				jenis_darah.jenis_id LIKE ? OR 
				jenis_darah.stok LIKE ? OR 
				jenis_darah.goldar LIKE ? OR 
				penerima.id LIKE ? OR 
				transaksi.reaksi LIKE ? OR 
				transaksi.gejala LIKE ? OR 
				transaksi.tindak_lanjut LIKE ? OR 
				transaksi.pelapor LIKE ? OR 
				transaksi.jam_reaksi LIKE ? OR 
				transaksi.jam_lapor LIKE ? OR 
				transaksi.hbawal LIKE ? OR 
				transaksi.jaminan LIKE ? OR 
				transaksi.phlebotomy LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "transaksi/search.php";
		}
		$db->join("jenis_darah", "transaksi.jenis_id = jenis_darah.jenis_id", "INNER");
		$db->join("penerima", "transaksi.menerima = penerima.id", "LEFT");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("transaksi.id", ORDER_TYPE);
		}
		$db->where("kondisi = 'Belum'");
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
		$page_title = $this->view->page_title = "Transaksi";
		$view_name = (is_ajax() ? "transaksi/ajax-belum.php" : "transaksi/belum.php");
		$this->render_view($view_name, $data);
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function pengembalian_dash($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("transaksi.id", 
			"transaksi.tanggal", 
			"transaksi.mrn", 
			"transaksi.nama", 
			"transaksi.diagnosa", 
			"jenis_darah.jenis AS jenis_darah_jenis", 
			"transaksi.jumlah_kembali", 
			"penerima.penerima AS penerima_penerima", 
			"transaksi.alasan", 
			"transaksi.status", 
			"transaksi.hbawal", 
			"transaksi.jaminan");
		$pagination = $this->get_pagination(50); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				transaksi.id LIKE ? OR 
				transaksi.tanggal LIKE ? OR 
				transaksi.mrn LIKE ? OR 
				transaksi.nama LIKE ? OR 
				transaksi.diagnosa LIKE ? OR 
				jenis_darah.jenis LIKE ? OR 
				transaksi.jumlah LIKE ? OR 
				transaksi.jumlah_kembali LIKE ? OR 
				penerima.penerima LIKE ? OR 
				transaksi.alasan LIKE ? OR 
				transaksi.status LIKE ? OR 
				transaksi.keterangan LIKE ? OR 
				transaksi.jenis_id LIKE ? OR 
				goldar.golongan_darah LIKE ? OR 
				transaksi.goldar LIKE ? OR 
				transaksi.no_kantong LIKE ? OR 
				transaksi.kondisi LIKE ? OR 
				transaksi.pmi LIKE ? OR 
				transaksi.menerima LIKE ? OR 
				transaksi.jam_mulai LIKE ? OR 
				transaksi.jam_selesai LIKE ? OR 
				transaksi.memberi LIKE ? OR 
				penerima.id LIKE ? OR 
				goldar.id LIKE ? OR 
				jenis_darah.jenis_id LIKE ? OR 
				jenis_darah.stok LIKE ? OR 
				jenis_darah.goldar LIKE ? OR 
				transaksi.pengembalian LIKE ? OR 
				transaksi.tgl_kembali LIKE ? OR 
				transaksi.no_labu_kembali LIKE ? OR 
				transaksi.tgl_kadaluarsa LIKE ? OR 
				transaksi.harga LIKE ? OR 
				transaksi.crosscheck LIKE ? OR 
				transaksi.mayor LIKE ? OR 
				transaksi.minor LIKE ? OR 
				transaksi.auto_control LIKE ? OR 
				transaksi.kesimpulan LIKE ? OR 
				transaksi.petugas_bdrs LIKE ? OR 
				transaksi.pengambilan LIKE ? OR 
				transaksi.perawat LIKE ? OR 
				transaksi.reaksi LIKE ? OR 
				transaksi.gejala LIKE ? OR 
				transaksi.tindak_lanjut LIKE ? OR 
				transaksi.pelapor LIKE ? OR 
				transaksi.jam_reaksi LIKE ? OR 
				transaksi.jam_lapor LIKE ? OR 
				transaksi.hbawal LIKE ? OR 
				transaksi.jaminan LIKE ? OR 
				transaksi.phlebotomy LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "transaksi/search.php";
		}
		$db->join("penerima", "transaksi.menerima = penerima.id", "INNER");
		$db->join("goldar", "transaksi.goldar = goldar.id", "INNER");
		$db->join("jenis_darah", "transaksi.jenis_id = jenis_darah.jenis_id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("transaksi.id", ORDER_TYPE);
		}
		$db->where("pengembalian= 'Ya' and jumlah_kembali <> 0 and YEAR(tanggal) = YEAR(CURDATE()) AND Month(tanggal) = Month(CURDATE())");
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
		$page_title = $this->view->page_title = "Rekap Pengembalian";
		$view_name = (is_ajax() ? "transaksi/ajax-pengembalian_dash.php" : "transaksi/pengembalian_dash.php");
		$this->render_view($view_name, $data);
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function rujukanpmi($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("transaksi.id", 
			"transaksi.tanggal", 
			"transaksi.nama", 
			"transaksi.mrn", 
			"transaksi.pmi", 
			"goldar.golongan_darah AS goldar_golongan_darah", 
			"jenis_darah.jenis AS jenis_darah_jenis", 
			"transaksi.no_kantong", 
			"transaksi.diagnosa", 
			"transaksi.jumlah", 
			"transaksi.harga", 
			"jumlah * harga AS total", 
			"transaksi.crosscheck", 
			"transaksi.phlebotomy");
		$pagination = $this->get_pagination(200); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				transaksi.id LIKE ? OR 
				transaksi.tanggal LIKE ? OR 
				transaksi.nama LIKE ? OR 
				transaksi.mrn LIKE ? OR 
				transaksi.keterangan LIKE ? OR 
				transaksi.jenis_id LIKE ? OR 
				transaksi.status LIKE ? OR 
				transaksi.menerima LIKE ? OR 
				transaksi.pmi LIKE ? OR 
				goldar.golongan_darah LIKE ? OR 
				jenis_darah.jenis LIKE ? OR 
				transaksi.no_kantong LIKE ? OR 
				transaksi.diagnosa LIKE ? OR 
				transaksi.jumlah LIKE ? OR 
				transaksi.harga LIKE ? OR 
				transaksi.jam_mulai LIKE ? OR 
				transaksi.jam_selesai LIKE ? OR 
				transaksi.memberi LIKE ? OR 
				transaksi.goldar LIKE ? OR 
				transaksi.kondisi LIKE ? OR 
				transaksi.pengembalian LIKE ? OR 
				transaksi.jumlah_kembali LIKE ? OR 
				transaksi.tgl_kembali LIKE ? OR 
				transaksi.no_labu_kembali LIKE ? OR 
				transaksi.tgl_kadaluarsa LIKE ? OR 
				transaksi.alasan LIKE ? OR 
				transaksi.crosscheck LIKE ? OR 
				transaksi.mayor LIKE ? OR 
				transaksi.minor LIKE ? OR 
				transaksi.auto_control LIKE ? OR 
				transaksi.kesimpulan LIKE ? OR 
				transaksi.petugas_bdrs LIKE ? OR 
				transaksi.pengambilan LIKE ? OR 
				transaksi.perawat LIKE ? OR 
				transaksi.reaksi LIKE ? OR 
				transaksi.gejala LIKE ? OR 
				transaksi.tindak_lanjut LIKE ? OR 
				transaksi.pelapor LIKE ? OR 
				transaksi.jam_reaksi LIKE ? OR 
				transaksi.jam_lapor LIKE ? OR 
				transaksi.hbawal LIKE ? OR 
				transaksi.jaminan LIKE ? OR 
				transaksi.phlebotomy LIKE ? OR 
				jenis_darah.jenis_id LIKE ? OR 
				jenis_darah.stok LIKE ? OR 
				jenis_darah.goldar LIKE ? OR 
				goldar.id LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "transaksi/search.php";
		}
		$db->join("jenis_darah", "transaksi.jenis_id = jenis_darah.jenis_id", "LEFT");
		$db->join("goldar", "transaksi.goldar = goldar.id", "LEFT");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("tanggal", "DESC");
		}
		$db->where("kondisi IN('Selesai' ,'Ready','phlebotomy')");
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->transaksi_tanggal)){
			$vals = explode("-to-", str_replace(" ", "", $request->transaksi_tanggal));
			$startdate = $vals[0];
			$enddate = $vals[1];
			$db->where("transaksi.tanggal BETWEEN '$startdate' AND '$enddate'");
		}
		if(!empty($request->transaksi_pmi)){
			$val = $request->transaksi_pmi;
			$db->where("transaksi.pmi", $val , "=");
		}
		if(!empty($request->transaksi_crosscheck)){
			$val = $request->transaksi_crosscheck;
			$db->where("transaksi.crosscheck", $val , "=");
		}
		if(!empty($request->transaksi_phlebotomy)){
			$val = $request->transaksi_phlebotomy;
			$db->where("transaksi.phlebotomy", $val , "=");
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
		$page_title = $this->view->page_title = "Rekap Rujukan PMI";
		$this->view->report_filename = date('d-m-Y') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "landscape";
		$this->view->report_hidden_fields = array('id');
		$this->render_view("transaksi/rujukanpmi.php", $data); //render the full page
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function dropping($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("transaksi.id", 
			"transaksi.tanggal", 
			"transaksi.pmi", 
			"jenis_darah.jenis AS jenis_darah_jenis", 
			"goldar.golongan_darah AS goldar_golongan_darah", 
			"transaksi.jumlah", 
			"transaksi.no_kantong");
		$pagination = $this->get_pagination(200); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				transaksi.id LIKE ? OR 
				transaksi.tanggal LIKE ? OR 
				transaksi.pmi LIKE ? OR 
				jenis_darah.jenis LIKE ? OR 
				goldar.golongan_darah LIKE ? OR 
				transaksi.jumlah LIKE ? OR 
				transaksi.no_kantong LIKE ? OR 
				transaksi.keterangan LIKE ? OR 
				transaksi.jenis_id LIKE ? OR 
				transaksi.status LIKE ? OR 
				transaksi.menerima LIKE ? OR 
				transaksi.jam_mulai LIKE ? OR 
				transaksi.jam_selesai LIKE ? OR 
				transaksi.memberi LIKE ? OR 
				transaksi.goldar LIKE ? OR 
				transaksi.kondisi LIKE ? OR 
				transaksi.mrn LIKE ? OR 
				transaksi.nama LIKE ? OR 
				transaksi.pengembalian LIKE ? OR 
				transaksi.jumlah_kembali LIKE ? OR 
				transaksi.tgl_kembali LIKE ? OR 
				transaksi.no_labu_kembali LIKE ? OR 
				transaksi.tgl_kadaluarsa LIKE ? OR 
				transaksi.alasan LIKE ? OR 
				transaksi.harga LIKE ? OR 
				jenis_darah.jenis_id LIKE ? OR 
				jenis_darah.stok LIKE ? OR 
				jenis_darah.goldar LIKE ? OR 
				goldar.id LIKE ? OR 
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
				transaksi.jam_reaksi LIKE ? OR 
				transaksi.jam_lapor LIKE ? OR 
				transaksi.hbawal LIKE ? OR 
				transaksi.jaminan LIKE ? OR 
				transaksi.phlebotomy LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "transaksi/search.php";
		}
		$db->join("jenis_darah", "transaksi.jenis_id = jenis_darah.jenis_id", "INNER");
		$db->join("goldar", "transaksi.goldar = goldar.id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("tanggal", "DESC");
		}
		$db->where("kondisi = 'Dropping'");
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->transaksi_tanggal)){
			$vals = explode("-to-", str_replace(" ", "", $request->transaksi_tanggal));
			$startdate = $vals[0];
			$enddate = $vals[1];
			$db->where("transaksi.tanggal BETWEEN '$startdate' AND '$enddate'");
		}
		if(!empty($request->transaksi_pmi)){
			$val = $request->transaksi_pmi;
			$db->where("transaksi.pmi", $val , "=");
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
		$page_title = $this->view->page_title = "Laporan Dropping Labu Darah";
		$this->view->report_filename = date('d-m-Y') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "landscape";
		$view_name = (is_ajax() ? "transaksi/ajax-dropping.php" : "transaksi/dropping.php");
		$this->render_view($view_name, $data);
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function reaksi_transfusi($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("transaksi.id", 
			"transaksi.tanggal", 
			"transaksi.jam_reaksi", 
			"transaksi.nama", 
			"transaksi.mrn", 
			"transaksi.diagnosa", 
			"jenis_darah.jenis AS jenis_darah_jenis", 
			"transaksi.no_kantong", 
			"transaksi.gejala", 
			"transaksi.tindak_lanjut", 
			"transaksi.jam_lapor", 
			"transaksi.pelapor");
		$pagination = $this->get_pagination(100); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				transaksi.id LIKE ? OR 
				transaksi.tanggal LIKE ? OR 
				transaksi.jam_reaksi LIKE ? OR 
				transaksi.nama LIKE ? OR 
				transaksi.mrn LIKE ? OR 
				transaksi.diagnosa LIKE ? OR 
				jenis_darah.jenis LIKE ? OR 
				transaksi.no_kantong LIKE ? OR 
				transaksi.keterangan LIKE ? OR 
				transaksi.jenis_id LIKE ? OR 
				transaksi.status LIKE ? OR 
				transaksi.menerima LIKE ? OR 
				transaksi.pmi LIKE ? OR 
				transaksi.jam_mulai LIKE ? OR 
				transaksi.jam_selesai LIKE ? OR 
				transaksi.memberi LIKE ? OR 
				transaksi.goldar LIKE ? OR 
				transaksi.kondisi LIKE ? OR 
				transaksi.jumlah LIKE ? OR 
				transaksi.pengembalian LIKE ? OR 
				transaksi.jumlah_kembali LIKE ? OR 
				transaksi.mayor LIKE ? OR 
				transaksi.tgl_kembali LIKE ? OR 
				transaksi.no_labu_kembali LIKE ? OR 
				transaksi.tgl_kadaluarsa LIKE ? OR 
				transaksi.alasan LIKE ? OR 
				transaksi.harga LIKE ? OR 
				transaksi.crosscheck LIKE ? OR 
				transaksi.minor LIKE ? OR 
				transaksi.auto_control LIKE ? OR 
				transaksi.kesimpulan LIKE ? OR 
				transaksi.petugas_bdrs LIKE ? OR 
				transaksi.pengambilan LIKE ? OR 
				transaksi.perawat LIKE ? OR 
				transaksi.reaksi LIKE ? OR 
				transaksi.gejala LIKE ? OR 
				transaksi.tindak_lanjut LIKE ? OR 
				transaksi.jam_lapor LIKE ? OR 
				transaksi.pelapor LIKE ? OR 
				jenis_darah.jenis_id LIKE ? OR 
				jenis_darah.stok LIKE ? OR 
				jenis_darah.goldar LIKE ? OR 
				transaksi.hbawal LIKE ? OR 
				transaksi.jaminan LIKE ? OR 
				transaksi.phlebotomy LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "transaksi/search.php";
		}
		$db->join("jenis_darah", "transaksi.jenis_id = jenis_darah.jenis_id", "LEFT");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("transaksi.id", ORDER_TYPE);
		}
		$db->where("reaksi = 'Ya'");
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
		$page_title = $this->view->page_title = "Laporan Reaksi Transfusi";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "transaksi/ajax-reaksi_transfusi.php" : "transaksi/reaksi_transfusi.php");
		$this->render_view($view_name, $data);
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function registernew($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("transaksi.id", 
			"transaksi.tanggal", 
			"transaksi.nama", 
			"transaksi.mrn", 
			"penerima.penerima AS penerima_penerima", 
			"transaksi.diagnosa", 
			"goldar.golongan_darah AS goldar_golongan_darah", 
			"jenis_darah.jenis AS jenis_darah_jenis", 
			"transaksi.pmi", 
			"pengambilan_darah.jumlah AS pengambilan_darah_jumlah", 
			"pengambilan_darah.no_kantong AS pengambilan_darah_no_kantong", 
			"transaksi.jam_mulai", 
			"transaksi.mayor", 
			"transaksi.minor", 
			"transaksi.auto_control", 
			"transaksi.kesimpulan", 
			"transaksi.jam_selesai", 
			"transaksi.petugas_bdrs", 
			"pengambilan_darah.perawat AS pengambilan_darah_perawat", 
			"pengambilan_darah.ttd AS pengambilan_darah_ttd", 
			"pengambilan_darah.waktu AS pengambilan_darah_waktu", 
			"transaksi.reaksi", 
			"transaksi.gejala", 
			"transaksi.tindak_lanjut", 
			"transaksi.tgl_kembali", 
			"transaksi.alasan", 
			"transaksi.jam_lapor", 
			"transaksi.hbawal", 
			"transaksi.jaminan", 
			"transaksi.phlebotomy");
		$pagination = $this->get_pagination(100); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				transaksi.id LIKE ? OR 
				transaksi.tanggal LIKE ? OR 
				transaksi.nama LIKE ? OR 
				transaksi.mrn LIKE ? OR 
				penerima.penerima LIKE ? OR 
				transaksi.diagnosa LIKE ? OR 
				goldar.golongan_darah LIKE ? OR 
				jenis_darah.jenis LIKE ? OR 
				transaksi.pmi LIKE ? OR 
				pengambilan_darah.jumlah LIKE ? OR 
				pengambilan_darah.no_kantong LIKE ? OR 
				transaksi.jam_mulai LIKE ? OR 
				transaksi.keterangan LIKE ? OR 
				transaksi.jenis_id LIKE ? OR 
				transaksi.status LIKE ? OR 
				transaksi.menerima LIKE ? OR 
				transaksi.no_kantong LIKE ? OR 
				transaksi.memberi LIKE ? OR 
				transaksi.goldar LIKE ? OR 
				transaksi.kondisi LIKE ? OR 
				transaksi.mayor LIKE ? OR 
				transaksi.minor LIKE ? OR 
				transaksi.auto_control LIKE ? OR 
				transaksi.kesimpulan LIKE ? OR 
				transaksi.jam_selesai LIKE ? OR 
				transaksi.petugas_bdrs LIKE ? OR 
				transaksi.jumlah LIKE ? OR 
				transaksi.pengembalian LIKE ? OR 
				transaksi.jumlah_kembali LIKE ? OR 
				transaksi.no_labu_kembali LIKE ? OR 
				transaksi.tgl_kadaluarsa LIKE ? OR 
				transaksi.harga LIKE ? OR 
				transaksi.crosscheck LIKE ? OR 
				transaksi.pengambilan LIKE ? OR 
				transaksi.perawat LIKE ? OR 
				pengambilan_darah.perawat LIKE ? OR 
				pengambilan_darah.ttd LIKE ? OR 
				pengambilan_darah.waktu LIKE ? OR 
				transaksi.pelapor LIKE ? OR 
				transaksi.jam_reaksi LIKE ? OR 
				transaksi.reaksi LIKE ? OR 
				transaksi.gejala LIKE ? OR 
				transaksi.tindak_lanjut LIKE ? OR 
				transaksi.tgl_kembali LIKE ? OR 
				transaksi.alasan LIKE ? OR 
				goldar.id LIKE ? OR 
				jenis_darah.jenis_id LIKE ? OR 
				jenis_darah.stok LIKE ? OR 
				jenis_darah.goldar LIKE ? OR 
				pemberi.id LIKE ? OR 
				pemberi.pemberi LIKE ? OR 
				penerima.id LIKE ? OR 
				pengambilan_darah.id_transaksi LIKE ? OR 
				transaksi.jam_lapor LIKE ? OR 
				transaksi.hbawal LIKE ? OR 
				transaksi.jaminan LIKE ? OR 
				transaksi.phlebotomy LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "transaksi/search.php";
		}
		$db->join("goldar", "transaksi.goldar = goldar.id", "INNER");
		$db->join("jenis_darah", "transaksi.jenis_id = jenis_darah.jenis_id", "INNER");
		$db->join("pemberi", "transaksi.memberi = pemberi.id", "INNER");
		$db->join("penerima", "transaksi.menerima = penerima.id", "INNER");
		$db->join("pengambilan_darah", "transaksi.id = pengambilan_darah.id_transaksi", "LEFT");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("tanggal", "DESC");
			$db->orderBy("mrn", "ASC");
		}
		$db->where("kondisi IN ('Ready', 'Selesai')");
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->transaksi_tanggal)){
			$vals = explode("-to-", str_replace(" ", "", $request->transaksi_tanggal));
			$startdate = $vals[0];
			$enddate = $vals[1];
			$db->where("transaksi.tanggal BETWEEN '$startdate' AND '$enddate'");
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
		$page_title = $this->view->page_title = "Register Bank Darah";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "landscape";
		$view_name = (is_ajax() ? "transaksi/ajax-registernew.php" : "transaksi/registernew.php");
		$this->render_view($view_name, $data);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function tambahbelum($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("tanggal","mrn","nama","goldar","jenis_id","keterangan","memberi","menerima","jumlah","diagnosa","kondisi","jam_mulai","jam_selesai","jaminan");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal' => 'required',
				'mrn' => 'required',
				'nama' => 'required',
				'goldar' => 'required',
				'jenis_id' => 'required',
				'memberi' => 'required',
				'menerima' => 'required',
				'jumlah' => 'required',
				'diagnosa' => 'required',
				'kondisi' => 'required',
				'jam_mulai' => 'required',
				'jam_selesai' => 'required',
				'jaminan' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal' => 'sanitize_string',
				'mrn' => 'sanitize_string',
				'nama' => 'sanitize_string',
				'goldar' => 'sanitize_string',
				'jenis_id' => 'sanitize_string',
				'keterangan' => 'sanitize_string',
				'memberi' => 'sanitize_string',
				'menerima' => 'sanitize_string',
				'jumlah' => 'sanitize_string',
				'diagnosa' => 'sanitize_string',
				'kondisi' => 'sanitize_string',
				'jam_mulai' => 'sanitize_string',
				'jam_selesai' => 'sanitize_string',
				'jaminan' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Data Berhasil ditambah", "success");
					return	$this->redirect("home");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Transaksi";
		$this->render_view("transaksi/tambahbelum.php");
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function registerbdrs($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("transaksi.id", 
			"transaksi.tanggal", 
			"transaksi.nama", 
			"transaksi.mrn", 
			"penerima.penerima AS penerima_penerima", 
			"transaksi.diagnosa", 
			"goldar.golongan_darah AS goldar_golongan_darah", 
			"jenis_darah.jenis AS jenis_darah_jenis", 
			"transaksi.pmi", 
			"transaksi.jumlah", 
			"detail_labu.jumlah AS detail_labu_jumlah", 
			"detail_labu.no_kantong AS detail_labu_no_kantong", 
			"transaksi.jam_mulai", 
			"transaksi.mayor", 
			"transaksi.minor", 
			"transaksi.auto_control", 
			"transaksi.kesimpulan", 
			"transaksi.jam_selesai", 
			"detail_labu.petugas AS detail_labu_petugas", 
			"detail_labu.perawat AS detail_labu_perawat", 
			"perawat.ttd AS perawat_ttd", 
			"detail_labu.waktu AS detail_labu_waktu", 
			"transaksi.reaksi", 
			"transaksi.gejala", 
			"transaksi.tindak_lanjut", 
			"transaksi.pengembalian", 
			"transaksi.tgl_kembali", 
			"transaksi.alasan");
		$pagination = $this->get_pagination(300); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				transaksi.id LIKE ? OR 
				transaksi.tanggal LIKE ? OR 
				transaksi.nama LIKE ? OR 
				transaksi.mrn LIKE ? OR 
				penerima.penerima LIKE ? OR 
				transaksi.diagnosa LIKE ? OR 
				goldar.golongan_darah LIKE ? OR 
				jenis_darah.jenis LIKE ? OR 
				transaksi.pmi LIKE ? OR 
				transaksi.jumlah LIKE ? OR 
				detail_labu.jumlah LIKE ? OR 
				detail_labu.no_kantong LIKE ? OR 
				transaksi.jam_mulai LIKE ? OR 
				transaksi.keterangan LIKE ? OR 
				transaksi.jenis_id LIKE ? OR 
				transaksi.status LIKE ? OR 
				transaksi.menerima LIKE ? OR 
				transaksi.no_kantong LIKE ? OR 
				transaksi.memberi LIKE ? OR 
				transaksi.goldar LIKE ? OR 
				transaksi.kondisi LIKE ? OR 
				transaksi.jumlah_kembali LIKE ? OR 
				transaksi.no_labu_kembali LIKE ? OR 
				transaksi.tgl_kadaluarsa LIKE ? OR 
				transaksi.harga LIKE ? OR 
				transaksi.crosscheck LIKE ? OR 
				transaksi.mayor LIKE ? OR 
				transaksi.minor LIKE ? OR 
				transaksi.auto_control LIKE ? OR 
				transaksi.kesimpulan LIKE ? OR 
				transaksi.jam_selesai LIKE ? OR 
				detail_labu.petugas LIKE ? OR 
				detail_labu.perawat LIKE ? OR 
				perawat.ttd LIKE ? OR 
				transaksi.petugas_bdrs LIKE ? OR 
				detail_labu.waktu LIKE ? OR 
				transaksi.reaksi LIKE ? OR 
				transaksi.pengambilan LIKE ? OR 
				transaksi.perawat LIKE ? OR 
				transaksi.gejala LIKE ? OR 
				transaksi.tindak_lanjut LIKE ? OR 
				transaksi.pengembalian LIKE ? OR 
				transaksi.tgl_kembali LIKE ? OR 
				transaksi.alasan LIKE ? OR 
				transaksi.pelapor LIKE ? OR 
				transaksi.jam_reaksi LIKE ? OR 
				transaksi.jam_lapor LIKE ? OR 
				transaksi.hbawal LIKE ? OR 
				transaksi.jaminan LIKE ? OR 
				penerima.id LIKE ? OR 
				goldar.id LIKE ? OR 
				jenis_darah.jenis_id LIKE ? OR 
				jenis_darah.stok LIKE ? OR 
				jenis_darah.goldar LIKE ? OR 
				detail_labu.id LIKE ? OR 
				detail_labu.id_transaksi LIKE ? OR 
				perawat.id LIKE ? OR 
				perawat.nama LIKE ? OR 
				transaksi.phlebotomy LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "transaksi/search.php";
		}
		$db->join("penerima", "transaksi.menerima = penerima.id", "LEFT");
		$db->join("goldar", "transaksi.goldar = goldar.id", "INNER");
		$db->join("jenis_darah", "transaksi.jenis_id = jenis_darah.jenis_id", "INNER");
		$db->join("detail_labu", "transaksi.id = detail_labu.id_transaksi", "INNER");
		$db->join("perawat", "detail_labu.perawat = perawat.nama", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("tanggal", "DESC");
			$db->orderBy("mrn", "ASC");
		}
		$db->where("kondisi IN ('Ready', 'Selesai')and YEAR(tanggal) = YEAR(CURDATE()) AND month(tanggal)= month (curdate())");
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->transaksi_tanggal)){
			$vals = explode("-to-", str_replace(" ", "", $request->transaksi_tanggal));
			$startdate = $vals[0];
			$enddate = $vals[1];
			$db->where("transaksi.tanggal BETWEEN '$startdate' AND '$enddate'");
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
		$page_title = $this->view->page_title = "Register Bank Darah";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "landscape";
		$this->view->report_list_sequence = false;
		$view_name = (is_ajax() ? "transaksi/ajax-registerbdrs.php" : "transaksi/registerbdrs.php");
		$this->render_view($view_name, $data);
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function registerbackup($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("transaksi.id", 
			"transaksi.tanggal", 
			"transaksi.nama", 
			"transaksi.mrn", 
			"penerima.penerima AS penerima_penerima", 
			"transaksi.diagnosa", 
			"goldar.golongan_darah AS goldar_golongan_darah", 
			"jenis_darah.jenis AS jenis_darah_jenis", 
			"transaksi.pmi", 
			"transaksi.jumlah", 
			"pengambilan_darah.jumlah AS pengambilan_darah_jumlah", 
			"pengambilan_darah.no_kantong AS pengambilan_darah_no_kantong", 
			"transaksi.jam_mulai", 
			"transaksi.mayor", 
			"transaksi.minor", 
			"transaksi.auto_control", 
			"transaksi.kesimpulan", 
			"transaksi.jam_selesai", 
			"pengambilan_darah.petugas AS pengambilan_darah_petugas", 
			"pengambilan_darah.perawat AS pengambilan_darah_perawat", 
			"pengambilan_darah.ttd AS pengambilan_darah_ttd", 
			"pengambilan_darah.waktu AS pengambilan_darah_waktu", 
			"transaksi.reaksi", 
			"transaksi.gejala", 
			"transaksi.tindak_lanjut", 
			"transaksi.pengembalian", 
			"transaksi.tgl_kembali", 
			"transaksi.alasan", 
			"transaksi.phlebotomy");
		$pagination = $this->get_pagination(10); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				transaksi.id LIKE ? OR 
				transaksi.tanggal LIKE ? OR 
				transaksi.nama LIKE ? OR 
				transaksi.mrn LIKE ? OR 
				penerima.penerima LIKE ? OR 
				transaksi.diagnosa LIKE ? OR 
				goldar.golongan_darah LIKE ? OR 
				jenis_darah.jenis LIKE ? OR 
				transaksi.pmi LIKE ? OR 
				transaksi.jumlah LIKE ? OR 
				pengambilan_darah.jumlah LIKE ? OR 
				pengambilan_darah.no_kantong LIKE ? OR 
				transaksi.jam_mulai LIKE ? OR 
				transaksi.keterangan LIKE ? OR 
				transaksi.jenis_id LIKE ? OR 
				transaksi.status LIKE ? OR 
				transaksi.menerima LIKE ? OR 
				transaksi.no_kantong LIKE ? OR 
				transaksi.memberi LIKE ? OR 
				transaksi.goldar LIKE ? OR 
				transaksi.kondisi LIKE ? OR 
				transaksi.jumlah_kembali LIKE ? OR 
				transaksi.no_labu_kembali LIKE ? OR 
				transaksi.tgl_kadaluarsa LIKE ? OR 
				transaksi.harga LIKE ? OR 
				transaksi.crosscheck LIKE ? OR 
				transaksi.mayor LIKE ? OR 
				transaksi.minor LIKE ? OR 
				transaksi.auto_control LIKE ? OR 
				transaksi.kesimpulan LIKE ? OR 
				transaksi.jam_selesai LIKE ? OR 
				transaksi.petugas_bdrs LIKE ? OR 
				pengambilan_darah.petugas LIKE ? OR 
				pengambilan_darah.perawat LIKE ? OR 
				pengambilan_darah.waktu LIKE ? OR 
				transaksi.reaksi LIKE ? OR 
				transaksi.pengambilan LIKE ? OR 
				transaksi.perawat LIKE ? OR 
				transaksi.gejala LIKE ? OR 
				transaksi.tindak_lanjut LIKE ? OR 
				transaksi.pengembalian LIKE ? OR 
				transaksi.tgl_kembali LIKE ? OR 
				transaksi.alasan LIKE ? OR 
				transaksi.pelapor LIKE ? OR 
				transaksi.jam_reaksi LIKE ? OR 
				penerima.id LIKE ? OR 
				goldar.id LIKE ? OR 
				jenis_darah.jenis_id LIKE ? OR 
				jenis_darah.stok LIKE ? OR 
				jenis_darah.goldar LIKE ? OR 
				pengambilan_darah.id_transaksi LIKE ? OR 
				transaksi.jam_lapor LIKE ? OR 
				transaksi.hbawal LIKE ? OR 
				transaksi.jaminan LIKE ? OR 
				transaksi.phlebotomy LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "transaksi/search.php";
		}
		$db->join("penerima", "transaksi.menerima = penerima.id", "LEFT");
		$db->join("goldar", "transaksi.goldar = goldar.id", "INNER");
		$db->join("jenis_darah", "transaksi.jenis_id = jenis_darah.jenis_id", "INNER");
		$db->join("pengambilan_darah", "transaksi.id = pengambilan_darah.id_transaksi", "LEFT");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("tanggal", "DESC");
			$db->orderBy("mrn", "ASC");
		}
		$db->where("kondisi IN ('Ready', 'Selesai')");
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->transaksi_tanggal)){
			$vals = explode("-to-", str_replace(" ", "", $request->transaksi_tanggal));
			$startdate = $vals[0];
			$enddate = $vals[1];
			$db->where("transaksi.tanggal BETWEEN '$startdate' AND '$enddate'");
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
		$page_title = $this->view->page_title = "Register Bank Darah";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "landscape";
		$this->view->report_list_sequence = false;
		$view_name = (is_ajax() ? "transaksi/ajax-registerbackup.php" : "transaksi/registerbackup.php");
		$this->render_view($view_name, $data);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function tambahdropping($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("tanggal","keterangan","pmi","goldar","jenis_id","jumlah","no_kantong","kondisi");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal' => 'required',
				'keterangan' => 'required',
				'pmi' => 'required',
				'goldar' => 'required',
				'jenis_id' => 'required',
				'jumlah' => 'required|numeric',
				'no_kantong' => 'required',
				'kondisi' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal' => 'sanitize_string',
				'keterangan' => 'sanitize_string',
				'pmi' => 'sanitize_string',
				'goldar' => 'sanitize_string',
				'jenis_id' => 'sanitize_string',
				'jumlah' => 'sanitize_string',
				'no_kantong' => 'sanitize_string',
				'kondisi' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Data Berhasil ditambah", "success");
					return	$this->redirect("transaksi/dropping");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Tanbah Dropping";
		$this->render_view("transaksi/tambahdropping.php");
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function phlebotomy($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("tanggal","pmi","kondisi","mrn","nama","jumlah","harga","crosscheck","phlebotomy");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal' => 'required',
				'pmi' => 'required',
				'mrn' => 'required',
				'nama' => 'required',
				'jumlah' => 'numeric',
				'harga' => 'required',
				'crosscheck' => 'required',
				'phlebotomy' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal' => 'sanitize_string',
				'pmi' => 'sanitize_string',
				'kondisi' => 'sanitize_string',
				'mrn' => 'sanitize_string',
				'nama' => 'sanitize_string',
				'jumlah' => 'sanitize_string',
				'harga' => 'sanitize_string',
				'crosscheck' => 'sanitize_string',
				'phlebotomy' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Data Berhasil ditambah", "success");
					return	$this->redirect("transaksi/phlebotomy_list");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Tambah Data Phlebotomy";
		$this->render_view("transaksi/phlebotomy.php");
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function phlebotomy_list($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("id", 
			"tanggal", 
			"pmi", 
			"jumlah", 
			"mrn", 
			"nama", 
			"harga");
		$pagination = $this->get_pagination(200); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				transaksi.id LIKE ? OR 
				transaksi.tanggal LIKE ? OR 
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
				transaksi.mrn LIKE ? OR 
				transaksi.nama LIKE ? OR 
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
				transaksi.jam_reaksi LIKE ? OR 
				transaksi.jam_lapor LIKE ? OR 
				transaksi.hbawal LIKE ? OR 
				transaksi.jaminan LIKE ? OR 
				transaksi.phlebotomy LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "transaksi/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("transaksi.id", ORDER_TYPE);
		}
		$db->where("phlebotomy = 'Ya'");
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
		$page_title = $this->view->page_title = "Rujukan Phlebotomy";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("transaksi/phlebotomy_list.php", $data); //render the full page
	}
}
