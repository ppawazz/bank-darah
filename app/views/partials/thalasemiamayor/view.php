<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$data = $this->view_data;
$page_id = $this->route->page_id;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php if( $show_header == true ){ ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View Thalasemia Mayor</h4>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div class="card animated fadeIn page-content">
                        <?php $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['']) ? urlencode($data['']) : null);
                        $counter++; ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
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
                                    <tr  class="td-diagnosa">
                                        <th class="title"> Diagnosa: </th>
                                        <td class="value"> <?php echo $data['diagnosa']; ?></td>
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
                                    <tr  class="td-jumlah">
                                        <th class="title"> Jumlah: </th>
                                        <td class="value"> <?php echo $data['jumlah']; ?></td>
                                    </tr>
                                    <tr  class="td-no_kantong">
                                        <th class="title"> No Kantong: </th>
                                        <td class="value"> <?php echo $data['no_kantong']; ?></td>
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
                                </tbody>
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
                        <?php } else { ?>
                        <div class="text-muted p-3">
                            <i class="fa fa-ban"></i> No Record Found
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>