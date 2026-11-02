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
                    <h4 class="record-title">View  V Dashboard Pasien</h4>
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
                                    <tr  class="td-bulan">
                                        <th class="title"> Bulan: </th>
                                        <td class="value"> <?php echo $data['bulan']; ?></td>
                                    </tr>
                                    <tr  class="td-bulanangka">
                                        <th class="title"> Bulanangka: </th>
                                        <td class="value"> <?php echo $data['bulanangka']; ?></td>
                                    </tr>
                                    <tr  class="td-ribpjsp">
                                        <th class="title"> Ribpjsp: </th>
                                        <td class="value"> <?php echo $data['ribpjsp']; ?></td>
                                    </tr>
                                    <tr  class="td-rjbpjsp">
                                        <th class="title"> Rjbpjsp: </th>
                                        <td class="value"> <?php echo $data['rjbpjsp']; ?></td>
                                    </tr>
                                    <tr  class="td-riexep">
                                        <th class="title"> Riexep: </th>
                                        <td class="value"> <?php echo $data['riexep']; ?></td>
                                    </tr>
                                    <tr  class="td-rjexep">
                                        <th class="title"> Rjexep: </th>
                                        <td class="value"> <?php echo $data['rjexep']; ?></td>
                                    </tr>
                                    <tr  class="td-ribpjss">
                                        <th class="title"> Ribpjss: </th>
                                        <td class="value"> <?php echo $data['ribpjss']; ?></td>
                                    </tr>
                                    <tr  class="td-rjbpjss">
                                        <th class="title"> Rjbpjss: </th>
                                        <td class="value"> <?php echo $data['rjbpjss']; ?></td>
                                    </tr>
                                    <tr  class="td-riexes">
                                        <th class="title"> Riexes: </th>
                                        <td class="value"> <?php echo $data['riexes']; ?></td>
                                    </tr>
                                    <tr  class="td-rjexes">
                                        <th class="title"> Rjexes: </th>
                                        <td class="value"> <?php echo $data['rjexes']; ?></td>
                                    </tr>
                                    <tr  class="td-ribpjsm">
                                        <th class="title"> Ribpjsm: </th>
                                        <td class="value"> <?php echo $data['ribpjsm']; ?></td>
                                    </tr>
                                    <tr  class="td-rjbpjsm">
                                        <th class="title"> Rjbpjsm: </th>
                                        <td class="value"> <?php echo $data['rjbpjsm']; ?></td>
                                    </tr>
                                    <tr  class="td-riexem">
                                        <th class="title"> Riexem: </th>
                                        <td class="value"> <?php echo $data['riexem']; ?></td>
                                    </tr>
                                    <tr  class="td-rjexem">
                                        <th class="title"> Rjexem: </th>
                                        <td class="value"> <?php echo $data['rjexem']; ?></td>
                                    </tr>
                                    <tr  class="td-rijkn">
                                        <th class="title"> Rijkn: </th>
                                        <td class="value"> <?php echo $data['rijkn']; ?></td>
                                    </tr>
                                    <tr  class="td-rjjkn">
                                        <th class="title"> Rjjkn: </th>
                                        <td class="value"> <?php echo $data['rjjkn']; ?></td>
                                    </tr>
                                    <tr  class="td-riexe">
                                        <th class="title"> Riexe: </th>
                                        <td class="value"> <?php echo $data['riexe']; ?></td>
                                    </tr>
                                    <tr  class="td-rjexe">
                                        <th class="title"> Rjexe: </th>
                                        <td class="value"> <?php echo $data['rjexe']; ?></td>
                                    </tr>
                                    <tr  class="td-jkn">
                                        <th class="title"> Jkn: </th>
                                        <td class="value"> <?php echo $data['jkn']; ?></td>
                                    </tr>
                                    <tr  class="td-exe">
                                        <th class="title"> Exe: </th>
                                        <td class="value"> <?php echo $data['exe']; ?></td>
                                    </tr>
                                    <tr  class="td-tahun">
                                        <th class="title"> Tahun: </th>
                                        <td class="value"> <?php echo $data['tahun']; ?></td>
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
