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
    <td class="td-tanggal"> <?php echo $data['tanggal']; ?></td>
    <td class="td-nama"> <?php echo $data['nama']; ?></td>
    <td class="td-mrn"> <?php echo $data['mrn']; ?></td>
    <td class="td-diagnosa"> <?php echo $data['diagnosa']; ?></td>
    <td class="td-no_kantong"> <?php echo $data['no_kantong']; ?></td>
    <td class="td-penerima_penerima"> <?php echo $data['penerima_penerima']; ?></td>
    <td class="td-jenis_darah_jenis"> <?php echo $data['jenis_darah_jenis']; ?></td>
    <td class="td-pmi"> <?php echo $data['pmi']; ?></td>
    <td class="td-jumlah"> <?php echo $data['jumlah']; ?></td>
    <td class="td-jumlah_kembali">
        <span  data-value="<?php echo $data['jumlah_kembali']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="jumlah_kembali" 
            data-title="Jumlah Pengembalian" 
            data-placement="left" 
            data-toggle="click" 
            data-type="number" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['jumlah_kembali']; ?> 
        </span>
    </td>
    <td class="td-no_labu_kembali">
        <span  data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="no_labu_kembali" 
            data-title="No Labu Pengembalian" 
            data-placement="left" 
            data-toggle="click" 
            data-type="textarea" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['no_labu_kembali']; ?> 
        </span>
    </td>
    <td class="td-tgl_kadaluarsa">
        <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
            data-value="<?php echo $data['tgl_kadaluarsa']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="tgl_kadaluarsa" 
            data-title="Tanggal Kadaluarsa" 
            data-placement="left" 
            data-toggle="click" 
            data-type="flatdatetimepicker" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['tgl_kadaluarsa']; ?> 
        </span>
    </td>
    <td class="td-tgl_kembali">
        <span  data-flatpickr="{altFormat: 'd-m-Y', enableTime: false, minDate: '', maxDate: ''}" 
            data-value="<?php echo $data['tgl_kembali']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="tgl_kembali" 
            data-title="Tgl Kembali" 
            data-placement="left" 
            data-toggle="click" 
            data-type="flatdatetimepicker" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['tgl_kembali']; ?> 
        </span>
    </td>
    <td class="td-alasan">
        <span  data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="alasan" 
            data-title="Alasan Pengembalian" 
            data-placement="left" 
            data-toggle="click" 
            data-type="textarea" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['alasan']; ?> 
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
