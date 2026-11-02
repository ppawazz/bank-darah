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
    <td class="td-pmi"> <?php echo $data['pmi']; ?></td>
    <td class="td-goldar_golongan_darah"> <?php echo $data['goldar_golongan_darah']; ?></td>
    <td class="td-jenis_darah_jenis"> <?php echo $data['jenis_darah_jenis']; ?></td>
    <td class="td-no_kantong"> <?php echo $data['no_kantong']; ?></td>
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
    <td class="td-jumlah"> <?php echo $data['jumlah']; ?></td>
    <td class="td-harga">
        <span  data-source='<?php echo json_encode_quote(Menu :: $harga); ?>' 
            data-value="<?php echo $data['harga']; ?>" 
            data-pk="<?php echo $data['id'] ?>" 
            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
            data-name="harga" 
            data-title="Select a value ..." 
            data-placement="left" 
            data-toggle="click" 
            data-type="select" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" >
            <?php echo $data['harga']; ?> 
        </span>
    </td>
    <td class="td-total"> <span><?php echo "Rp. ".number_format($data['total']); ?><span></td>
        <td class="td-crosscheck">
            <span  data-source='<?php echo json_encode_quote(Menu :: $crosscheck); ?>' 
                data-value="<?php echo $data['crosscheck']; ?>" 
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                data-name="crosscheck" 
                data-title="Crosscheck" 
                data-placement="left" 
                data-toggle="click" 
                data-type="radiolist" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" >
                <?php echo $data['crosscheck']; ?> 
            </span>
        </td>
        <td class="td-phlebotomy">
            <span  data-value="<?php echo $data['phlebotomy']; ?>" 
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                data-name="phlebotomy" 
                data-title="Enter Phlebotomy" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" >
                <?php echo $data['phlebotomy']; ?> 
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
    