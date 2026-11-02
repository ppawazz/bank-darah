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
<section class="page ajax-page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <h2 class="record-title text-primary">Reaksi Transfusi</h2>
                </div>
                <div class="col-sm-4 ">
                    <input autocomplete="off" data-page-id="<?php echo $page_element_id ?>" data-page="<?php print_link($current_page); ?>" value="<?php echo get_value('search'); ?>" class="form-control ajax-page-search" type="text" name="search"  placeholder="Search" />
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
                                        <a class="text-decoration-none" href="<?php print_link('transaksi'); ?>">
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
                                        <a class="text-decoration-none" href="<?php print_link('transaksi'); ?>">
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
                            <div id="transaksi-reaksi_transfusi-records">
                                <div id="page-report-body" class="table-fixed">
                                    <?php Html::ajaxpage_spinner(); ?>
                                    <table class="table table-hover table-striped table-sm text-left">
                                        <thead class="table-header bg-light">
                                            <tr>
                                                <th class="td-sno">No</th>
                                                <th  class="td-tanggal"> Tanggal</th>
                                                <th  class="td-jam_reaksi"> Jam Reaksi</th>
                                                <th  class="td-nama"> Nama</th>
                                                <th  class="td-mrn"> MRN</th>
                                                <th  class="td-diagnosa"> Diagnosa</th>
                                                <th  class="td-jenis_darah_jenis"> Jenis Darah</th>
                                                <th  class="td-no_kantong"> No Kantong</th>
                                                <th  class="td-gejala"> Gejala</th>
                                                <th  class="td-tindak_lanjut"> Tindak Lanjut</th>
                                                <th  class="td-jam_lapor"> Jam Lapor</th>
                                                <th  class="td-pelapor"> Perawat Pelapor</th>
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
                                                <td class="td-tanggal">
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
                                                <td class="td-jam_reaksi">
                                                    <span  data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                        data-value="<?php echo $data['jam_reaksi']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="jam_reaksi" 
                                                        data-title="Jam Reaksi" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="flatdatetimepicker" 
                                                        data-mode="inline" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" >
                                                        <?php echo $data['jam_reaksi']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-nama">
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
                                                <td class="td-mrn">
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
                                                <td class="td-diagnosa">
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
                                                <td class="td-jenis_darah_jenis"> <?php echo $data['jenis_darah_jenis']; ?></td>
                                                <td class="td-no_kantong">
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
                                                <td class="td-gejala">
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
                                                <td class="td-tindak_lanjut">
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
                                                <td class="td-jam_lapor">
                                                    <span  data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                        data-value="<?php echo $data['jam_lapor']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="jam_lapor" 
                                                        data-title="Jam Lapor" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="flatdatetimepicker" 
                                                        data-mode="inline" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" >
                                                        <?php echo $data['jam_lapor']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-pelapor">
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
                                                    $pager->ajax_page = true;
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
