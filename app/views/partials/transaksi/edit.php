<?php
$comp_model = new SharedController;
$page_element_id = "edit-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="edit"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Edit  Transaksi</h4>
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
                <div class="col-md-7 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("transaksi/edit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="tanggal">Tanggal <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input id="ctrl-tanggal" class="form-control datepicker  datepicker"  required="" value="<?php  echo $data['tanggal']; ?>" type="datetime" name="tanggal" placeholder="Tanggal" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="d-m-Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="mrn">Mrn </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input id="ctrl-mrn"  value="<?php  echo $data['mrn']; ?>" type="text" placeholder="Mrn"  name="mrn"  class="form-control " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="nama">Nama </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input id="ctrl-nama"  value="<?php  echo $data['nama']; ?>" type="text" placeholder="Nama"  name="nama"  class="form-control " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="goldar">Goldar <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <select required=""  id="ctrl-goldar" data-load-select-options="jenis_id" name="goldar"  placeholder="--Pilih Data--"    class="custom-select" >
                                                                <option value="">--Pilih Data--</option>
                                                                <?php
                                                                $rec = $data['goldar'];
                                                                $goldar_options = $comp_model -> transaksi_goldar_option_list();
                                                                if(!empty($goldar_options)){
                                                                foreach($goldar_options as $option){
                                                                $value = (!empty($option['value']) ? $option['value'] : null);
                                                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                $selected = ( $value == $rec ? 'selected' : null );
                                                                ?>
                                                                <option 
                                                                    <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $label; ?>
                                                                </option>
                                                                <?php
                                                                }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="jenis_id">Jenis <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <select required=""  id="ctrl-jenis_id" data-load-path="<?php print_link('api/json/transaksi_jenis_id_option_list') ?>" name="jenis_id"  placeholder="--Pilih Data--"    class="custom-select" >
                                                                <?php
                                                                $rec = $data['jenis_id'];
                                                                $jenis_id_options = $comp_model -> transaksi_jenis_id_option_list($data['goldar']);
                                                                if(!empty($jenis_id_options)){
                                                                foreach($jenis_id_options as $option){
                                                                $value = (!empty($option['value']) ? $option['value'] : null);
                                                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                $selected = ( $value == $rec ? 'selected' : null );
                                                                ?>
                                                                <option 
                                                                    <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $label; ?>
                                                                </option>
                                                                <?php
                                                                }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="keterangan">Keterangan <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <textarea placeholder="Keterangan" id="ctrl-keterangan"  required="" rows="5" name="keterangan" class=" form-control"><?php  echo $data['keterangan']; ?></textarea>
                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="memberi">Memberi </label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <select  id="ctrl-memberi" name="memberi"  placeholder="--Pilih Data--"    class="custom-select" >
                                                                <option value="">--Pilih Data--</option>
                                                                <?php
                                                                $rec = $data['memberi'];
                                                                $memberi_options = $comp_model -> transaksi_memberi_option_list();
                                                                if(!empty($memberi_options)){
                                                                foreach($memberi_options as $option){
                                                                $value = (!empty($option['value']) ? $option['value'] : null);
                                                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                $selected = ( $value == $rec ? 'selected' : null );
                                                                ?>
                                                                <option 
                                                                    <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $label; ?>
                                                                </option>
                                                                <?php
                                                                }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="menerima">Menerima </label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <select  id="ctrl-menerima" name="menerima"  placeholder="--Pilih Data--"    class="custom-select" >
                                                                <option value="">--Pilih Data--</option>
                                                                <?php
                                                                $rec = $data['menerima'];
                                                                $menerima_options = $comp_model -> transaksi_menerima_option_list();
                                                                if(!empty($menerima_options)){
                                                                foreach($menerima_options as $option){
                                                                $value = (!empty($option['value']) ? $option['value'] : null);
                                                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                $selected = ( $value == $rec ? 'selected' : null );
                                                                ?>
                                                                <option 
                                                                    <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $label; ?>
                                                                </option>
                                                                <?php
                                                                }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="jumlah">Jumlah <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <input id="ctrl-jumlah"  value="<?php  echo $data['jumlah']; ?>" type="number" placeholder="Jumlah" step="1"  required="" name="jumlah"  class="form-control " />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="no_kantong">No Kantong <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <textarea placeholder="No Kantong" id="ctrl-no_kantong"  required="" rows="5" name="no_kantong" class=" form-control"><?php  echo $data['no_kantong']; ?></textarea>
                                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="pmi">Pmi <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <?php
                                                                $pmi_options = Menu :: $pmi;
                                                                $field_value = $data['pmi'];
                                                                if(!empty($pmi_options)){
                                                                foreach($pmi_options as $option){
                                                                $value = $option['value'];
                                                                $label = $option['label'];
                                                                //check if value is among checked options
                                                                $checked = $this->check_form_field_checked($field_value, $value);
                                                                ?>
                                                                <label class="custom-control custom-radio custom-control-inline">
                                                                    <input id="ctrl-pmi" class="custom-control-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio" required=""   name="pmi" />
                                                                        <span class="custom-control-label"><?php echo $label ?></span>
                                                                    </label>
                                                                    <?php
                                                                    }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label" for="diagnosa">Diagnosa <span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="">
                                                                    <input id="ctrl-diagnosa"  value="<?php  echo $data['diagnosa']; ?>" type="text" placeholder="Diagnosa"  required="" name="diagnosa"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" for="jam_mulai">Jam Mulai <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group">
                                                                        <input id="ctrl-jam_mulai" class="form-control datepicker  datepicker" required="" value="<?php  echo $data['jam_mulai']; ?>" type="datetime"  name="jam_mulai" placeholder="Jam Mulai" data-enable-time="true" data-min-date="" data-max-date="" data-date-format="Y-m-d H:i:S" data-alt-format="d-m-Y H:i:s" data-inline="false" data-no-calendar="false" data-mode="single" /> 
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label" for="jam_selesai">Jam Selesai <span class="text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="input-group">
                                                                            <input id="ctrl-jam_selesai" class="form-control datepicker  datepicker" required="" value="<?php  echo $data['jam_selesai']; ?>" type="datetime"  name="jam_selesai" placeholder="Jam Selesai" data-enable-time="true" data-min-date="" data-max-date="" data-date-format="Y-m-d H:i:S" data-alt-format="d-m-Y H:i:s" data-inline="false" data-no-calendar="false" data-mode="single" /> 
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <div class="row">
                                                                        <div class="col-sm-4">
                                                                            <label class="control-label" for="kondisi">Kondisi <span class="text-danger">*</span></label>
                                                                        </div>
                                                                        <div class="col-sm-8">
                                                                            <div class="">
                                                                                <select required=""  id="ctrl-kondisi" name="kondisi"  placeholder="--Pilih Data--"    class="custom-select" >
                                                                                    <option value="">--Pilih Data--</option>
                                                                                    <?php
                                                                                    $kondisi_options = Menu :: $kondisi;
                                                                                    $field_value = $data['kondisi'];
                                                                                    if(!empty($kondisi_options)){
                                                                                    foreach($kondisi_options as $option){
                                                                                    $value = $option['value'];
                                                                                    $label = $option['label'];
                                                                                    $selected = ( $value == $field_value ? 'selected' : null );
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
                                                                    </div>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <div class="row">
                                                                        <div class="col-sm-4">
                                                                            <label class="control-label" for="pengembalian">Pengembalian </label>
                                                                        </div>
                                                                        <div class="col-sm-8">
                                                                            <div class="">
                                                                                <?php
                                                                                $pengembalian_options = Menu :: $pengembalian;
                                                                                $field_value = $data['pengembalian'];
                                                                                if(!empty($pengembalian_options)){
                                                                                foreach($pengembalian_options as $option){
                                                                                $value = $option['value'];
                                                                                $label = $option['label'];
                                                                                //check if value is among checked options
                                                                                $checked = $this->check_form_field_checked($field_value, $value);
                                                                                ?>
                                                                                <label class="custom-control custom-radio custom-control-inline">
                                                                                    <input id="ctrl-pengembalian" class="custom-control-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio"   name="pengembalian" />
                                                                                        <span class="custom-control-label"><?php echo $label ?></span>
                                                                                    </label>
                                                                                    <?php
                                                                                    }
                                                                                    }
                                                                                    ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <div class="row">
                                                                            <div class="col-sm-4">
                                                                                <label class="control-label" for="jumlah_kembali">Jumlah Pengembalian </label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                <div class="">
                                                                                    <input id="ctrl-jumlah_kembali"  value="<?php  echo $data['jumlah_kembali']; ?>" type="number" placeholder="Jumlah Pengembalian" step="1"  name="jumlah_kembali"  class="form-control " />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group ">
                                                                            <div class="row">
                                                                                <div class="col-sm-4">
                                                                                    <label class="control-label" for="tgl_kembali">Tgl Kembali </label>
                                                                                </div>
                                                                                <div class="col-sm-8">
                                                                                    <div class="input-group">
                                                                                        <input id="ctrl-tgl_kembali" class="form-control datepicker  datepicker"  value="<?php  echo $data['tgl_kembali']; ?>" type="datetime" name="tgl_kembali" placeholder="Tgl Kembali" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="d-m-Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                                            <div class="input-group-append">
                                                                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group ">
                                                                                <div class="row">
                                                                                    <div class="col-sm-4">
                                                                                        <label class="control-label" for="no_labu_kembali">No Labu Pengembalian </label>
                                                                                    </div>
                                                                                    <div class="col-sm-8">
                                                                                        <div class="">
                                                                                            <textarea placeholder="No Labu Pengembalian" id="ctrl-no_labu_kembali"  rows="5" name="no_labu_kembali" class=" form-control"><?php  echo $data['no_labu_kembali']; ?></textarea>
                                                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group ">
                                                                                <div class="row">
                                                                                    <div class="col-sm-4">
                                                                                        <label class="control-label" for="tgl_kadaluarsa">Tanggal Kadaluarsa </label>
                                                                                    </div>
                                                                                    <div class="col-sm-8">
                                                                                        <div class="input-group">
                                                                                            <input id="ctrl-tgl_kadaluarsa" class="form-control datepicker  datepicker"  value="<?php  $v = $data['tgl_kadaluarsa']; echo (empty($v) || $v === '0000-00-00' || $v === '0000-00-00 00:00:00') ? '' : $v; ?>" type="datetime" name="tgl_kadaluarsa" placeholder="Tanggal Kadaluarsa" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                                                <div class="input-group-append">
                                                                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group ">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-4">
                                                                                            <label class="control-label" for="alasan">Alasan Pengembalian </label>
                                                                                        </div>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="">
                                                                                                <textarea placeholder="Alasan Pengembalian" id="ctrl-alasan"  rows="5" name="alasan" class=" form-control"><?php  echo $data['alasan']; ?></textarea>
                                                                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group ">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-4">
                                                                                            <label class="control-label" for="harga">Harga </label>
                                                                                        </div>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="">
                                                                                                <select  id="ctrl-harga" name="harga"  placeholder="Select a value ..."    class="custom-select" >
                                                                                                    <option value="">Select a value ...</option>
                                                                                                    <?php
                                                                                                    $harga_options = Menu :: $harga;
                                                                                                    $field_value = $data['harga'];
                                                                                                    if(!empty($harga_options)){
                                                                                                    foreach($harga_options as $option){
                                                                                                    $value = $option['value'];
                                                                                                    $label = $option['label'];
                                                                                                    $selected = ( $value == $field_value ? 'selected' : null );
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
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group ">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-4">
                                                                                            <label class="control-label" for="status">Hasil Lab </label>
                                                                                        </div>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="">
                                                                                                <input id="ctrl-status"  value="<?php  echo $data['status']; ?>" type="text" placeholder="Hasil Lab"  name="status"  class="form-control " />
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group ">
                                                                                        <div class="row">
                                                                                            <div class="col-sm-4">
                                                                                                <label class="control-label" for="crosscheck">Crosscheck </label>
                                                                                            </div>
                                                                                            <div class="col-sm-8">
                                                                                                <div class="">
                                                                                                    <?php
                                                                                                    $crosscheck_options = Menu :: $crosscheck;
                                                                                                    $field_value = $data['crosscheck'];
                                                                                                    if(!empty($crosscheck_options)){
                                                                                                    foreach($crosscheck_options as $option){
                                                                                                    $value = $option['value'];
                                                                                                    $label = $option['label'];
                                                                                                    //check if value is among checked options
                                                                                                    $checked = $this->check_form_field_checked($field_value, $value);
                                                                                                    ?>
                                                                                                    <label class="custom-control custom-radio custom-control-inline">
                                                                                                        <input id="ctrl-crosscheck" class="custom-control-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio"   name="crosscheck" />
                                                                                                            <span class="custom-control-label"><?php echo $label ?></span>
                                                                                                        </label>
                                                                                                        <?php
                                                                                                        }
                                                                                                        }
                                                                                                        ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group ">
                                                                                            <div class="row">
                                                                                                <div class="col-sm-4">
                                                                                                    <label class="control-label" for="mayor">Mayor </label>
                                                                                                </div>
                                                                                                <div class="col-sm-8">
                                                                                                    <div class="">
                                                                                                        <?php
                                                                                                        $mayor_options = Menu :: $mayor;
                                                                                                        $field_value = $data['mayor'];
                                                                                                        if(!empty($mayor_options)){
                                                                                                        foreach($mayor_options as $option){
                                                                                                        $value = $option['value'];
                                                                                                        $label = $option['label'];
                                                                                                        //check if value is among checked options
                                                                                                        $checked = $this->check_form_field_checked($field_value, $value);
                                                                                                        ?>
                                                                                                        <label class="custom-control custom-radio custom-control-inline">
                                                                                                            <input id="ctrl-mayor" class="custom-control-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio"   name="mayor" />
                                                                                                                <span class="custom-control-label"><?php echo $label ?></span>
                                                                                                            </label>
                                                                                                            <?php
                                                                                                            }
                                                                                                            }
                                                                                                            ?>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group ">
                                                                                                <div class="row">
                                                                                                    <div class="col-sm-4">
                                                                                                        <label class="control-label" for="minor">Minor </label>
                                                                                                    </div>
                                                                                                    <div class="col-sm-8">
                                                                                                        <div class="">
                                                                                                            <?php
                                                                                                            $minor_options = Menu :: $mayor;
                                                                                                            $field_value = $data['minor'];
                                                                                                            if(!empty($minor_options)){
                                                                                                            foreach($minor_options as $option){
                                                                                                            $value = $option['value'];
                                                                                                            $label = $option['label'];
                                                                                                            //check if value is among checked options
                                                                                                            $checked = $this->check_form_field_checked($field_value, $value);
                                                                                                            ?>
                                                                                                            <label class="custom-control custom-radio custom-control-inline">
                                                                                                                <input id="ctrl-minor" class="custom-control-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio"   name="minor" />
                                                                                                                    <span class="custom-control-label"><?php echo $label ?></span>
                                                                                                                </label>
                                                                                                                <?php
                                                                                                                }
                                                                                                                }
                                                                                                                ?>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group ">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-4">
                                                                                                            <label class="control-label" for="auto_control">Auto Control </label>
                                                                                                        </div>
                                                                                                        <div class="col-sm-8">
                                                                                                            <div class="">
                                                                                                                <?php
                                                                                                                $auto_control_options = Menu :: $mayor;
                                                                                                                $field_value = $data['auto_control'];
                                                                                                                if(!empty($auto_control_options)){
                                                                                                                foreach($auto_control_options as $option){
                                                                                                                $value = $option['value'];
                                                                                                                $label = $option['label'];
                                                                                                                //check if value is among checked options
                                                                                                                $checked = $this->check_form_field_checked($field_value, $value);
                                                                                                                ?>
                                                                                                                <label class="custom-control custom-radio custom-control-inline">
                                                                                                                    <input id="ctrl-auto_control" class="custom-control-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio"   name="auto_control" />
                                                                                                                        <span class="custom-control-label"><?php echo $label ?></span>
                                                                                                                    </label>
                                                                                                                    <?php
                                                                                                                    }
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group ">
                                                                                                        <div class="row">
                                                                                                            <div class="col-sm-4">
                                                                                                                <label class="control-label" for="kesimpulan">Kesimpulan </label>
                                                                                                            </div>
                                                                                                            <div class="col-sm-8">
                                                                                                                <div class="">
                                                                                                                    <?php
                                                                                                                    $kesimpulan_options = Menu :: $kesimpulan;
                                                                                                                    $field_value = $data['kesimpulan'];
                                                                                                                    if(!empty($kesimpulan_options)){
                                                                                                                    foreach($kesimpulan_options as $option){
                                                                                                                    $value = $option['value'];
                                                                                                                    $label = $option['label'];
                                                                                                                    //check if value is among checked options
                                                                                                                    $checked = $this->check_form_field_checked($field_value, $value);
                                                                                                                    ?>
                                                                                                                    <label class="custom-control custom-radio custom-control-inline">
                                                                                                                        <input id="ctrl-kesimpulan" class="custom-control-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio"   name="kesimpulan" />
                                                                                                                            <span class="custom-control-label"><?php echo $label ?></span>
                                                                                                                        </label>
                                                                                                                        <?php
                                                                                                                        }
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group ">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-4">
                                                                                                                    <label class="control-label" for="petugas_bdrs">Petugas Bdrs </label>
                                                                                                                </div>
                                                                                                                <div class="col-sm-8">
                                                                                                                    <div class="">
                                                                                                                        <input id="ctrl-petugas_bdrs"  value="<?php  echo $data['petugas_bdrs']; ?>" type="text" placeholder="Enter Petugas Bdrs"  name="petugas_bdrs"  class="form-control " />
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="form-group ">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-sm-4">
                                                                                                                        <label class="control-label" for="reaksi">Reaksi </label>
                                                                                                                    </div>
                                                                                                                    <div class="col-sm-8">
                                                                                                                        <div class="">
                                                                                                                            <?php
                                                                                                                            $reaksi_options = Menu :: $pengembalian;
                                                                                                                            $field_value = $data['reaksi'];
                                                                                                                            if(!empty($reaksi_options)){
                                                                                                                            foreach($reaksi_options as $option){
                                                                                                                            $value = $option['value'];
                                                                                                                            $label = $option['label'];
                                                                                                                            //check if value is among checked options
                                                                                                                            $checked = $this->check_form_field_checked($field_value, $value);
                                                                                                                            ?>
                                                                                                                            <label class="custom-control custom-radio custom-control-inline">
                                                                                                                                <input id="ctrl-reaksi" class="custom-control-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio"   name="reaksi" />
                                                                                                                                    <span class="custom-control-label"><?php echo $label ?></span>
                                                                                                                                </label>
                                                                                                                                <?php
                                                                                                                                }
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="form-group ">
                                                                                                                    <div class="row">
                                                                                                                        <div class="col-sm-4">
                                                                                                                            <label class="control-label" for="gejala">Gejala </label>
                                                                                                                        </div>
                                                                                                                        <div class="col-sm-8">
                                                                                                                            <div class="">
                                                                                                                                <input id="ctrl-gejala"  value="<?php  echo $data['gejala']; ?>" type="text" placeholder="Gejala"  name="gejala"  class="form-control " />
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="form-group ">
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <label class="control-label" for="tindak_lanjut">Tindak Lanjut </label>
                                                                                                                            </div>
                                                                                                                            <div class="col-sm-8">
                                                                                                                                <div class="">
                                                                                                                                    <textarea placeholder="Tindak Lanjut" id="ctrl-tindak_lanjut"  rows="5" name="tindak_lanjut" class=" form-control"><?php  echo $data['tindak_lanjut']; ?></textarea>
                                                                                                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="form-group ">
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <label class="control-label" for="pelapor">Pelapor </label>
                                                                                                                            </div>
                                                                                                                            <div class="col-sm-8">
                                                                                                                                <div class="">
                                                                                                                                    <input id="ctrl-pelapor"  value="<?php  echo $data['pelapor']; ?>" type="text" placeholder="Pelapor"  name="pelapor"  class="form-control " />
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group ">
                                                                                                                            <div class="row">
                                                                                                                                <div class="col-sm-4">
                                                                                                                                    <label class="control-label" for="jam_reaksi">Jam Reaksi </label>
                                                                                                                                </div>
                                                                                                                                <div class="col-sm-8">
                                                                                                                                    <div class="input-group">
                                                                                                                                        <input id="ctrl-jam_reaksi" class="form-control datepicker  datepicker" value="<?php  $v = $data['jam_reaksi']; echo (empty($v) || $v === '0000-00-00' || $v === '0000-00-00 00:00:00') ? '' : $v; ?>" type="datetime"  name="jam_reaksi" placeholder="Jam Reaksi" data-enable-time="true" data-min-date="" data-max-date="" data-date-format="Y-m-d H:i:S" data-alt-format="F j, Y - H:i" data-inline="false" data-no-calendar="false" data-mode="single" /> 
                                                                                                                                            <div class="input-group-append">
                                                                                                                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <div class="form-group ">
                                                                                                                                <div class="row">
                                                                                                                                    <div class="col-sm-4">
                                                                                                                                        <label class="control-label" for="jam_lapor">Jam Lapor </label>
                                                                                                                                    </div>
                                                                                                                                    <div class="col-sm-8">
                                                                                                                                        <div class="input-group">
                                                                                                                                            <input id="ctrl-jam_lapor" class="form-control datepicker  datepicker" value="<?php  $v = $data['jam_lapor']; echo (empty($v) || $v === '0000-00-00' || $v === '0000-00-00 00:00:00') ? '' : $v; ?>" type="datetime"  name="jam_lapor" placeholder="Jam Lapor" data-enable-time="true" data-min-date="" data-max-date="" data-date-format="Y-m-d H:i:S" data-alt-format="F j, Y - H:i" data-inline="false" data-no-calendar="false" data-mode="single" /> 
                                                                                                                                                <div class="input-group-append">
                                                                                                                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div class="form-group ">
                                                                                                                                    <div class="row">
                                                                                                                                        <div class="col-sm-4">
                                                                                                                                            <label class="control-label" for="hbawal">Hbawal </label>
                                                                                                                                        </div>
                                                                                                                                        <div class="col-sm-8">
                                                                                                                                            <div class="">
                                                                                                                                                <input id="ctrl-hbawal"  value="<?php  echo $data['hbawal']; ?>" type="text" placeholder="Enter Hbawal"  name="hbawal"  class="form-control " />
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                    <div class="form-group ">
                                                                                                                                        <div class="row">
                                                                                                                                            <div class="col-sm-4">
                                                                                                                                                <label class="control-label" for="jaminan">Jaminan </label>
                                                                                                                                            </div>
                                                                                                                                            <div class="col-sm-8">
                                                                                                                                                <div class="">
                                                                                                                                                    <select  id="ctrl-jaminan" name="jaminan"  placeholder="--Pilih Data--"    class="custom-select" >
                                                                                                                                                        <option value="">--Pilih Data--</option>
                                                                                                                                                        <?php
                                                                                                                                                        $jaminan_options = Menu :: $jaminan;
                                                                                                                                                        $field_value = $data['jaminan'];
                                                                                                                                                        if(!empty($jaminan_options)){
                                                                                                                                                        foreach($jaminan_options as $option){
                                                                                                                                                        $value = $option['value'];
                                                                                                                                                        $label = $option['label'];
                                                                                                                                                        $selected = ( $value == $field_value ? 'selected' : null );
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
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div class="form-ajax-status"></div>
                                                                                                                                <div class="form-group text-center">
                                                                                                                                    <button class="btn btn-primary" type="submit">
                                                                                                                                        Update
                                                                                                                                        <i class="fa fa-send"></i>
                                                                                                                                    </button>
                                                                                                                                </div>
                                                                                                                            </form>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </section>
