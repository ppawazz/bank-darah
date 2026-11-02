<?php 
/**
 * Spesimen Page Controller
 * @category  Controller
 */
class SpesimenController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "spesimen";
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
		$fields = $this->fields = array("id","tanggal","mrn","nama","dokter_pengirim","jam_pengambilan","pemeriksaan","pemeriksaan_tambahan","jam_tambahan","petugas_lab","perawat_dokter");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'tanggal' => 'required',
				'mrn' => 'required',
				'nama' => 'required',
				'dokter_pengirim' => 'required',
				'jam_pengambilan' => 'required',
				'pemeriksaan' => 'required',
				'pemeriksaan_tambahan' => 'required',
				'jam_tambahan' => 'required',
				'petugas_lab' => 'required',
				'perawat_dokter' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal' => 'sanitize_string',
				'mrn' => 'sanitize_string',
				'nama' => 'sanitize_string',
				'dokter_pengirim' => 'sanitize_string',
				'jam_pengambilan' => 'sanitize_string',
				'pemeriksaan' => 'sanitize_string',
				'pemeriksaan_tambahan' => 'sanitize_string',
				'jam_tambahan' => 'sanitize_string',
				'petugas_lab' => 'sanitize_string',
				'perawat_dokter' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("spesimen.id", $rec_id);;
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
}
