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
    <td class="td-tgl_sampling"> <?php echo $data['tgl_sampling']; ?></td>
    <td class="td-nama"> <?php echo $data['nama']; ?></td>
    <td class="td-mrn"> <?php echo $data['mrn']; ?></td>
    <td class="td-penerima_penerima"> <?php echo $data['penerima_penerima']; ?></td>
    <td class="td-jenis_pemeriksaan"> <?php echo $data['jenis_pemeriksaan']; ?></td>
    <td class="td-hasil_bdrs">
        <span  data-value="<?php echo $data['hasil_bdrs']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("kultur/editfield/" . urlencode($data['id'])); ?>" 
            data-name="hasil_bdrs" 
            data-title="Enter Hasil Bdrs" 
            data-placement="left" 
            data-toggle="click" 
            data-type="text" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['hasil_bdrs']; ?> 
        </span>
    </td>
    <td class="td-hasil_lab"> <?php echo $data['hasil_lab']; ?></td>
    <td class="td-file">
        <span  data-value="<?php echo $data['file']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("kultur/editfield/" . urlencode($data['id'])); ?>" 
            data-name="file" 
            data-title="Browse..." 
            data-placement="left" 
            data-toggle="click" 
            data-type="text" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['file']; ?> 
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
