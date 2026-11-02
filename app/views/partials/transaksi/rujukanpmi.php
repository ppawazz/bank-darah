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
                    <h2 class="record-title text-primary">DAFTAR RUJUKAN PMI</h2>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('transaksi/'); ?>" method="get">
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
            <div class="container">
                <div class="row ">
                    <div class="col-md-12 comp-grid">
                    </div>
                    <div class="col-md-4 comp-grid">
                        <form method="get" action="<?php print_link($current_page) ?>" class="form filter-form">
                            <div class="card mb-3 alert-info">
                                <div class="card-header h4 h4">Tanggal Rujukan</div>
                                <div class="p-2">
                                    <input class="form-control datepicker"  value="<?php echo $this->set_field_value('transaksi_tanggal') ?>" type="datetime"  name="transaksi_tanggal" placeholder="" data-enable-time="" data-date-format="Y-m-d" data-alt-format="M j, Y" data-inline="false" data-no-calendar="false" data-mode="range" />
                                    </div>
                                </div>
                                <div class="card mb-3 alert-primary">
                                    <div class="card-header h4 h4">PMI</div>
                                    <div class="p-2">
                                        <select   name="transaksi_pmi" class="form-control custom ">
                                            <option value="">--Pilih Data--</option>
                                            <?php
                                            $transaksi_pmi_options = Menu :: $pmi;
                                            if(!empty($transaksi_pmi_options)){
                                            foreach($transaksi_pmi_options as $option){
                                            $value = $option['value'];
                                            $label = $option['label'];
                                            $selected = $this->set_field_selected('transaksi_pmi', $value);
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
                                <div class="card mb-3 alert-success">
                                    <div class="card-header h4 h4">CrossCheck</div>
                                    <div class="p-2">
                                        <select   name="transaksi_crosscheck" class="form-control custom ">
                                            <option value="">--Pilih Data--</option>
                                            <?php
                                            $transaksi_crosscheck_options = Menu :: $crosscheck;
                                            if(!empty($transaksi_crosscheck_options)){
                                            foreach($transaksi_crosscheck_options as $option){
                                            $value = $option['value'];
                                            $label = $option['label'];
                                            $selected = $this->set_field_selected('transaksi_crosscheck', $value);
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
                                <div class="card mb-3 alert-info">
                                    <div class="card-header h4 h4">Phlebotomy</div>
                                    <div class="p-2">
                                        <?php
                                        $transaksi_phlebotomy_options = Menu :: $pengembalian;
                                        if(!empty($transaksi_phlebotomy_options)){
                                        foreach($transaksi_phlebotomy_options as $option){
                                        $value = $option['value'];
                                        $label = $option['label'];
                                        //check if current option is checked option
                                        $checked = $this->set_field_checked('transaksi_phlebotomy', $value);
                                        ?>
                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input id="" class="custom-control-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio" name="transaksi_phlebotomy"  />
                                                <span class="custom-control-label"><?php echo $label ?></span>
                                            </label>
                                            <?php
                                            }
                                            }
                                            ?>
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
                                    if(!empty($_GET['transaksi_tanggal'])){
                                    ?>
                                    <div class="filter-chip card bg-light">
                                        <b>Transaksi Tanggal :</b> 
                                        <?php
                                        $date_val = get_value('transaksi_tanggal');
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
                                        $remove_link = unset_get_value('transaksi_tanggal', $this->route->page_url);
                                        ?>
                                        <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                            &times;
                                        </a>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if(!empty(get_value('transaksi_pmi'))){
                                    ?>
                                    <div class="filter-chip card bg-light">
                                        <b>PMI :</b> 
                                        <?php 
                                        if(get_value('transaksi_pmilabel')){
                                        echo get_value('transaksi_pmilabel');
                                        }
                                        else{
                                        echo get_value('transaksi_pmi');
                                        }
                                        $remove_link = unset_get_value('transaksi_pmi', $this->route->page_url);
                                        ?>
                                        <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                            &times;
                                        </a>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if(!empty(get_value('transaksi_crosscheck'))){
                                    ?>
                                    <div class="filter-chip card bg-light">
                                        <b>Transaksi Crosscheck :</b> 
                                        <?php 
                                        if(get_value('transaksi_crosschecklabel')){
                                        echo get_value('transaksi_crosschecklabel');
                                        }
                                        else{
                                        echo get_value('transaksi_crosscheck');
                                        }
                                        $remove_link = unset_get_value('transaksi_crosscheck', $this->route->page_url);
                                        ?>
                                        <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                            &times;
                                        </a>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if(!empty(get_value('transaksi_phlebotomy'))){
                                    ?>
                                    <div class="filter-chip card bg-light">
                                        <b>Phlebotomy :</b> 
                                        <?php 
                                        if(get_value('transaksi_phlebotomylabel')){
                                        echo get_value('transaksi_phlebotomylabel');
                                        }
                                        else{
                                        echo get_value('transaksi_phlebotomy');
                                        }
                                        $remove_link = unset_get_value('transaksi_phlebotomy', $this->route->page_url);
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
                                    <div id="transaksi-rujukanpmi-records">
                                        <div id="page-report-body" class="table-responsive">
                                            <table class="table table-hover table-striped text-left">
                                                <thead class="table-header bg-primary text-white">
                                                    <tr>
                                                        <th class="td-sno">#</th>
                                                        <th  class="td-tanggal"> Tanggal</th>
                                                        <th  class="td-nama"> Nama Pasien</th>
                                                        <th  class="td-mrn"> MRN</th>
                                                        <th  class="td-pmi"> Tujuan (PMI)</th>
                                                        <th  class="td-goldar_golongan_darah"> Golongan Darah</th>
                                                        <th  class="td-jenis_darah_jenis"> Jenis Darah</th>
                                                        <th  class="td-no_kantong"> No Kantong</th>
                                                        <th  class="td-diagnosa"> Diagnosa</th>
                                                        <th  class="td-jumlah"> Jumlah</th>
                                                        <th  class="td-harga"> Harga</th>
                                                        <th  class="td-total"> Total</th>
                                                        <th  class="td-crosscheck"> Crosscheck</th>
                                                        <th  class="td-phlebotomy"> Phlebotomy</th>
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
                                                        <td class="td-tanggal"> <?php echo $data['tanggal']; ?></td>
                                                        <td class="td-nama"> <?php echo $data['nama']; ?></td>
                                                        <td class="td-mrn"> <?php echo $data['mrn']; ?></td>
                                                        <td class="td-pmi"> <?php echo $data['pmi']; ?></td>
                                                        <td class="td-goldar_golongan_darah">
                                                            <span  data-value="<?php echo $data['goldar_golongan_darah']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("goldar/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="golongan_darah" 
                                                                data-title="Enter Golongan Darah" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="text" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" >
                                                                <?php echo $data['goldar_golongan_darah']; ?> 
                                                            </span>
                                                        </td>
                                                        <td class="td-jenis_darah_jenis">
                                                            <span  data-value="<?php echo $data['jenis_darah_jenis']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("jenis_darah/editfield/" . urlencode($data['jenis_id'])); ?>" 
                                                                data-name="jenis" 
                                                                data-title="Enter Jenis" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="text" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" >
                                                                <?php echo $data['jenis_darah_jenis']; ?> 
                                                            </span>
                                                        </td>
                                                        <td class="td-no_kantong"> <?php echo $data['no_kantong']; ?></td>
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
                                                        <td class="td-jumlah"> <?php echo $data['jumlah']; ?></td>
                                                        <td class="td-harga">
                                                            <span  data-source='<?php echo json_encode_quote(Menu :: $harga); ?>' 
                                                                data-value="<?php echo $data['harga']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="harga" 
                                                                data-title="Select a value ..." 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="select" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" >
                                                                <?php echo $data['harga']; ?> 
                                                            </span>
                                                        </td>
                                                        <td class="td-total"> <span><?php echo "Rp. ".number_format($data['total']); ?><span></td>
                                                            <td class="td-crosscheck">
                                                                <span  data-source='<?php echo json_encode_quote(Menu :: $crosscheck); ?>' 
                                                                    data-value="<?php echo $data['crosscheck']; ?>" 
                                                                    data-pk="<?php echo $data['id'] ?>" 
                                                                    data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                                    data-name="crosscheck" 
                                                                    data-title="Crosscheck" 
                                                                    data-placement="left" 
                                                                    data-toggle="click" 
                                                                    data-type="radiolist" 
                                                                    data-mode="popover" 
                                                                    data-showbuttons="left" 
                                                                    class="is-editable" >
                                                                    <?php echo $data['crosscheck']; ?> 
                                                                </span>
                                                            </td>
                                                            <td class="td-phlebotomy"> <?php echo $data['phlebotomy']; ?></td>
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
