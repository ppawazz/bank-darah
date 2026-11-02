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
                    <h2 class="record-title text-danger">DROPPING BDRS</h2>
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
                                    <a class="text-decoration-none" href="<?php print_link('dropping'); ?>">
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
                                    <a class="text-decoration-none" href="<?php print_link('dropping'); ?>">
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
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                </div>
                <div class="col-md-4 comp-grid">
                    <form method="get" action="<?php print_link($current_page) ?>" class="form filter-form">
                        <div class="card mb-4 alert-info">
                            <div class="card-header h4 h4">Tanggal Dropping</div>
                            <div class="p-2">
                                <input class="form-control datepicker"  value="<?php echo $this->set_field_value('dropping_tanggal') ?>" type="datetime"  name="dropping_tanggal" placeholder="" data-enable-time="" data-date-format="Y-m-d" data-alt-format="M j, Y" data-inline="false" data-no-calendar="false" data-mode="range" />
                                </div>
                            </div>
                            <div class="card mb-3 alert-primary">
                                <div class="card-header h4 h4">PMI</div>
                                <div class="p-2">
                                    <select   name="dropping_pmi" class="form-control custom ">
                                        <option value="">--PIlih Data--</option>
                                        <?php
                                        $dropping_pmi_options = Menu :: $pmi;
                                        if(!empty($dropping_pmi_options)){
                                        foreach($dropping_pmi_options as $option){
                                        $value = $option['value'];
                                        $label = $option['label'];
                                        $selected = $this->set_field_selected('dropping_pmi', $value);
                                        ?>
                                        <option <?php echo $selected ?> value="<?php echo $value ?>">
                                            <?php echo $label ?>
                                        </option>                                   
                                        <?php
                                        }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <hr />
                            <div class="form-group text-center">
                                <button class="btn btn-primary">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div  class="">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-12 comp-grid">
                        <?php $this :: display_page_errors(); ?>
                        <div class="filter-tags mb-2">
                            <?php
                            if(!empty($_GET['dropping_tanggal'])){
                            ?>
                            <div class="filter-chip card bg-light">
                                <b>Tanggal :</b> 
                                <?php
                                $date_val = get_value('dropping_tanggal');
                                $formated_date = "";
                                if(str_contains('-to-', $date_val)){
                                //if value is a range date
                                $vals = explode('-to-' , str_replace(' ' , '' , $date_val));
                                $startdate = $vals[0];
                                $enddate = $vals[1];
                                $formated_date = format_date($startdate, 'jS F, Y') . ' <span class="text-muted">&#10148;</span> ' . format_date($enddate, 'jS F, Y');
                                }
                                elseif(str_contains(',', $date_val)){
                                //multi date values
                                $vals = explode(',' , str_replace(' ' , '' , $date_val));
                                $formated_arrs = array_map(function($date){return format_date($date, 'jS F, Y');}, $vals);
                                $formated_date = implode(' <span class="text-info">&#11161;</span> ', $formated_arrs);
                                }
                                else{
                                $formated_date = format_date($date_val, 'jS F, Y');
                                }
                                echo  $formated_date;
                                $remove_link = unset_get_value('dropping_tanggal', $this->route->page_url);
                                ?>
                                <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                    &times;
                                </a>
                            </div>
                            <?php
                            }
                            ?>
                            <?php
                            if(!empty(get_value('dropping_pmi'))){
                            ?>
                            <div class="filter-chip card bg-light">
                                <b>PMI :</b> 
                                <?php 
                                if(get_value('dropping_pmilabel')){
                                echo get_value('dropping_pmilabel');
                                }
                                else{
                                echo get_value('dropping_pmi');
                                }
                                $remove_link = unset_get_value('dropping_pmi', $this->route->page_url);
                                ?>
                                <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                    &times;
                                </a>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div  class=" animated fadeIn page-content">
                            <div id="dropping-list-records">
                                <div id="page-report-body" class="table-fixed">
                                    <table class="table table-hover table-striped table-sm text-center">
                                        <thead class="table-header bg-primary text-white">
                                            <tr>
                                                <th  class="td-tanggal"> Tanggal</th>
                                                <th  class="td-pmi"> PMI</th>
                                                <th  class="td-total"> TOTAL</th>
                                                <th  class="td-prca"> PRC A</th>
                                                <th  class="td-prcb"> PRC B</th>
                                                <th  class="td-prcab"> PRC AB</th>
                                                <th  class="td-prco"> PRC O</th>
                                                <th  class="td-tca"> TC A</th>
                                                <th  class="td-tcb"> TC B</th>
                                                <th  class="td-tcab"> TC AB</th>
                                                <th  class="td-tco"> TC O</th>
                                                <th  class="td-ffpa"> FFP A</th>
                                                <th  class="td-ffpb"> FFP B</th>
                                                <th  class="td-ffpab"> FFP AB</th>
                                                <th  class="td-ffpo"> FFP O</th>
                                                <th  class="td-wba"> WB A</th>
                                                <th  class="td-wbb"> WB B</th>
                                                <th  class="td-wbab"> WB AB</th>
                                                <th  class="td-wbo"> WB O</th>
                                                <th  class="td-lpa"> LP A</th>
                                                <th  class="td-lpb"> LP B</th>
                                                <th  class="td-lpab"> LP B</th>
                                                <th  class="td-lpo"> LP O</th>
                                                <th  class="td-prclda"> PRC LD A</th>
                                                <th  class="td-prcldab"> PRC LD AB</th>
                                                <th  class="td-prcldb"> PRC LD B</th>
                                                <th  class="td-prcldo"> PRC LD O</th>
                                                
                                            </tr>
                                        </thead>
                                        <?php
                                        if(!empty($records)){
                                        ?>
                                        <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                            <!--record-->
                                            <?php
                                            $counter = 0;
                                            $sum_of_prca = 0;
                                            $sum_of_prcb = 0;
                                            $sum_of_prcab = 0;
                                            $sum_of_prco = 0;
                                            $sum_of_tca = 0;
                                            $sum_of_tcb = 0;
                                            $sum_of_tcab = 0;
                                            $sum_of_tco = 0;
                                            $sum_of_ffpa = 0;
                                            $sum_of_ffpb = 0;
                                            $sum_of_ffpab = 0;
                                            $sum_of_ffpo = 0;
                                            $sum_of_wba = 0;
                                            $sum_of_wbb = 0;
                                            $sum_of_wbab = 0;
                                            $sum_of_wbo = 0;
                                            $sum_of_lpa = 0;
                                            $sum_of_lpb = 0;
                                            $sum_of_lpab = 0;
                                            $sum_of_lpo = 0;
                                            $sum_of_prclda = 0;
                                            $sum_of_prcldab = 0;
                                            $sum_of_prcldb = 0;
                                            $sum_of_prcldo = 0;
                                            $sum_of_total = 0;
                                            foreach($records as $data){
                                            $rec_id = (!empty($data['']) ? urlencode($data['']) : null);
                                            $counter++;
                                            $sum_of_prca = $sum_of_prca + $data['prca'];
                                            $sum_of_prcb = $sum_of_prcb + $data['prcb'];
                                            $sum_of_prcab = $sum_of_prcab + $data['prcab'];
                                            $sum_of_prco = $sum_of_prco + $data['prco'];
                                            $sum_of_tca = $sum_of_tca + $data['tca'];
                                            $sum_of_tcb = $sum_of_tcb + $data['tcb'];
                                            $sum_of_tcab = $sum_of_tcab + $data['tcab'];
                                            $sum_of_tco = $sum_of_tco + $data['tco'];
                                            $sum_of_ffpa = $sum_of_ffpa + $data['ffpa'];
                                            $sum_of_ffpb = $sum_of_ffpb + $data['ffpb'];
                                            $sum_of_ffpab = $sum_of_ffpab + $data['ffpab'];
                                            $sum_of_ffpo = $sum_of_ffpo + $data['ffpo'];
                                            $sum_of_wba = $sum_of_wba + $data['wba'];
                                            $sum_of_wbb = $sum_of_wbb + $data['wbb'];
                                            $sum_of_wbab = $sum_of_wbab + $data['wbab'];
                                            $sum_of_wbo = $sum_of_wbo + $data['wbo'];
                                            $sum_of_lpa = $sum_of_lpa + $data['lpa'];
                                            $sum_of_lpb = $sum_of_lpb + $data['lpb'];
                                            $sum_of_lpab = $sum_of_lpab + $data['lpab'];
                                            $sum_of_lpo = $sum_of_lpo + $data['lpo'];
                                            $sum_of_prclda = $sum_of_prclda + $data['prclda'];
                                            $sum_of_prcldab = $sum_of_prcldab + $data['prcldab'];
                                            $sum_of_prcldb = $sum_of_prcldb + $data['prcldb'];
                                            $sum_of_prcldo = $sum_of_prcldo + $data['prcldo'];
                                            $sum_of_total = $sum_of_total + $data['total'];
                                            ?>
                                            <tr>
                                                <td align="center" class="td-tanggal"> <?php echo $data['tanggal']; ?></td>
                                                <td align="center" class="td-pmi"> <?php echo $data['pmi']; ?></td>
                                                <td  align="center"class="td-total"> <b><?php echo $data['total']; ?> </b></td>
                                                <td align="center" class="td-prca"> <?php echo $data['prca']; ?></td>
                                                <td align="center" class="td-prcb"> <?php echo $data['prcb']; ?></td>
                                                <td align="center" class="td-prcab"> <?php echo $data['prcab']; ?></td>
                                                <td align="center" class="td-prco"> <?php echo $data['prco']; ?></td>
                                                <td align="center" class="td-tca"> <?php echo $data['tca']; ?></td>
                                                <td align="center" class="td-tcb"> <?php echo $data['tcb']; ?></td>
                                                <td align="center" class="td-tcab"> <?php echo $data['tcab']; ?></td>
                                                <td align="center" class="td-tco"> <?php echo $data['tco']; ?></td>
                                                <td  align="center" class="td-ffpa"> <?php echo $data['ffpa']; ?></td>
                                                <td align="center" class="td-ffpb"> <?php echo $data['ffpb']; ?></td>
                                                <td align="center" class="td-ffpab"> <?php echo $data['ffpab']; ?></td>
                                                <td align="center" class="td-ffpo"> <?php echo $data['ffpo']; ?></td>
                                                <td align="center" class="td-wba"> <?php echo $data['wba']; ?></td>
                                                <td align="center" class="td-wbb"> <?php echo $data['wbb']; ?></td>
                                                <td align="center" class="td-wbab"> <?php echo $data['wbab']; ?></td>
                                                <td align="center" class="td-wbo"> <?php echo $data['wbo']; ?></td>
                                                <td align="center" class="td-lpa"> <?php echo $data['lpa']; ?></td>
                                                <td align="center" class="td-lpb"> <?php echo $data['lpb']; ?></td>
                                                <td align="center" class="td-lpab"> <?php echo $data['lpab']; ?></td>
                                                <td align="center" class="td-lpo"> <?php echo $data['lpo']; ?></td>
                                                <td align="center" class="td-prclda"> <?php echo $data['prclda']; ?></td>
                                                <td align="center" class="td-prcldab"> <?php echo $data['prcldab']; ?></td>
                                                <td align="center" class="td-prcldb"> <?php echo $data['prcldb']; ?></td>
                                                <td align="center" class="td-prcldo"> <?php echo $data['prcldo']; ?></td>
                                                
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                            <!--endrecord-->
                                        </tbody>
                                        <tbody class="search-data" id="search-data-<?php echo $page_element_id; ?>"></tbody>
                                        <tfoot><tr><th></th><th></th><th><?php echo $sum_of_total ;  ?></th><th><?php echo $sum_of_prca;  ?></th><th><?php echo $sum_of_prcb;  ?></th><th><?php echo $sum_of_prcab;  ?></th><th><?php echo $sum_of_prco;  ?></th><th><?php echo $sum_of_tca;  ?></th><th><?php echo $sum_of_tcb;  ?></th><th><?php echo $sum_of_tcab;  ?></th><th><?php echo $sum_of_tco;  ?></th><th><?php echo $sum_of_ffpa;  ?></th><th><?php echo $sum_of_ffpb;  ?></th><th><?php echo $sum_of_ffpab;  ?></th><th><?php echo $sum_of_ffpo;  ?></th><th><?php echo $sum_of_wba;  ?></th><th><?php echo $sum_of_wbb;  ?></th><th><?php echo $sum_of_wbab;  ?></th><th><?php echo $sum_of_wbo;  ?></th><th><?php echo $sum_of_lpa;  ?></th><th><?php echo $sum_of_lpb;  ?></th><th><?php echo $sum_of_lpab;  ?></th><th><?php echo $sum_of_lpo;  ?></th><th><?php echo $sum_of_prclda;  ?></th><th><?php echo $sum_of_prcldab;  ?></th><th><?php echo $sum_of_prcldb;  ?></th><th><?php echo $sum_of_prcldo;  ?></th></tr></tfoot>
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
