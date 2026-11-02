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
$sum_of_dropping = 0;
$sum_of_sa = 0;
$sum_of_pengembalian = 0;
$sum_of_ready = 0;
$sum_of_selesai = 0;
$sum_of_belum = 0;
$sum_of_pemasukan = 0;
$sum_of_pemakaian = 0;
$sum_of_total = 0;
foreach($records as $data){
$rec_id = (!empty($data['jenis']) ? urlencode($data['jenis']) : null);
$counter++;
$sum_of_dropping = $sum_of_dropping + $data['dropping'];
$sum_of_sa = $sum_of_sa + $data['sa'];
$sum_of_pengembalian = $sum_of_pengembalian + $data['pengembalian'];
$sum_of_ready = $sum_of_ready + $data['ready'];
$sum_of_selesai = $sum_of_selesai + $data['selesai'];
$sum_of_belum = $sum_of_belum + $data['belum'];
$sum_of_pemasukan = $sum_of_pemasukan + $data['pemasukan'];
$sum_of_pemakaian = $sum_of_pemakaian + $data['pemakaian'];
$sum_of_total = $sum_of_total + $data['total'];
?>
<tr>
    <th class="td-sno"><?php echo $counter; ?></th>
    <td class="td-jenis"><a href="<?php print_link("rekap_stok/view/$data[jenis]") ?>"><?php echo $data['jenis']; ?></a></td>
    <td class="td-dropping"> <?php echo $data['dropping']; ?></td>
    <td class="td-sa"> <?php echo $data['sa']; ?></td>
    <td class="td-pengembalian"> <?php echo $data['pengembalian']; ?></td>
    <td class="td-ready"> <?php echo $data['ready']; ?></td>
    <td class="td-selesai"> <?php echo $data['selesai']; ?></td>
    <td class="td-belum"> <?php echo $data['belum']; ?></td>
    <td class="td-pemasukan"> <?php echo $data['pemasukan']; ?></td>
    <td class="td-pemakaian"> <?php echo $data['pemakaian']; ?></td>
    <td class="td-total"> <?php echo $data['total']; ?></td>
    <th class="td-btn">
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
