<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Transaksi</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id">
                                        <th class="title"> Id: </th>
                                        <td class="value"> <?php echo $data['id']; ?></td>
                                    </tr>
                                    <tr  class="td-tanggal">
                                        <th class="title"> Tanggal: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-keterangan">
                                        <th class="title"> Keterangan: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-jenis_id">
                                        <th class="title"> Jenis Id: </th>
                                        <td class="value">
                                            <span  data-source='<?php 
                                                $dependent_field = (!empty($data['goldar']) ? urlencode($data['goldar']) : null);
                                                print_link('api/json/transaksi_jenis_id_option_list/'.$dependent_field); 
                                                ?>' 
                                                data-value="<?php echo $data['jenis_id']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="jenis_id" 
                                                data-title="--Pilih Data--" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['jenis_id']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-status">
                                        <th class="title"> Status: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['status']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="status" 
                                                data-title="Hasil Lab" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['status']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-menerima">
                                        <th class="title"> Menerima: </th>
                                        <td class="value">
                                            <span  data-source='<?php print_link('api/json/transaksi_menerima_option_list'); ?>' 
                                                data-value="<?php echo $data['menerima']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="menerima" 
                                                data-title="--Pilih Data--" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['menerima']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-no_kantong">
                                        <th class="title"> No Kantong: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-pmi">
                                        <th class="title"> Pmi: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-jam_mulai">
                                        <th class="title"> Jam Mulai: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-jam_selesai">
                                        <th class="title"> Jam Selesai: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-memberi">
                                        <th class="title"> Memberi: </th>
                                        <td class="value">
                                            <span  data-source='<?php print_link('api/json/transaksi_memberi_option_list'); ?>' 
                                                data-value="<?php echo $data['memberi']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="memberi" 
                                                data-title="--Pilih Data--" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['memberi']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-goldar">
                                        <th class="title"> Goldar: </th>
                                        <td class="value">
                                            <span  data-source='<?php print_link('api/json/transaksi_goldar_option_list'); ?>' 
                                                data-value="<?php echo $data['goldar']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="goldar" 
                                                data-title="--Pilih Data--" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['goldar']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-kondisi">
                                        <th class="title"> Kondisi: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-jumlah">
                                        <th class="title"> Jumlah: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-mrn">
                                        <th class="title"> Mrn: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-nama">
                                        <th class="title"> Nama: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-pengembalian">
                                        <th class="title"> Pengembalian: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-jumlah_kembali">
                                        <th class="title"> Jumlah Kembali: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-tgl_kembali">
                                        <th class="title"> Tgl Kembali: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-no_labu_kembali">
                                        <th class="title"> No Labu Kembali: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-tgl_kadaluarsa">
                                        <th class="title"> Tgl Kadaluarsa: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-alasan">
                                        <th class="title"> Alasan: </th>
                                        <td class="value">
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
                                    <tr  class="td-harga">
                                        <th class="title"> Harga: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-crosscheck">
                                        <th class="title"> Crosscheck: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-mayor">
                                        <th class="title"> Mayor: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-minor">
                                        <th class="title"> Minor: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-auto_control">
                                        <th class="title"> Auto Control: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-kesimpulan">
                                        <th class="title"> Kesimpulan: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-petugas_bdrs">
                                        <th class="title"> Petugas Bdrs: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['petugas_bdrs']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="petugas_bdrs" 
                                                data-title="Enter Petugas Bdrs" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['petugas_bdrs']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-pengambilan">
                                        <th class="title"> Pengambilan: </th>
                                        <td class="value"> <?php echo $data['pengambilan']; ?></td>
                                    </tr>
                                    <tr  class="td-perawat">
                                        <th class="title"> Perawat: </th>
                                        <td class="value"> <?php echo $data['perawat']; ?></td>
                                    </tr>
                                    <tr  class="td-diagnosa">
                                        <th class="title"> Diagnosa: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-reaksi">
                                        <th class="title"> Reaksi: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-gejala">
                                        <th class="title"> Gejala: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-tindak_lanjut">
                                        <th class="title"> Tindak Lanjut: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-pelapor">
                                        <th class="title"> Pelapor: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['pelapor']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="pelapor" 
                                                data-title="Pelapor" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['pelapor']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-jam_reaksi">
                                        <th class="title"> Jam Reaksi: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['jam_reaksi']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="jam_reaksi" 
                                                data-title="Jam Reaksi" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['jam_reaksi']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-perawat_id">
                                        <th class="title"> Perawat Id: </th>
                                        <td class="value"> <?php echo $data['perawat_id']; ?></td>
                                    </tr>
                                    <tr  class="td-perawat_nama">
                                        <th class="title"> Perawat Nama: </th>
                                        <td class="value"> <?php echo $data['perawat_nama']; ?></td>
                                    </tr>
                                    <tr  class="td-perawat_ttd">
                                        <th class="title"> Perawat Ttd: </th>
                                        <td class="value"> <?php echo $data['perawat_ttd']; ?></td>
                                    </tr>
                                    <tr  class="td-pemberi_id">
                                        <th class="title"> Pemberi Id: </th>
                                        <td class="value"> <?php echo $data['pemberi_id']; ?></td>
                                    </tr>
                                    <tr  class="td-pemberi_pemberi">
                                        <th class="title"> Pemberi Pemberi: </th>
                                        <td class="value"> <?php echo $data['pemberi_pemberi']; ?></td>
                                    </tr>
                                    <tr  class="td-jam_lapor">
                                        <th class="title"> Jam Lapor: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['jam_lapor']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="jam_lapor" 
                                                data-title="Jam Lapor" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['jam_lapor']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-hbawal">
                                        <th class="title"> Hbawal: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['hbawal']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="hbawal" 
                                                data-title="Enter Hbawal" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['hbawal']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-jaminan">
                                        <th class="title"> Jaminan: </th>
                                        <td class="value">
                                            <span  data-source='<?php echo json_encode_quote(Menu :: $jaminan); ?>' 
                                                data-value="<?php echo $data['jaminan']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="jaminan" 
                                                data-title="--Pilih Data--" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['jaminan']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-penerima_id">
                                        <th class="title"> Penerima Id: </th>
                                        <td class="value"> <?php echo $data['penerima_id']; ?></td>
                                    </tr>
                                    <tr  class="td-penerima_penerima">
                                        <th class="title"> Penerima Penerima: </th>
                                        <td class="value"> <?php echo $data['penerima_penerima']; ?></td>
                                    </tr>
                                    <tr  class="td-detail_labu_id">
                                        <th class="title"> Detail Labu Id: </th>
                                        <td class="value"> <?php echo $data['detail_labu_id']; ?></td>
                                    </tr>
                                    <tr  class="td-detail_labu_id_transaksi">
                                        <th class="title"> Detail Labu Id Transaksi: </th>
                                        <td class="value"> <?php echo $data['detail_labu_id_transaksi']; ?></td>
                                    </tr>
                                    <tr  class="td-detail_labu_jumlah">
                                        <th class="title"> Detail Labu Jumlah: </th>
                                        <td class="value"> <?php echo $data['detail_labu_jumlah']; ?></td>
                                    </tr>
                                    <tr  class="td-detail_labu_no_kantong">
                                        <th class="title"> Detail Labu No Kantong: </th>
                                        <td class="value"> <?php echo $data['detail_labu_no_kantong']; ?></td>
                                    </tr>
                                    <tr  class="td-detail_labu_perawat">
                                        <th class="title"> Detail Labu Perawat: </th>
                                        <td class="value"> <?php echo $data['detail_labu_perawat']; ?></td>
                                    </tr>
                                    <tr  class="td-detail_labu_waktu">
                                        <th class="title"> Detail Labu Waktu: </th>
                                        <td class="value"> <?php echo $data['detail_labu_waktu']; ?></td>
                                    </tr>
                                    <tr  class="td-detail_labu_petugas">
                                        <th class="title"> Detail Labu Petugas: </th>
                                        <td class="value"> <?php echo $data['detail_labu_petugas']; ?></td>
                                    </tr>
                                    <tr  class="td-perawat_id">
                                        <th class="title"> Perawat Id: </th>
                                        <td class="value"> <?php echo $data['perawat_id']; ?></td>
                                    </tr>
                                    <tr  class="td-perawat_nama">
                                        <th class="title"> Perawat Nama: </th>
                                        <td class="value"> <?php echo $data['perawat_nama']; ?></td>
                                    </tr>
                                    <tr  class="td-perawat_ttd">
                                        <th class="title"> Perawat Ttd: </th>
                                        <td class="value"> <?php echo $data['perawat_ttd']; ?></td>
                                    </tr>
                                    <tr  class="td-phlebotomy">
                                        <th class="title"> Phlebotomy: </th>
                                        <td class="value"> <?php echo $data['phlebotomy']; ?></td>
                                    </tr>
                                    <tr  class="td-jenis_darah_jenis_id">
                                        <th class="title"> Jenis Darah Jenis Id: </th>
                                        <td class="value"> <?php echo $data['jenis_darah_jenis_id']; ?></td>
                                    </tr>
                                    <tr  class="td-jenis_darah_jenis">
                                        <th class="title"> Jenis Darah Jenis: </th>
                                        <td class="value"> <?php echo $data['jenis_darah_jenis']; ?></td>
                                    </tr>
                                    <tr  class="td-jenis_darah_stok">
                                        <th class="title"> Jenis Darah Stok: </th>
                                        <td class="value"> <?php echo $data['jenis_darah_stok']; ?></td>
                                    </tr>
                                    <tr  class="td-jenis_darah_goldar">
                                        <th class="title"> Jenis Darah Goldar: </th>
                                        <td class="value"> <?php echo $data['jenis_darah_goldar']; ?></td>
                                    </tr>
                                    <tr  class="td-goldar_id">
                                        <th class="title"> Goldar Id: </th>
                                        <td class="value"> <?php echo $data['goldar_id']; ?></td>
                                    </tr>
                                    <tr  class="td-goldar_golongan_darah">
                                        <th class="title"> Goldar Golongan Darah: </th>
                                        <td class="value"> <?php echo $data['goldar_golongan_darah']; ?></td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <div class="dropup export-btn-holder mx-1">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-save"></i> Export
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                    <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                        <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                        </a>
                                        <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                        <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                            <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                            </a>
                                            <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                            <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                </a>
                                                <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                    <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                    </a>
                                                    <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                    <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                        <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                        </a>
                                                    </div>
                                                </div>
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("transaksi/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("transaksi/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Apakah anda yakin akan menghapus data ini?" data-display-style="modal">
                                                    <i class="fa fa-times"></i> Delete
                                                </a>
                                            </div>
                                            <?php
                                            }
                                            else{
                                            ?>
                                            <!-- Empty Record Message -->
                                            <div class="text-muted p-3">
                                                <i class="fa fa-ban"></i> No Record Found
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
