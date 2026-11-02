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
                    <h4 class="record-title">View  V Dropping Bulan Ini</h4>
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
                                    <tr  class="td-pmi">
                                        <th class="title"> Pmi: </th>
                                        <td class="value"> <?php echo $data['pmi']; ?></td>
                                    </tr>
                                    <tr  class="td-prca">
                                        <th class="title"> Prca: </th>
                                        <td class="value"> <?php echo $data['prca']; ?></td>
                                    </tr>
                                    <tr  class="td-prcab">
                                        <th class="title"> Prcab: </th>
                                        <td class="value"> <?php echo $data['prcab']; ?></td>
                                    </tr>
                                    <tr  class="td-prcb">
                                        <th class="title"> Prcb: </th>
                                        <td class="value"> <?php echo $data['prcb']; ?></td>
                                    </tr>
                                    <tr  class="td-prco">
                                        <th class="title"> Prco: </th>
                                        <td class="value"> <?php echo $data['prco']; ?></td>
                                    </tr>
                                    <tr  class="td-tca">
                                        <th class="title"> Tca: </th>
                                        <td class="value"> <?php echo $data['tca']; ?></td>
                                    </tr>
                                    <tr  class="td-tcab">
                                        <th class="title"> Tcab: </th>
                                        <td class="value"> <?php echo $data['tcab']; ?></td>
                                    </tr>
                                    <tr  class="td-tcb">
                                        <th class="title"> Tcb: </th>
                                        <td class="value"> <?php echo $data['tcb']; ?></td>
                                    </tr>
                                    <tr  class="td-tco">
                                        <th class="title"> Tco: </th>
                                        <td class="value"> <?php echo $data['tco']; ?></td>
                                    </tr>
                                    <tr  class="td-ffpa">
                                        <th class="title"> Ffpa: </th>
                                        <td class="value"> <?php echo $data['ffpa']; ?></td>
                                    </tr>
                                    <tr  class="td-ffpab">
                                        <th class="title"> Ffpab: </th>
                                        <td class="value"> <?php echo $data['ffpab']; ?></td>
                                    </tr>
                                    <tr  class="td-ffpb">
                                        <th class="title"> Ffpb: </th>
                                        <td class="value"> <?php echo $data['ffpb']; ?></td>
                                    </tr>
                                    <tr  class="td-ffpo">
                                        <th class="title"> Ffpo: </th>
                                        <td class="value"> <?php echo $data['ffpo']; ?></td>
                                    </tr>
                                    <tr  class="td-wba">
                                        <th class="title"> Wba: </th>
                                        <td class="value"> <?php echo $data['wba']; ?></td>
                                    </tr>
                                    <tr  class="td-wbab">
                                        <th class="title"> Wbab: </th>
                                        <td class="value"> <?php echo $data['wbab']; ?></td>
                                    </tr>
                                    <tr  class="td-wbb">
                                        <th class="title"> Wbb: </th>
                                        <td class="value"> <?php echo $data['wbb']; ?></td>
                                    </tr>
                                    <tr  class="td-wbo">
                                        <th class="title"> Wbo: </th>
                                        <td class="value"> <?php echo $data['wbo']; ?></td>
                                    </tr>
                                    <tr  class="td-lpa">
                                        <th class="title"> Lpa: </th>
                                        <td class="value"> <?php echo $data['lpa']; ?></td>
                                    </tr>
                                    <tr  class="td-lpb">
                                        <th class="title"> Lpb: </th>
                                        <td class="value"> <?php echo $data['lpb']; ?></td>
                                    </tr>
                                    <tr  class="td-lpab">
                                        <th class="title"> Lpab: </th>
                                        <td class="value"> <?php echo $data['lpab']; ?></td>
                                    </tr>
                                    <tr  class="td-lpo">
                                        <th class="title"> Lpo: </th>
                                        <td class="value"> <?php echo $data['lpo']; ?></td>
                                    </tr>
                                    <tr  class="td-prclda">
                                        <th class="title"> Prclda: </th>
                                        <td class="value"> <?php echo $data['prclda']; ?></td>
                                    </tr>
                                    <tr  class="td-prcldab">
                                        <th class="title"> Prcldab: </th>
                                        <td class="value"> <?php echo $data['prcldab']; ?></td>
                                    </tr>
                                    <tr  class="td-prcldb">
                                        <th class="title"> Prcldb: </th>
                                        <td class="value"> <?php echo $data['prcldb']; ?></td>
                                    </tr>
                                    <tr  class="td-prcldo">
                                        <th class="title"> Prcldo: </th>
                                        <td class="value"> <?php echo $data['prcldo']; ?></td>
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
