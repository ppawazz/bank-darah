<?php
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
if (!empty($records)) {
?>
<!--record-->
<?php
$counter = 0;
foreach($records as $data){
$rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
$counter++;
?>
<tr>
    <th class="td-sno"><?php echo $counter; ?></th>
    <td class="td-nama">
        <span  data-value="<?php echo $data['nama']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("petugas_lab/editfield/" . urlencode($data['id'])); ?>" 
            data-name="nama" 
            data-title="Enter Nama" 
            data-placement="left" 
            data-toggle="click" 
            data-type="text" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['nama']; ?> 
        </span>
    </td>
    <td class="td-date_deleted">
        <span  data-flatpickr="{ minDate: '', maxDate: ''}" 
            data-value="<?php echo $data['date_deleted']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("petugas_lab/editfield/" . urlencode($data['id'])); ?>" 
            data-name="date_deleted" 
            data-title="Enter Date Deleted" 
            data-placement="left" 
            data-toggle="click" 
            data-type="flatdatetimepicker" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['date_deleted']; ?> 
        </span>
    </td>
    <td class="td-is_deleted">
        <span  data-value="<?php echo $data['is_deleted']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("petugas_lab/editfield/" . urlencode($data['id'])); ?>" 
            data-name="is_deleted" 
            data-title="Enter Is Deleted" 
            data-placement="left" 
            data-toggle="click" 
            data-type="text" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['is_deleted']; ?> 
        </span>
    </td>
</tr>
<?php 
}
?>
<?php
} else {
?>
<td class="no-record-found col-12" colspan="100">
    <h4 class="text-muted text-center ">
        No Record Found
    </h4>
</td>
<?php
}
?>
