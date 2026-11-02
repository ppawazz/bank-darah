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
                    <h4 class="record-title">View  Pasien</h4>
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
                                            <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['tanggal']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pasien/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="tanggal" 
                                                data-title="Enter Tanggal" 
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
                                    <tr  class="td-ri_bpjs_p">
                                        <th class="title"> Ri Bpjs P: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['ri_bpjs_p']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pasien/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="ri_bpjs_p" 
                                                data-title="Enter Ri Bpjs P" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['ri_bpjs_p']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-rj_bpjs_p">
                                        <th class="title"> Rj Bpjs P: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['rj_bpjs_p']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pasien/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="rj_bpjs_p" 
                                                data-title="Enter Rj Bpjs P" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['rj_bpjs_p']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-ri_bpjs_s">
                                        <th class="title"> Ri Bpjs S: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['ri_bpjs_s']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pasien/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="ri_bpjs_s" 
                                                data-title="Enter Ri Bpjs S" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['ri_bpjs_s']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-rj_bpjs_s">
                                        <th class="title"> Rj Bpjs S: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['rj_bpjs_s']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pasien/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="rj_bpjs_s" 
                                                data-title="Enter Rj Bpjs S" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['rj_bpjs_s']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-ri_bpjs_m">
                                        <th class="title"> Ri Bpjs M: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['ri_bpjs_m']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pasien/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="ri_bpjs_m" 
                                                data-title="Enter Ri Bpjs M" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['ri_bpjs_m']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-rj_bpjs_m">
                                        <th class="title"> Rj Bpjs M: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['rj_bpjs_m']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pasien/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="rj_bpjs_m" 
                                                data-title="Enter Rj Bpjs M" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['rj_bpjs_m']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-ri_exe_p">
                                        <th class="title"> Ri Exe P: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['ri_exe_p']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pasien/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="ri_exe_p" 
                                                data-title="Enter Ri Exe P" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['ri_exe_p']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-rj_exe_p">
                                        <th class="title"> Rj Exe P: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['rj_exe_p']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pasien/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="rj_exe_p" 
                                                data-title="Enter Rj Exe P" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['rj_exe_p']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-ri_exe_s">
                                        <th class="title"> Ri Exe S: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['ri_exe_s']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pasien/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="ri_exe_s" 
                                                data-title="Enter Ri Exe S" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['ri_exe_s']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-rj_exe_s">
                                        <th class="title"> Rj Exe S: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['rj_exe_s']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pasien/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="rj_exe_s" 
                                                data-title="Enter Rj Exe S" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['rj_exe_s']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-ri_exe_m">
                                        <th class="title"> Ri Exe M: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['ri_exe_m']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pasien/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="ri_exe_m" 
                                                data-title="Enter Ri Exe M" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['ri_exe_m']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-rj_exe_m">
                                        <th class="title"> Rj Exe M: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['rj_exe_m']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pasien/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="rj_exe_m" 
                                                data-title="Enter Rj Exe M" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['rj_exe_m']; ?> 
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
