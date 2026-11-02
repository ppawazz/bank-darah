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
                    <h4 class="record-title">View  Detail Labu</h4>
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
                                    <tr  class="td-id_transaksi">
                                        <th class="title"> Id Transaksi: </th>
                                        <td class="value">
                                            <span  data-source='<?php print_link('api/json/detail_labu_id_transaksi_option_list'); ?>' 
                                                data-value="<?php echo $data['id_transaksi']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("detail_labu/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="id_transaksi" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="selectize" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable selectize" >
                                                <?php echo $data['id_transaksi']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-jumlah">
                                        <th class="title"> Jumlah: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-no_kantong">
                                        <th class="title"> No Kantong: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-perawat">
                                        <th class="title"> Perawat: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-waktu">
                                        <th class="title"> Waktu: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-transaksi_id">
                                        <th class="title"> Transaksi Id: </th>
                                        <td class="value"> <?php echo $data['transaksi_id']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_tanggal">
                                        <th class="title"> Transaksi Tanggal: </th>
                                        <td class="value"> <?php echo $data['transaksi_tanggal']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_keterangan">
                                        <th class="title"> Transaksi Keterangan: </th>
                                        <td class="value"> <?php echo $data['transaksi_keterangan']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_jenis_id">
                                        <th class="title"> Transaksi Jenis Id: </th>
                                        <td class="value"> <?php echo $data['transaksi_jenis_id']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_status">
                                        <th class="title"> Transaksi Status: </th>
                                        <td class="value"> <?php echo $data['transaksi_status']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_menerima">
                                        <th class="title"> Transaksi Menerima: </th>
                                        <td class="value"> <?php echo $data['transaksi_menerima']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_no_kantong">
                                        <th class="title"> Transaksi No Kantong: </th>
                                        <td class="value"> <?php echo $data['transaksi_no_kantong']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_pmi">
                                        <th class="title"> Transaksi Pmi: </th>
                                        <td class="value"> <?php echo $data['transaksi_pmi']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_jam_mulai">
                                        <th class="title"> Transaksi Jam Mulai: </th>
                                        <td class="value"> <?php echo $data['transaksi_jam_mulai']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_jam_selesai">
                                        <th class="title"> Transaksi Jam Selesai: </th>
                                        <td class="value"> <?php echo $data['transaksi_jam_selesai']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_memberi">
                                        <th class="title"> Transaksi Memberi: </th>
                                        <td class="value"> <?php echo $data['transaksi_memberi']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_goldar">
                                        <th class="title"> Transaksi Goldar: </th>
                                        <td class="value"> <?php echo $data['transaksi_goldar']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_kondisi">
                                        <th class="title"> Transaksi Kondisi: </th>
                                        <td class="value"> <?php echo $data['transaksi_kondisi']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_jumlah">
                                        <th class="title"> Transaksi Jumlah: </th>
                                        <td class="value"> <?php echo $data['transaksi_jumlah']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_mrn">
                                        <th class="title"> Transaksi Mrn: </th>
                                        <td class="value"> <?php echo $data['transaksi_mrn']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_nama">
                                        <th class="title"> Transaksi Nama: </th>
                                        <td class="value"> <?php echo $data['transaksi_nama']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_pengembalian">
                                        <th class="title"> Transaksi Pengembalian: </th>
                                        <td class="value"> <?php echo $data['transaksi_pengembalian']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_jumlah_kembali">
                                        <th class="title"> Transaksi Jumlah Kembali: </th>
                                        <td class="value"> <?php echo $data['transaksi_jumlah_kembali']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_tgl_kembali">
                                        <th class="title"> Transaksi Tgl Kembali: </th>
                                        <td class="value"> <?php echo $data['transaksi_tgl_kembali']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_no_labu_kembali">
                                        <th class="title"> Transaksi No Labu Kembali: </th>
                                        <td class="value"> <?php echo $data['transaksi_no_labu_kembali']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_tgl_kadaluarsa">
                                        <th class="title"> Transaksi Tgl Kadaluarsa: </th>
                                        <td class="value"> <?php echo $data['transaksi_tgl_kadaluarsa']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_alasan">
                                        <th class="title"> Transaksi Alasan: </th>
                                        <td class="value"> <?php echo $data['transaksi_alasan']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_harga">
                                        <th class="title"> Transaksi Harga: </th>
                                        <td class="value"> <?php echo $data['transaksi_harga']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_crosscheck">
                                        <th class="title"> Transaksi Crosscheck: </th>
                                        <td class="value"> <?php echo $data['transaksi_crosscheck']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_mayor">
                                        <th class="title"> Transaksi Mayor: </th>
                                        <td class="value"> <?php echo $data['transaksi_mayor']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_minor">
                                        <th class="title"> Transaksi Minor: </th>
                                        <td class="value"> <?php echo $data['transaksi_minor']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_auto_control">
                                        <th class="title"> Transaksi Auto Control: </th>
                                        <td class="value"> <?php echo $data['transaksi_auto_control']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_kesimpulan">
                                        <th class="title"> Transaksi Kesimpulan: </th>
                                        <td class="value"> <?php echo $data['transaksi_kesimpulan']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_petugas_bdrs">
                                        <th class="title"> Transaksi Petugas Bdrs: </th>
                                        <td class="value"> <?php echo $data['transaksi_petugas_bdrs']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_pengambilan">
                                        <th class="title"> Transaksi Pengambilan: </th>
                                        <td class="value"> <?php echo $data['transaksi_pengambilan']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_perawat">
                                        <th class="title"> Transaksi Perawat: </th>
                                        <td class="value"> <?php echo $data['transaksi_perawat']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_diagnosa">
                                        <th class="title"> Transaksi Diagnosa: </th>
                                        <td class="value"> <?php echo $data['transaksi_diagnosa']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_reaksi">
                                        <th class="title"> Transaksi Reaksi: </th>
                                        <td class="value"> <?php echo $data['transaksi_reaksi']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_gejala">
                                        <th class="title"> Transaksi Gejala: </th>
                                        <td class="value"> <?php echo $data['transaksi_gejala']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_tindak_lanjut">
                                        <th class="title"> Transaksi Tindak Lanjut: </th>
                                        <td class="value"> <?php echo $data['transaksi_tindak_lanjut']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_pelapor">
                                        <th class="title"> Transaksi Pelapor: </th>
                                        <td class="value"> <?php echo $data['transaksi_pelapor']; ?></td>
                                    </tr>
                                    <tr  class="td-transaksi_jam_reaksi">
                                        <th class="title"> Transaksi Jam Reaksi: </th>
                                        <td class="value"> <?php echo $data['transaksi_jam_reaksi']; ?></td>
                                    </tr>
                                    <tr  class="td-petugas">
                                        <th class="title"> Petugas: </th>
                                        <td class="value">
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("detail_labu/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("detail_labu/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Apakah anda yakin akan menghapus data ini?" data-display-style="modal">
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
