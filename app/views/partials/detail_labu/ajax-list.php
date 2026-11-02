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
    <td class="td-id_transaksi"> <?php echo $data['id_transaksi']; ?></td>
    <td class="td-transaksi_tanggal"> <?php echo $data['transaksi_tanggal']; ?></td>
    <td class="td-transaksi_nama"> <?php echo $data['transaksi_nama']; ?></td>
    <td class="td-transaksi_mrn"> <?php echo $data['transaksi_mrn']; ?></td>
    <td class="td-jumlah">
        <span  data-value="<?php echo $data['jumlah']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("detail_labu/editfield/" . urlencode($data['id'])); ?>" 
            data-name="jumlah" 
            data-title="Jumlah" 
            data-placement="left" 
            data-toggle="click" 
            data-type="number" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['jumlah']; ?> 
        </span>
    </td>
    <td class="td-no_kantong">
        <span  data-value="<?php echo $data['no_kantong']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("detail_labu/editfield/" . urlencode($data['id'])); ?>" 
            data-name="no_kantong" 
            data-title="No Kantong" 
            data-placement="left" 
            data-toggle="click" 
            data-type="text" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['no_kantong']; ?> 
        </span>
    </td>
    <td class="td-petugas">
        <span  data-source='<?php print_link('api/json/detail_labu_petugas_option_list'); ?>' 
            data-value="<?php echo $data['petugas']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("detail_labu/editfield/" . urlencode($data['id'])); ?>" 
            data-name="petugas" 
            data-title="--Pilih Data--" 
            data-placement="left" 
            data-toggle="click" 
            data-type="select" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['petugas']; ?> 
        </span>
    </td>
    <td class="td-perawat">
        <span  data-source='<?php print_link('api/json/detail_labu_perawat_option_list'); ?>' 
            data-value="<?php echo $data['perawat']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("detail_labu/editfield/" . urlencode($data['id'])); ?>" 
            data-name="perawat" 
            data-title="--Pilih Data--" 
            data-placement="left" 
            data-toggle="click" 
            data-type="select" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['perawat']; ?> 
        </span>
    </td>
    <td class="td-waktu">
        <span  data-flatpickr="{altFormat: 'd-m-Y H:i:s', minDate: '', maxDate: ''}" 
            data-value="<?php echo $data['waktu']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("detail_labu/editfield/" . urlencode($data['id'])); ?>" 
            data-name="waktu" 
            data-title="Waktu Pengambilan" 
            data-placement="left" 
            data-toggle="click" 
            data-type="flatdatetimepicker" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['waktu']; ?> 
        </span>
    </td>
    <th class="td-btn">
        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("detail_labu/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Apakah anda yakin akan menghapus data ini?" data-display-style="modal">
            <i class="fa fa-times"></i>
            Delete
        </a>
    </th>
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
