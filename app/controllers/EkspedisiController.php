<?php 
/**
 * Ekspedisi Page Controller
 * @category  Controller
 */
class EkspedisiController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "ekspedisi";
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
		$fields = $this->fields = array("id","jenis","customer","tgl_po","tgl_terima","tgl_manpro","jatuh_tempo","keterangan","status_po");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'jenis' => 'required|numeric',
				'customer' => 'required|numeric',
				'tgl_po' => 'required',
				'tgl_terima' => 'required',
				'tgl_manpro' => 'required',
				'jatuh_tempo' => 'required',
				'keterangan' => 'required',
				'status_po' => 'required',
			);
			$this->sanitize_array = array(
				'jenis' => 'sanitize_string',
				'customer' => 'sanitize_string',
				'tgl_po' => 'sanitize_string',
				'tgl_terima' => 'sanitize_string',
				'tgl_manpro' => 'sanitize_string',
				'jatuh_tempo' => 'sanitize_string',
				'keterangan' => 'sanitize_string',
				'status_po' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("ekspedisi.id", $rec_id);;
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
