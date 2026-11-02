<?php 
/**
 * Perizinan Page Controller
 * @category  Controller
 */
class PerizinanController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "perizinan";
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
		$fields = $this->fields = array("id","no","lembaga","tgl_perizinan","tgl_akhir","file","kategori");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'no' => 'required',
				'lembaga' => 'required',
				'tgl_perizinan' => 'required',
				'tgl_akhir' => 'required',
				'file' => 'required',
				'kategori' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'no' => 'sanitize_string',
				'lembaga' => 'sanitize_string',
				'tgl_perizinan' => 'sanitize_string',
				'tgl_akhir' => 'sanitize_string',
				'file' => 'sanitize_string',
				'kategori' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("perizinan.id", $rec_id);;
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
