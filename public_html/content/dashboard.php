<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
        <div class="wrapper wrapper-content animated fadeIn">
            <?php if (gnou() == 'managers') { ?>
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Pedir Asesoramiento</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="no-margins"><?php echo $ask_for_advice; ?> <span class="text-dark-gray"><i class="fa fa-list fa-fw"></i></span></h1>
                                    <div class="font-bold text-dark-gray">Pendientes</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Presentar Planes</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="no-margins"><?php echo $submit_plans;?> <span class="text-dark-gray"><i class="fa fa-list fa-fw"></i></span></h1>
                                    <div class="font-bold text-dark-gray">Pendientes</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Solicitar Pruebas</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="no-margins"><?php echo $request_test; ?> <span class="text-dark-gray"><i class="fa fa-list fa-fw"></i></span></h1>
                                    <div class="font-bold text-dark-gray">Pendientes</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
<?php $this->load->view('template/footer'); ?>
