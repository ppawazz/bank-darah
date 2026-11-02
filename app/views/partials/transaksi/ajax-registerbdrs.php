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
    <td class="td-goldar_golongan_darah"> <?php echo $data['goldar_golongan_darah']; ?></td>
    <td class="td-jenis_darah_jenis"> <?php echo $data['jenis_darah_jenis']; ?></td>
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
    <td class="td-jumlah"> <?php echo $data['jumlah']; ?></td>
    <td class="td-detail_labu_jumlah"> <?php echo $data['detail_labu_jumlah']; ?></td>
    <td class="td-detail_labu_no_kantong"> <?php echo $data['detail_labu_no_kantong']; ?></td>
    <td class="td-jam_mulai"> <?php echo $data['jam_mulai']; ?></td>
    <td class="td-mayor">
        <span  data-source='<?php echo json_encode_quote(Menu :: $mayor); ?>' 
            data-value="<?php echo $data['mayor']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="mayor" 
            data-title="Enter Mayor" 
            data-placement="left" 
            data-toggle="click" 
            data-type="radiolist" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['mayor']; ?> 
        </span>
    </td>
    <td class="td-minor">
        <span  data-source='<?php echo json_encode_quote(Menu :: $mayor); ?>' 
            data-value="<?php echo $data['minor']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="minor" 
            data-title="Enter Minor" 
            data-placement="left" 
            data-toggle="click" 
            data-type="radiolist" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['minor']; ?> 
        </span>
    </td>
    <td class="td-auto_control">
        <span  data-source='<?php echo json_encode_quote(Menu :: $mayor); ?>' 
            data-value="<?php echo $data['auto_control']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="auto_control" 
            data-title="Enter Auto Control" 
            data-placement="left" 
            data-toggle="click" 
            data-type="radiolist" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['auto_control']; ?> 
        </span>
    </td>
    <td class="td-kesimpulan">
        <span  data-source='<?php echo json_encode_quote(Menu :: $kesimpulan); ?>' 
            data-value="<?php echo $data['kesimpulan']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="kesimpulan" 
            data-title="Enter Kesimpulan" 
            data-placement="left" 
            data-toggle="click" 
            data-type="radiolist" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['kesimpulan']; ?> 
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
    <td class="td-detail_labu_petugas"> <?php echo $data['detail_labu_petugas']; ?></td>
    <td class="td-detail_labu_perawat"> <?php echo $data['detail_labu_perawat']; ?></td>
    <td class="td-perawat_ttd"><?php Html :: page_img($data['perawat_ttd'],70,38,1); ?></td>
    <td class="td-detail_labu_waktu">
        <span  data-flatpickr="{altFormat: 'd-m-Y H:i:s', minDate: '', maxDate: ''}" 
            data-value="<?php echo $data['detail_labu_waktu']; ?>" 
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
            <?php echo $data['detail_labu_waktu']; ?> 
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
    <td class="td-gejala">
        <span  data-value="<?php echo $data['gejala']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="gejala" 
            data-title="Gejala" 
            data-placement="left" 
            data-toggle="click" 
            data-type="text" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['gejala']; ?> 
        </span>
    </td>
    <td class="td-tindak_lanjut">
        <span  data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="tindak_lanjut" 
            data-title="Tindak Lanjut" 
            data-placement="left" 
            data-toggle="click" 
            data-type="textarea" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['tindak_lanjut']; ?> 
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
