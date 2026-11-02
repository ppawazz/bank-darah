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
    <td class="td-tanggal">
        <span  data-flatpickr="{altFormat: 'd-m-Y', enableTime: false, minDate: '', maxDate: ''}" 
            data-value="<?php echo $data['tanggal']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="tanggal" 
            data-title="Tanggal" 
            data-placement="left" 
            data-toggle="click" 
            data-type="flatdatetimepicker" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['tanggal']; ?> 
        </span>
    </td>
    <td class="td-mrn">
        <span  data-value="<?php echo $data['mrn']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="mrn" 
            data-title="Mrn" 
            data-placement="left" 
            data-toggle="click" 
            data-type="text" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['mrn']; ?> 
        </span>
    </td>
    <td class="td-nama">
        <span  data-value="<?php echo $data['nama']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="nama" 
            data-title="Nama" 
            data-placement="left" 
            data-toggle="click" 
            data-type="text" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['nama']; ?> 
        </span>
    </td>
    <td class="td-jenis_darah_jenis">
        <span  data-value="<?php echo $data['jenis_darah_jenis']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("jenis_darah/editfield/" . urlencode($data['jenis_id'])); ?>" 
            data-name="jenis" 
            data-title="Enter Jenis" 
            data-placement="left" 
            data-toggle="click" 
            data-type="text" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['jenis_darah_jenis']; ?> 
        </span>
    </td>
    <td class="td-jumlah">
        <span  data-value="<?php echo $data['jumlah']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
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
    <td class="td-keterangan">
        <span  data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="keterangan" 
            data-title="Keterangan" 
            data-placement="left" 
            data-toggle="click" 
            data-type="textarea" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['keterangan']; ?> 
        </span>
    </td>
    <td class="td-penerima_penerima"> <?php echo $data['penerima_penerima']; ?></td>
    <td class="td-diagnosa">
        <span  data-value="<?php echo $data['diagnosa']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="diagnosa" 
            data-title="Diagnosa" 
            data-placement="left" 
            data-toggle="click" 
            data-type="text" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['diagnosa']; ?> 
        </span>
    </td>
    <td class="td-kondisi">
        <span  data-source='<?php echo json_encode_quote(Menu :: $kondisi); ?>' 
            data-value="<?php echo $data['kondisi']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="kondisi" 
            data-title="--Pilih Data--" 
            data-placement="left" 
            data-toggle="click" 
            data-type="select" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['kondisi']; ?> 
        </span>
    </td>
    <th class="td-btn">
        <a class="btn btn-sm btn-info has-tooltip page-modal" title="Edit This Record" href="<?php print_link("transaksi/edit/$rec_id"); ?>">
            <i class="fa fa-edit"></i> Edit
        </a>
        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("transaksi/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Apakah anda yakin akan menghapus data ini?" data-display-style="modal">
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
