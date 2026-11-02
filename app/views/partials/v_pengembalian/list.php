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
                    <h3 class="record-title text-primary">Rekap Pengembalian Darah</h3>
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
                                        <a class="text-decoration-none" href="<?php print_link('v_pengembalian'); ?>">
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
                                        <a class="text-decoration-none" href="<?php print_link('v_pengembalian'); ?>">
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
                            <div class="card mb-3 alert-info">
                                <div class="card-header h4 h4">Tanggal Transaksi</div>
                                <div class="p-2">
                                    <input class="form-control datepicker"  value="<?php echo $this->set_field_value('v_pengembalian_tanggal') ?>" type="datetime"  name="v_pengembalian_tanggal" placeholder="" data-enable-time="" data-date-format="Y-m-d" data-alt-format="M j, Y" data-inline="false" data-no-calendar="false" data-mode="range" />
                                    </div>
                                </div>
                                <div class="card mb-3 alert-primary">
                                    <div class="card-header h4 h4">PMI</div>
                                    <div class="p-2">
                                        <select   name="v_pengembalian_pmi" class="form-control custom ">
                                            <option value="">Select a value ...</option>
                                            <?php
                                            $v_pengembalian_pmi_options = Menu :: $pmi;
                                            if(!empty($v_pengembalian_pmi_options)){
                                            foreach($v_pengembalian_pmi_options as $option){
                                            $value = $option['value'];
                                            $label = $option['label'];
                                            $selected = $this->set_field_selected('v_pengembalian_pmi', $value);
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
                                    <button class="btn btn-primary">Filter</button>
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
                                if(!empty($_GET['v_pengembalian_tanggal'])){
                                ?>
                                <div class="filter-chip card bg-light">
                                    <b>Rekap Pengembalian Darah :</b> 
                                    <?php
                                    $date_val = get_value('v_pengembalian_tanggal');
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
                                    $remove_link = unset_get_value('v_pengembalian_tanggal', $this->route->page_url);
                                    ?>
                                    <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                        &times;
                                    </a>
                                </div>
                                <?php
                                }
                                ?>
                                <?php
                                if(!empty(get_value('v_pengembalian_pmi'))){
                                ?>
                                <div class="filter-chip card bg-light">
                                    <b>V Pengembalian Pmi :</b> 
                                    <?php 
                                    if(get_value('v_pengembalian_pmilabel')){
                                    echo get_value('v_pengembalian_pmilabel');
                                    }
                                    else{
                                    echo get_value('v_pengembalian_pmi');
                                    }
                                    $remove_link = unset_get_value('v_pengembalian_pmi', $this->route->page_url);
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
                                <div id="v_pengembalian-list-records">
                                    <div id="page-report-body" class="table-responsive">
                                        <?php Html::ajaxpage_spinner(); ?>
                                        <table class="table table-hover table-striped table-sm text-center">
                                            <thead class="table-header bg-primary text-white">
                                                <tr>
                                                    <th class="td-sno">No</th>
                                                    <th  class="td-tanggal"> Tanggal Permintaan</th>
                                                    <th  class="td-nama"> Nama</th>
                                                    <th  class="td-mrn"> MRN</th>
                                                    <th  class="td-diagnosa"> Diagnosa</th>
                                                    <th  class="td-no_kantong"> No Labu Darah</th>
                                                    <th  class="td-penerima"> Ruangan</th>
                                                    <th  class="td-jenis"> Jenis</th>
                                                    <th  class="td-pmi"> PMI</th>
                                                    <th  class="td-jumlah"> Jumlah Permintaan</th>
                                                    <th  class="td-jumlah_kembali"> Jumlah Pengembalian</th>
                                                    <th  class="td-no_labu_kembali"> No Labu Darah yang Dikembalikan</th>
                                                    <th  class="td-tgl_kadaluarsa"> Tgl Kadaluarsa</th>
                                                    <th  class="td-tgl_kembali"> Tgl Pengembalian</th>
                                                    <th  class="td-alasan"> Alasan</th>
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
                                                $rec_id = (!empty($data['']) ? urlencode($data['']) : null);
                                                $counter++;
                                                ?>
                                                <tr>
                                                    <th class="td-sno"><?php echo $counter; ?></th>
                                                    <td class="td-tanggal"> <?php echo $data['tanggal']; ?></td>
                                                    <td class="td-nama"> <?php echo $data['nama']; ?></td>
                                                    <td class="td-mrn"> <?php echo $data['mrn']; ?></td>
                                                    <td class="td-diagnosa"> <?php echo $data['diagnosa']; ?></td>
                                                    <td class="td-no_kantong"> <?php echo $data['no_kantong']; ?></td>
                                                    <td class="td-penerima"> <?php echo $data['penerima']; ?></td>
                                                    <td class="td-jenis"> <?php echo $data['jenis']; ?></td>
                                                    <td class="td-pmi"> <?php echo $data['pmi']; ?></td>
                                                    <td align="center" class="td-jumlah"> <?php echo $data['jumlah']; ?></td>
                                                    <td align="center" class="td-jumlah_kembali"> <?php echo $data['jumlah_kembali']; ?></td>
                                                    <td class="td-no_labu_kembali"> <?php echo $data['no_labu_kembali']; ?></td>
                                                    <td class="td-tgl_kadaluarsa"> <?php echo $data['tgl_kadaluarsa']; ?></td>
                                                    <td class="td-tgl_kembali"> <?php echo $data['tgl_kembali']; ?></td>
                                                    <td class="td-alasan"> <?php echo $data['alasan']; ?></td>
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
																<?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                                                <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                                    <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
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
