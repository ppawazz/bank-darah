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
                    <h4 class="record-title">Rekap Stok</h4>
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
                                        <a class="text-decoration-none" href="<?php print_link('rekap_stok'); ?>">
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
                                        <a class="text-decoration-none" href="<?php print_link('rekap_stok'); ?>">
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
                            <div id="rekap_stok-list-records">
                                <div id="page-report-body" class="table-responsive">
                                    <?php Html::ajaxpage_spinner(); ?>
                                    <table class="table table-hover table-striped table-sm text-center">
                                        <thead class="table-header bg-light">
                                            <tr>
                                                <th class="td-sno">No</th>
                                                <th  class="td-jenis"> Jenis</th>
                                                <th  class="td-dropping"> Dropping (A)</th>
                                                <th  class="td-sa"> Stock Awal (B)</th>
                                                <th  class="td-pengembalian"> Pengembalian (C)</th>
                                                <th  class="td-ready"> Ready (D)</th>
                                                <th  class="td-selesai"> Selesai (E)</th>
                                                <th  class="td-belum"> Belum</th>
                                                <th  class="td-pemasukan"> Pemasukan (Dropping + SA + Pengembalian)</th>
                                                <th  class="td-pemakaian"> Jumlah Pemakaian Labu</th>
                                                <th  class="td-total"> Total (A+B+C-D-E)</th>
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
                                                <td align="center" class="td-jenis"><a href="<?php print_link("rekap_stok/view/$data[jenis]") ?>"><?php echo $data['jenis']; ?></a></td>
                                                <td align="center" class="td-dropping"> <?php echo $data['dropping']; ?></td>
                                                <td align="center" class="td-sa"> <?php echo $data['sa']; ?></td>
                                                <td align="center" class="td-pengembalian"> <?php echo $data['pengembalian']; ?></td>
                                                <td align="center" class="td-ready"> <?php echo $data['ready']; ?></td>
                                                <td align="center" class="td-selesai"> <?php echo $data['selesai']; ?></td>
                                                <td align="center" class="td-belum"> <?php echo $data['belum']; ?></td>
                                                <td align="center" class="td-pemasukan"> <?php echo $data['pemasukan']; ?></td>
                                                <td align="center" class="td-pemakaian"> <?php echo $data['pemakaian']; ?></td>
                                                <td align="center" class="td-total"> <?php echo $data['total']; ?></td>
                                                <th class="td-btn">
                                                </th>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                            <!--endrecord-->
                                        </tbody>
                                        <tbody class="search-data" id="search-data-<?php echo $page_element_id; ?>"></tbody>
                                        <tfoot><tr><th colspan="2">Total</th><th><?php echo $sum_of_dropping;  ?></th><th><?php echo $sum_of_sa;  ?></th><th><?php echo $sum_of_pengembalian;  ?></th><th><?php echo $sum_of_ready;  ?></th><th><?php echo $sum_of_selesai;  ?></th><th><?php echo $sum_of_belum;  ?></th><th><?php echo $sum_of_pemasukan;  ?></th><th><?php echo $sum_of_pemakaian;  ?></th><th><?php echo $sum_of_total;  ?></th><th></th></tr></tfoot>
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
