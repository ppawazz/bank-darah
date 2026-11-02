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
$rec_id = (!empty($data['']) ? urlencode($data['']) : null);
$counter++;
?>
<tr>
    <th class="td-sno"><?php echo $counter; ?></th>
    <td class="td-tanggal"> <?php echo $data['tanggal']; ?></td>
    <td class="td-mrn"> <?php echo $data['mrn']; ?></td>
    <td class="td-nama"> <?php echo $data['nama']; ?></td>
    <td class="td-keterangan"> <?php echo $data['keterangan']; ?></td>
    <td class="td-jenis"> <?php echo $data['jenis']; ?></td>
    <td class="td-jumlah"> <?php echo $data['jumlah']; ?></td>
    <td class="td-penerima"> <?php echo $data['penerima']; ?></td>
    <td class="td-jam_mulai"> <?php echo $data['jam_mulai']; ?></td>
    <td class="td-jam_selesai"> <?php echo $data['jam_selesai']; ?></td>
    <td class="td-total_waktu"> <?php echo $data['total_waktu']; ?></td>
    <td class="td-diagnosa"> <?php echo $data['diagnosa']; ?></td>
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
