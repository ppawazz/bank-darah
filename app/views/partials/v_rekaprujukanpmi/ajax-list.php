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
$sum_of_total = 0;
foreach($records as $data){
$rec_id = (!empty($data['']) ? urlencode($data['']) : null);
$counter++;
$sum_of_total = $sum_of_total + $data['total'];
?>
<tr>
    <td class="td-tanggal"> <?php echo $data['tanggal']; ?></td>
    <td class="td-nama"> <?php echo $data['nama']; ?></td>
    <td class="td-mrn"> <?php echo $data['mrn']; ?></td>
    <td class="td-pmi"> <?php echo $data['pmi']; ?></td>
    <td class="td-golongan_darah"> <?php echo $data['golongan_darah']; ?></td>
    <td class="td-jenis"> <?php echo $data['jenis']; ?></td>
    <td class="td-no_kantong"> <?php echo $data['no_kantong']; ?></td>
    <td class="td-jumlah"> <?php echo $data['jumlah']; ?></td>
    <td class="td-harga"> <?php echo $data['harga']; ?></td>
    <td class="td-total"> <span><?php echo "Rp. ".number_format($data['total']); ?><span></td>
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
    