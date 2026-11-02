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
                    <h4 class="record-title">View  Kultur</h4>
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
                                    <tr  class="td-tgl_sampling">
                                        <th class="title"> Tgl Sampling: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['tgl_sampling']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("kultur/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="tgl_sampling" 
                                                data-title="Enter Tgl Sampling" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['tgl_sampling']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-mrn">
                                        <th class="title"> Mrn: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['mrn']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("kultur/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="mrn" 
                                                data-title="Enter Mrn" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['mrn']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-nama">
                                        <th class="title"> Nama: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['nama']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("kultur/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="nama" 
                                                data-title="Enter Nama" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['nama']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-jenis_pemeriksaan">
                                        <th class="title"> Jenis Pemeriksaan: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['jenis_pemeriksaan']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("kultur/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="jenis_pemeriksaan" 
                                                data-title="Enter Jenis Pemeriksaan" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['jenis_pemeriksaan']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-jaminan">
                                        <th class="title"> Jaminan: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['jaminan']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("kultur/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="jaminan" 
                                                data-title="Enter Jaminan" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['jaminan']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-hasil">
                                        <th class="title"> Hasil: </th>
                                        <td class="value">
                                            <span  data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("kultur/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="hasil" 
                                                data-title="Enter Hasil" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="textarea" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['hasil']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-diagnosa">
                                        <th class="title"> Diagnosa: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['diagnosa']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("kultur/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="diagnosa" 
                                                data-title="Enter Diagnosa" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['diagnosa']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-tampil">
                                        <th class="title"> Tampil: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['tampil']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("kultur/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="tampil" 
                                                data-title="Enter Tampil" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['tampil']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-tgl_kirim">
                                        <th class="title"> Tgl Kirim: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['tgl_kirim']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("kultur/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="tgl_kirim" 
                                                data-title="Enter Tgl Kirim" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['tgl_kirim']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-tgl_terima">
                                        <th class="title"> Tgl Terima: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['tgl_terima']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("kultur/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="tgl_terima" 
                                                data-title="Enter Tgl Terima" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['tgl_terima']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-status">
                                        <th class="title"> Status: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['status']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("kultur/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="status" 
                                                data-title="Enter Status" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['status']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-ruangan">
                                        <th class="title"> Ruangan: </th>
                                        <td class="value">
                                            <span  data-source='<?php print_link('api/json/kultur_ruangan_option_list'); ?>' 
                                                data-value="<?php echo $data['ruangan']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("kultur/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="ruangan" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['ruangan']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-hasil_bdrs">
                                        <th class="title"> Hasil Bdrs: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['hasil_bdrs']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("kultur/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="hasil_bdrs" 
                                                data-title="Enter Hasil Bdrs" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['hasil_bdrs']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-penerima_id">
                                        <th class="title"> Penerima Id: </th>
                                        <td class="value"> <?php echo $data['penerima_id']; ?></td>
                                    </tr>
                                    <tr  class="td-penerima_penerima">
                                        <th class="title"> Penerima Penerima: </th>
                                        <td class="value"> <?php echo $data['penerima_penerima']; ?></td>
                                    </tr>
                                    <tr  class="td-petugas">
                                        <th class="title"> Petugas: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['petugas']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("kultur/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="petugas" 
                                                data-title="Enter Petugas" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['petugas']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-file">
                                        <th class="title"> File: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['file']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("kultur/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="file" 
                                                data-title="Browse..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['file']; ?> 
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("kultur/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("kultur/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Apakah anda yakin akan menghapus data ini?" data-display-style="modal">
                                                    <i class="fa fa-times"></i> Delete
                                                </a>
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
