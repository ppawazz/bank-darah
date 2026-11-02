<?php 
$page_id = null;
$comp_model = new SharedController;
$current_page = $this->set_current_page_link();
?>
<div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <div class=""></div>
                </div>
            </div>
        </div>
    </div>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <h1 class="text-danger">DASHBOARD BANK DARAH RSU HERMINA SUKABUMI</h1>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                </div>
                <div class="col-md-3 comp-grid">
                    <?php $rec_count = $comp_model->getcount_prca();  ?>
                    <a class="animated zoomIn record-count alert alert-warning"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">PRC A+</div>
                                    <small class="">Stok PRC A+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_tca();  ?>
                    <a class="animated zoomIn record-count alert alert-warning"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">TC A+</div>
                                    <small class="">Stok TC A+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_ffpa();  ?>
                    <a class="animated zoomIn record-count alert alert-warning"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">FFP A+</div>
                                    <small class="">Stok FFP A+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_wba();  ?>
                    <a class="animated zoomIn record-count alert alert-warning"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">WB A+</div>
                                    <small class="">Stok WB A+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_lpa();  ?>
                    <a class="animated zoomIn record-count alert alert-warning"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">LP A+</div>
                                    <small class="">Stok LP A+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_prclda();  ?>
                    <a class="animated zoomIn record-count alert alert-warning"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">PRC LD A+</div>
                                    <small class="">Stok PRC LD A+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 comp-grid">
                    <?php $rec_count = $comp_model->getcount_prcab();  ?>
                    <a class="animated zoomIn record-count card bg-light text-dark"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">PRC AB+</div>
                                    <small class="">Stok PRC AB+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_tcab();  ?>
                    <a class="animated zoomIn record-count card bg-light text-dark"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">TC AB+</div>
                                    <small class="">Stok TC AB+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_ffpab();  ?>
                    <a class="animated zoomIn record-count card bg-light text-dark"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">FFP AB+</div>
                                    <small class="">Stok FFP AB+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_wbab();  ?>
                    <a class="animated zoomIn record-count card bg-light text-dark"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">WB AB+</div>
                                    <small class="">Stok WB AB+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_lpab();  ?>
                    <a class="animated zoomIn record-count card bg-light text-dark"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">LP AB+</div>
                                    <small class="">Stok LP AB+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_prcldab();  ?>
                    <a class="animated zoomIn record-count card bg-light text-dark"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">PRC LD AB+</div>
                                    <small class="">Stok PRC LD AB+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 comp-grid">
                    <?php $rec_count = $comp_model->getcount_prcb();  ?>
                    <a class="animated zoomIn record-count alert alert-danger"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">PRC B+</div>
                                    <small class="">Stok PRC B+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_tcb();  ?>
                    <a class="animated zoomIn record-count alert alert-danger"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">TC B+</div>
                                    <small class="">Stok TC B+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_ffpb();  ?>
                    <a class="animated zoomIn record-count alert alert-danger"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">FFP B+</div>
                                    <small class="">Stok FFP B+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_wbb();  ?>
                    <a class="animated zoomIn record-count alert alert-danger"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">WB B+</div>
                                    <small class="">Stok WB B+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_lpb();  ?>
                    <a class="animated zoomIn record-count alert alert-danger"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">LP B+</div>
                                    <small class="">Stok LP B+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_prcldb();  ?>
                    <a class="animated zoomIn record-count alert alert-danger"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">PRC LD B+</div>
                                    <small class="">Stok LD B+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 comp-grid">
                    <?php $rec_count = $comp_model->getcount_prco();  ?>
                    <a class="animated zoomIn record-count alert alert-info"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">PRC O+</div>
                                    <small class="">Stok PRC O+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_tco();  ?>
                    <a class="animated zoomIn record-count alert alert-info"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">TC O+</div>
                                    <small class="">Stok TC O+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_ffpo();  ?>
                    <a class="animated zoomIn record-count alert alert-info"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">FFP O+</div>
                                    <small class="">Stok FFP O+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_wbo();  ?>
                    <a class="animated zoomIn record-count alert alert-info"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">WB O+</div>
                                    <small class="">Stok WB O+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_lpo();  ?>
                    <a class="animated zoomIn record-count alert alert-info"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">LP O+</div>
                                    <small class="">Stok LP O+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_prcldo();  ?>
                    <a class="animated zoomIn record-count alert alert-info"  href="<?php print_link("/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-tint "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">PRC LD O+</div>
                                    <small class="">Stok PRC LD O+</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <h1 class="bg-primary text-white">HARGA  CROSMATCH 1 LABU Rp. 265.000</h1>
                </div>
            </div>
        </div>
    </div>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <h2 class="alert-success text-dark">Labu Darah Ready</h2>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <div class="card ">
                        <?php  
                        $this->render_page("transaksi/ready?limit_count=20"); 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <h2 class="card alert-danger text-dark">Labu Darah Belum Terpenuhi</h2>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <div class="card ">
                        <?php  
                        $this->render_page("transaksi/belum?limit_count=20"); 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <h2 class="card alert-warning text-dark">Pengembalian Darah</h2>
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
                        $this->render_page("transaksi/pengembalian_dash?limit_count=20"); 
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
                </div>
            </div>
        </div>
    </div>
</div>
