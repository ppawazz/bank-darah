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
                    <h4 class="record-title">View  V Register Bankdarah</h4>
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
                        $rec_id = (!empty($data['']) ? urlencode($data['']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-tanggal">
                                        <th class="title"> Tanggal: </th>
                                        <td class="value"> <?php echo $data['tanggal']; ?></td>
                                    </tr>
                                    <tr  class="td-nama">
                                        <th class="title"> Nama: </th>
                                        <td class="value"> <?php echo $data['nama']; ?></td>
                                    </tr>
                                    <tr  class="td-mrn">
                                        <th class="title"> Mrn: </th>
                                        <td class="value"> <?php echo $data['mrn']; ?></td>
                                    </tr>
                                    <tr  class="td-penerima">
                                        <th class="title"> Penerima: </th>
                                        <td class="value"> <?php echo $data['penerima']; ?></td>
                                    </tr>
                                    <tr  class="td-golongan_darah">
                                        <th class="title"> Golongan Darah: </th>
                                        <td class="value"> <?php echo $data['golongan_darah']; ?></td>
                                    </tr>
                                    <tr  class="td-jenis">
                                        <th class="title"> Jenis: </th>
                                        <td class="value"> <?php echo $data['jenis']; ?></td>
                                    </tr>
                                    <tr  class="td-pmi">
                                        <th class="title"> Pmi: </th>
                                        <td class="value"> <?php echo $data['pmi']; ?></td>
                                    </tr>
                                    <tr  class="td-jumlah_permintaan">
                                        <th class="title"> Jumlah Permintaan: </th>
                                        <td class="value"> <?php echo $data['jumlah_permintaan']; ?></td>
                                    </tr>
                                    <tr  class="td-jumlah_pengambilan">
                                        <th class="title"> Jumlah Pengambilan: </th>
                                        <td class="value"> <?php echo $data['jumlah_pengambilan']; ?></td>
                                    </tr>
                                    <tr  class="td-no_kantong">
                                        <th class="title"> No Kantong: </th>
                                        <td class="value"> <?php echo $data['no_kantong']; ?></td>
                                    </tr>
                                    <tr  class="td-jam_mulai">
                                        <th class="title"> Jam Mulai: </th>
                                        <td class="value"> <?php echo $data['jam_mulai']; ?></td>
                                    </tr>
                                    <tr  class="td-mayor">
                                        <th class="title"> Mayor: </th>
                                        <td class="value"> <?php echo $data['mayor']; ?></td>
                                    </tr>
                                    <tr  class="td-minor">
                                        <th class="title"> Minor: </th>
                                        <td class="value"> <?php echo $data['minor']; ?></td>
                                    </tr>
                                    <tr  class="td-auto_control">
                                        <th class="title"> Auto Control: </th>
                                        <td class="value"> <?php echo $data['auto_control']; ?></td>
                                    </tr>
                                    <tr  class="td-kesimpulan">
                                        <th class="title"> Kesimpulan: </th>
                                        <td class="value"> <?php echo $data['kesimpulan']; ?></td>
                                    </tr>
                                    <tr  class="td-jam_selesai">
                                        <th class="title"> Jam Selesai: </th>
                                        <td class="value"> <?php echo $data['jam_selesai']; ?></td>
                                    </tr>
                                    <tr  class="td-petugas">
                                        <th class="title"> Petugas: </th>
                                        <td class="value"> <?php echo $data['petugas']; ?></td>
                                    </tr>
                                    <tr  class="td-perawat">
                                        <th class="title"> Perawat: </th>
                                        <td class="value"> <?php echo $data['perawat']; ?></td>
                                    </tr>
                                    <tr  class="td-ttd">
                                        <th class="title"> Ttd: </th>
                                        <td class="value"><?php Html :: page_img($data['ttd'],400,400,1); ?></td>
                                    </tr>
                                    <tr  class="td-waktu">
                                        <th class="title"> Waktu: </th>
                                        <td class="value"> <?php echo $data['waktu']; ?></td>
                                    </tr>
                                    <tr  class="td-reaksi">
                                        <th class="title"> Reaksi: </th>
                                        <td class="value"> <?php echo $data['reaksi']; ?></td>
                                    </tr>
                                    <tr  class="td-gejala">
                                        <th class="title"> Gejala: </th>
                                        <td class="value"> <?php echo $data['gejala']; ?></td>
                                    </tr>
                                    <tr  class="td-tindak_lanjut">
                                        <th class="title"> Tindak Lanjut: </th>
                                        <td class="value"> <?php echo $data['tindak_lanjut']; ?></td>
                                    </tr>
                                    <tr  class="td-pengembalian">
                                        <th class="title"> Pengembalian: </th>
                                        <td class="value"> <?php echo $data['pengembalian']; ?></td>
                                    </tr>
                                    <tr  class="td-jumlah_kembali">
                                        <th class="title"> Jumlah Kembali: </th>
                                        <td class="value"> <?php echo $data['jumlah_kembali']; ?></td>
                                    </tr>
                                    <tr  class="td-alasan">
                                        <th class="title"> Alasan: </th>
                                        <td class="value"> <?php echo $data['alasan']; ?></td>
                                    </tr>
                                    <tr  class="td-tgl_kembali">
                                        <th class="title"> Tgl Kembali: </th>
                                        <td class="value"> <?php echo $data['tgl_kembali']; ?></td>
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
