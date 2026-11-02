<?php
$comp_model = new SharedController;
$page_element_id = "list-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data From Controller
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Pasien</h4>
                </div>
                <div class="col-sm-3 ">
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("pasien/add") ?>">
                        <i class="fa fa-plus"></i>                              
                        Add New Pasien 
                    </a>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('pasien'); ?>" method="get">
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="Search" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 comp-grid">
                        <div class="">
                            <!-- Page bread crumbs components-->
                            <?php
                            if(!empty($field_name) || !empty($_GET['search'])){
                            ?>
                            <hr class="sm d-block d-sm-none" />
                            <nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
                                <ul class="breadcrumb m-0 p-1">
                                    <?php
                                    if(!empty($field_name)){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('pasien'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <?php echo (get_value("tag") ? get_value("tag")  :  make_readable($field_name)); ?>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold">
                                        <?php echo (get_value("label") ? get_value("label")  :  make_readable(urldecode($field_value))); ?>
                                    </li>
                                    <?php 
                                    }   
                                    ?>
                                    <?php
                                    if(get_value("search")){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('pasien'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-capitalize">
                                        Search
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold"><?php echo get_value("search"); ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </nav>
                            <!--End of Page bread crumbs components-->
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <div  class="">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-12 comp-grid">
                        <?php $this :: display_page_errors(); ?>
                        <div  class=" animated fadeIn page-content">
                            <div id="pasien-list-records">
                                <div id="page-report-body" class="table-responsive">
                                    <table class="table table-hover table-striped table-sm text-left">
                                        <thead class="table-header bg-light">
                                            <tr>
                                                <th class="td-sno">#</th>
                                                <th  class="td-id"> Id</th>
                                                <th  class="td-tanggal"> Tanggal</th>
                                                <th  class="td-ri_bpjs_p"> Ri Bpjs P</th>
                                                <th  class="td-rj_bpjs_p"> Rj Bpjs P</th>
                                                <th  class="td-ri_bpjs_s"> Ri Bpjs S</th>
                                                <th  class="td-rj_bpjs_s"> Rj Bpjs S</th>
                                                <th  class="td-ri_bpjs_m"> Ri Bpjs M</th>
                                                <th  class="td-rj_bpjs_m"> Rj Bpjs M</th>
                                                <th  class="td-ri_exe_p"> Ri Exe P</th>
                                                <th  class="td-rj_exe_p"> Rj Exe P</th>
                                                <th  class="td-ri_exe_s"> Ri Exe S</th>
                                                <th  class="td-rj_exe_s"> Rj Exe S</th>
                                                <th  class="td-ri_exe_m"> Ri Exe M</th>
                                                <th  class="td-rj_exe_m"> Rj Exe M</th>
                                                <th class="td-btn"></th>
                                            </tr>
                                        </thead>
                                        <?php
                                        if(!empty($records)){
                                        ?>
                                        <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                            <!--record-->
                                            <?php
                                            $counter = 0;
                                            foreach($records as $data){
                                            $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                                            $counter++;
                                            ?>
                                            <tr>
                                                <th class="td-sno"><?php echo $counter; ?></th>
                                                <td class="td-id"><a href="<?php print_link("pasien/view/$data[id]") ?>"><?php echo $data['id']; ?></a></td>
                                                <td class="td-tanggal">
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
                                                <td class="td-ri_bpjs_p">
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
                                                <td class="td-rj_bpjs_p">
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
                                                <td class="td-ri_bpjs_s">
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
                                                <td class="td-rj_bpjs_s">
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
                                                <td class="td-ri_bpjs_m">
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
                                                <td class="td-rj_bpjs_m">
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
                                                <td class="td-ri_exe_p">
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
                                                <td class="td-rj_exe_p">
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
                                                <td class="td-ri_exe_s">
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
                                                <td class="td-rj_exe_s">
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
                                                <td class="td-ri_exe_m">
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
                                                <td class="td-rj_exe_m">
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
                                            <?php 
                                            }
                                            ?>
                                            <!--endrecord-->
                                        </tbody>
                                        <tbody class="search-data" id="search-data-<?php echo $page_element_id; ?>"></tbody>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                    <?php 
                                    if(empty($records)){
                                    ?>
                                    <h4 class="bg-light text-center border-top text-muted animated bounce  p-3">
                                        <i class="fa fa-ban"></i> Tidak Ada Data
                                    </h4>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                if( $show_footer && !empty($records)){
                                ?>
                                <div class=" border-top mt-2">
                                    <div class="row justify-content-center">    
                                        <div class="col-md-auto justify-content-center">    
                                            <div class="p-3 d-flex justify-content-between">    
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
                                                            </div>
                                                            <div class="col">   
                                                                <?php
                                                                if($show_pagination == true){
                                                                $pager = new Pagination($total_records, $record_count);
                                                                $pager->route = $this->route;
                                                                $pager->show_page_count = true;
                                                                $pager->show_record_count = true;
                                                                $pager->show_page_limit =true;
                                                                $pager->limit_count = $this->limit_count;
                                                                $pager->show_page_number_list = true;
                                                                $pager->pager_link_range=5;
                                                                $pager->render();
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
