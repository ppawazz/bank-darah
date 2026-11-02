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
    <td class="td-pemberi_pemberi"> <?php echo $data['pemberi_pemberi']; ?></td>
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
    <td class="td-penerima_penerima"> <?php echo $data['penerima_penerima']; ?></td>
    <td class="td-goldar_golongan_darah"> <?php echo $data['goldar_golongan_darah']; ?></td>
    <td class="td-jenis_darah_jenis"> <?php echo $data['jenis_darah_jenis']; ?></td>
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
    <td class="td-no_kantong">
        <span  data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="no_kantong" 
            data-title="No Kantong" 
            data-placement="left" 
            data-toggle="click" 
            data-type="textarea" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['no_kantong']; ?> 
        </span>
    </td>
    <td class="td-pmi">
        <span  data-source='<?php echo json_encode_quote(Menu :: $pmi); ?>' 
            data-value="<?php echo $data['pmi']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="pmi" 
            data-title="Enter Pmi" 
            data-placement="left" 
            data-toggle="click" 
            data-type="radiolist" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['pmi']; ?> 
        </span>
    </td>
    <td class="td-jam_mulai">
        <span  data-flatpickr="{altFormat: 'd-m-Y H:i:s', minDate: '', maxDate: ''}" 
            data-value="<?php echo $data['jam_mulai']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="jam_mulai" 
            data-title="Jam Mulai" 
            data-placement="left" 
            data-toggle="click" 
            data-type="flatdatetimepicker" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['jam_mulai']; ?> 
        </span>
    </td>
    <td class="td-jam_selesai">
        <span  data-flatpickr="{altFormat: 'd-m-Y H:i:s', minDate: '', maxDate: ''}" 
            data-value="<?php echo $data['jam_selesai']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="jam_selesai" 
            data-title="Jam Selesai" 
            data-placement="left" 
            data-toggle="click" 
            data-type="flatdatetimepicker" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['jam_selesai']; ?> 
        </span>
    </td>
    <td class="td-waktu_cross"> <?php echo $data['waktu_cross']; ?></td>
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
    <td class="td-pengembalian">
        <span  data-source='<?php echo json_encode_quote(Menu :: $pengembalian); ?>' 
            data-value="<?php echo $data['pengembalian']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="pengembalian" 
            data-title="Pengembalian" 
            data-placement="left" 
            data-toggle="click" 
            data-type="radiolist" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['pengembalian']; ?> 
        </span>
    </td>
    <td class="td-reaksi">
        <span  data-source='<?php echo json_encode_quote(Menu :: $pengembalian); ?>' 
            data-value="<?php echo $data['reaksi']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="reaksi" 
            data-title="Enter Reaksi" 
            data-placement="left" 
            data-toggle="click" 
            data-type="radiolist" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['reaksi']; ?> 
        </span>
    </td>
    <td class="td-phlebotomy"> <?php echo $data['phlebotomy']; ?></td>
    <th class="td-btn">
        <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("transaksi/edit/$rec_id"); ?>">
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
