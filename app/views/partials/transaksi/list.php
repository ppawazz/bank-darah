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
                    <h2 class="record-title text-primary">TRANSAKSI BDRS</h2>
                </div>
                <div class="col-sm-3 ">
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("transaksi/add") ?>">
                        <i class="fa fa-plus"></i>                              
                        Tambah Data 
                    </a>
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
            <div class="container">
                <div class="row ">
                    <div class="col-md-4 comp-grid">
                        <form method="get" action="<?php print_link($current_page) ?>" class="form filter-form">
                            <div class="card mb-3 alert-info">
                                <div class="card-header h4 h4">Tanggal Transaksi</div>
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
                                <div class="card mb-3 alert-danger">
                                    <div class="card-header h4 h4">Jenis Darah</div>
                                    <div class="p-2">
                                        <select   name="jenis_darah_jenis" class="form-control custom ">
                                            <option value="">--Pilih Data--</option>
                                            <?php 
                                            $jenis_darah_jenis_options = $comp_model -> transaksi_jenis_darahjenis_option_list();
                                            if(!empty($jenis_darah_jenis_options)){
                                            foreach($jenis_darah_jenis_options as $option){
                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                            $selected = $this->set_field_selected('jenis_darah_jenis',$value);
                                            ?>
                                            <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                <?php echo $label; ?>
                                            </option>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="card mb-3 alert-success">
                                    <div class="card-header h4 h4">Kondisi</div>
                                    <div class="p-2">
                                        <select   name="transaksi_kondisi" class="form-control custom ">
                                            <option value="">--Pilih Data--</option>
                                            <?php
                                            $transaksi_kondisi_options = Menu :: $transaksi_kondisi;
                                            if(!empty($transaksi_kondisi_options)){
                                            foreach($transaksi_kondisi_options as $option){
                                            $value = $option['value'];
                                            $label = $option['label'];
                                            $selected = $this->set_field_selected('transaksi_kondisi', $value);
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
                                <div class="card mb-3 alert-warning">
                                    <div class="card-header h4 h4">Jaminan</div>
                                    <div class="p-2">
                                        <select   name="transaksi_jaminan" class="form-control custom ">
                                            <option value="">--Pilih Data--</option>
                                            <?php
                                            $transaksi_jaminan_options = Menu :: $jaminan;
                                            if(!empty($transaksi_jaminan_options)){
                                            foreach($transaksi_jaminan_options as $option){
                                            $value = $option['value'];
                                            $label = $option['label'];
                                            $selected = $this->set_field_selected('transaksi_jaminan', $value);
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
                                    <button class="btn btn-primary">Cari Data</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12 comp-grid">
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
                                if(!empty(get_value('jenis_darah_jenis'))){
                                ?>
                                <div class="filter-chip card bg-light">
                                    <b>Jenis Darah Jenis :</b> 
                                    <?php 
                                    if(get_value('jenis_darah_jenislabel')){
                                    echo get_value('jenis_darah_jenislabel');
                                    }
                                    else{
                                    echo get_value('jenis_darah_jenis');
                                    }
                                    $remove_link = unset_get_value('jenis_darah_jenis', $this->route->page_url);
                                    ?>
                                    <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                        &times;
                                    </a>
                                </div>
                                <?php
                                }
                                ?>
                                <?php
                                if(!empty(get_value('transaksi_kondisi'))){
                                ?>
                                <div class="filter-chip card bg-light">
                                    <b>Transaksi Kondisi :</b>
                                    <?php
                                    if(get_value('transaksi_kondisilabel')){
                                    echo get_value('transaksi_kondisilabel');
                                    }
                                    else{
                                    echo get_value('transaksi_kondisi');
                                    }
                                    $remove_link = unset_get_value('transaksi_kondisi', $this->route->page_url);
                                    ?>
                                    <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                        &times;
                                    </a>
                                </div>
                                <?php
                                }
                                ?>
                                <?php
                                if(!empty(get_value('transaksi_jaminan'))){
                                ?>
                                <div class="filter-chip card bg-light">
                                    <b>Jaminan :</b>
                                    <?php
                                    echo get_value('transaksi_jaminan');
                                    $remove_link = unset_get_value('transaksi_jaminan', $this->route->page_url);
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
                                <div id="transaksi-list-records">
                                    <div id="page-report-body" class="table-responsive">
                                        <?php Html::ajaxpage_spinner(); ?>
                                        <table class="table table-hover table-striped table-sm text-left">
                                            <thead class="table-header bg-light">
                                                <tr>
                                                    <th class="td-sno">#</th>
                                                    <th  class="td-tanggal"> Tanggal</th>
                                                    <th  class="td-mrn"> Mrn</th>
                                                    <th  class="td-nama"> Nama</th>
                                                    <th  class="td-keterangan"> Keterangan</th>
                                                    <th  class="td-pemberi_pemberi"> Pemberi</th>
                                                    <th  class="td-diagnosa"> Diagnosa</th>
                                                    <th  class="td-penerima_penerima"> Penerima</th>
                                                    <th  class="td-goldar_golongan_darah"> Golongan Darah</th>
                                                    <th  class="td-jenis_darah_jenis"> Jenis Darah</th>
                                                    <th  class="td-jumlah"> Jumlah</th>
                                                    <th  class="td-no_kantong"> No Kantong</th>
                                                    <th  class="td-pmi"> PMI</th>
                                                    <th  class="td-jam_mulai"> Jam Mulai</th>
                                                    <th  class="td-jam_selesai"> Jam Selesai</th>
                                                    <th  class="td-waktu_cross"> Total Waktu Cross Match</th>
                                                    <th  class="td-kondisi"> Kondisi</th>
                                                    <th  class="td-jaminan"> Jaminan</th>
                                                    <th  class="td-pengembalian"> Pengembalian</th>
                                                    <th  class="td-reaksi"> Reaksi</th>
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
                                                    <td class="td-keterangan">
                                                        <span  data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="keterangan" 
                                                            data-title="Keterangan" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="textarea" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['keterangan']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-pemberi_pemberi"> <?php echo $data['pemberi_pemberi']; ?></td>
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
                                                    <td class="td-penerima_penerima"> <?php echo $data['penerima_penerima']; ?></td>
                                                    <td class="td-goldar_golongan_darah"> <?php echo $data['goldar_golongan_darah']; ?></td>
                                                    <td class="td-jenis_darah_jenis"> <?php echo $data['jenis_darah_jenis']; ?></td>
                                                    <td class="td-jumlah">
                                                        <span  data-value="<?php echo $data['jumlah']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="jumlah" 
                                                            data-title="Jumlah" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['jumlah']; ?> 
                                                        </span>
                                                    </td>
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
                                                    <td class="td-pmi">
                                                        <span  data-source='<?php echo json_encode_quote(Menu :: $pmi); ?>' 
                                                            data-value="<?php echo $data['pmi']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="pmi" 
                                                            data-title="Enter Pmi" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="radiolist" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['pmi']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-jam_mulai">
                                                        <span  data-flatpickr="{altFormat: 'd-m-Y H:i:s', minDate: '', maxDate: ''}" 
                                                            data-value="<?php echo $data['jam_mulai']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="jam_mulai" 
                                                            data-title="Jam Mulai" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="flatdatetimepicker" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['jam_mulai']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-jam_selesai">
                                                        <span  data-flatpickr="{altFormat: 'd-m-Y H:i:s', minDate: '', maxDate: ''}" 
                                                            data-value="<?php echo $data['jam_selesai']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="jam_selesai" 
                                                            data-title="Jam Selesai" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="flatdatetimepicker" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['jam_selesai']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-waktu_cross"> <?php echo $data['waktu_cross']; ?></td>
                                                    <td class="td-kondisi">
                                                        <span  data-source='<?php echo json_encode_quote(Menu :: $kondisi); ?>'
                                                            data-value="<?php echo $data['kondisi']; ?>"
                                                            data-pk="<?php echo $data['id'] ?>"
                                                            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>"
                                                            data-name="kondisi"
                                                            data-title="--Pilih Data--"
                                                            data-placement="left"
                                                            data-toggle="click"
                                                            data-type="select"
                                                            data-mode="popover"
                                                            data-showbuttons="left"
                                                            class="is-editable" >
                                                            <?php echo $data['kondisi']; ?>
                                                        </span>
                                                    </td>
                                                    <td class="td-jaminan"> <?php echo $data['jaminan']; ?></td>
                                                    <td class="td-pengembalian">
                                                        <span  data-source='<?php echo json_encode_quote(Menu :: $pengembalian); ?>' 
                                                            data-value="<?php echo $data['pengembalian']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="pengembalian" 
                                                            data-title="Pengembalian" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="radiolist" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['pengembalian']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-reaksi">
                                                        <span  data-source='<?php echo json_encode_quote(Menu :: $pengembalian); ?>' 
                                                            data-value="<?php echo $data['reaksi']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("transaksi/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="reaksi" 
                                                            data-title="Enter Reaksi" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="radiolist" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['reaksi']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-phlebotomy"> <?php echo $data['phlebotomy']; ?></td>
                                                    <th class="td-btn">
                                                        <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("transaksi/edit/$rec_id"); ?>">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("transaksi/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Apakah anda yakin akan menghapus data ini?" data-display-style="modal">
                                                            <i class="fa fa-times"></i>
                                                            Delete
                                                        </a>
                                                    </th>
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
                                                    <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("transaksi/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                        <i class="fa fa-times"></i> Delete Selected
                                                    </button>
                                                    <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                    <a class="btn  btn-sm btn-primary export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                        <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                        </a>
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
                            <div class="col-md-4 comp-grid">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
