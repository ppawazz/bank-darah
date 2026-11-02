<?php 
/**
 * Pasien Page Controller
 * @category  Controller
 */
class PasienController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "pasien";
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
		$fields = $this->fields = array("id","tanggal","ri_bpjs_p","rj_bpjs_p","ri_bpjs_s","rj_bpjs_s","ri_bpjs_m","rj_bpjs_m","ri_exe_p","rj_exe_p","ri_exe_s","rj_exe_s","ri_exe_m","rj_exe_m");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'tanggal' => 'required',
				'ri_bpjs_p' => 'required|numeric',
				'rj_bpjs_p' => 'required|numeric',
				'ri_bpjs_s' => 'required|numeric',
				'rj_bpjs_s' => 'required|numeric',
				'ri_bpjs_m' => 'required|numeric',
				'rj_bpjs_m' => 'required|numeric',
				'ri_exe_p' => 'required|numeric',
				'rj_exe_p' => 'required|numeric',
				'ri_exe_s' => 'required|numeric',
				'rj_exe_s' => 'required|numeric',
				'ri_exe_m' => 'required|numeric',
				'rj_exe_m' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'tanggal' => 'sanitize_string',
				'ri_bpjs_p' => 'sanitize_string',
				'rj_bpjs_p' => 'sanitize_string',
				'ri_bpjs_s' => 'sanitize_string',
				'rj_bpjs_s' => 'sanitize_string',
				'ri_bpjs_m' => 'sanitize_string',
				'rj_bpjs_m' => 'sanitize_string',
				'ri_exe_p' => 'sanitize_string',
				'rj_exe_p' => 'sanitize_string',
				'ri_exe_s' => 'sanitize_string',
				'rj_exe_s' => 'sanitize_string',
				'ri_exe_m' => 'sanitize_string',
				'rj_exe_m' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("pasien.id", $rec_id);;
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
