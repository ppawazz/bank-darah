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
                    <h3 class="record-title text-primary">Kartu Stock</h3>
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
                        $rec_id = (!empty($data['jenis']) ? urlencode($data['jenis']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover  table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-jenis">
                                        <th class="title"> Jenis: </th>
                                        <td class="value"> <?php echo $data['jenis']; ?></td>
                                    </tr>
                                    <tr  class="td-dropping">
                                        <th class="title"> Dropping: </th>
                                        <td class="value"> <?php echo $data['dropping']; ?></td>
                                    </tr>
                                    <tr  class="td-sa">
                                        <th class="title"> Stock Awal: </th>
                                        <td class="value"> <?php echo $data['sa']; ?></td>
                                    </tr>
                                    <tr  class="td-pengembalian">
                                        <th class="title"> Pengembalian: </th>
                                        <td class="value"> <?php echo $data['pengembalian']; ?></td>
                                    </tr>
                                    <tr  class="td-ready">
                                        <th class="title"> Ready: </th>
                                        <td class="value"> <?php echo $data['ready']; ?></td>
                                    </tr>
                                    <tr  class="td-selesai">
                                        <th class="title"> Selesai: </th>
                                        <td class="value"> <?php echo $data['selesai']; ?></td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
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
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <div class=" ">
                        <?php  
                        $this->render_page("kartu_stock/list/kartu_stock.jenis/$data[jenis]?orderby=kartu_stock.tanggal&ordertype=DESC&limit_count=100"); 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
