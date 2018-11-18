<?php $this->load->view('template/header'); ?>
<div class="passwordBox animated fadeInDown">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox-content text-center">
                <img class="img-responsive center-block" src="<?php echo wmscp('project_logo_backend'); ?>" alt="<?php echo wmscp('project_logo_name'); ?>">
                <h2 class="text-navy"><?php echo wmscp('project_name'); ?></h2>
                <h3 class="text-dark-gray">Cambiar contraseña</h3>
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" class="m-t" id="newpasswordForm" name="newpasswordForm" action="<?php echo APP_FOLDER.'check/reset_password/'.$code;?>" method="POST" novalidate>
                            <div id="alertNotification" class="animated fadeIn hidden"></div>
                            <div class="form-group" id="new">
                                <label class="control-label">Nueva Contraseña <i class="text-warning fa fa-question-circle" data-toggle="tooltip" title="<?php echo sprintf(lang('reset_password_new_password_label'), gcfg('min_password_length', 'ion_auth'));?>"></i></label>
                                <input type="password" class="form-control" name="new" autofocus>
                            </div>
                            <div class="form-group" id="new_confirm">
                                <label class="control-label">Confirmar Nueva Contraseña <i class="text-warning fa fa-question-circle" data-toggle="tooltip" title="<?php echo lang('change_password_validation_new_password_confirm_label');?>"></i></label>
                                <input type="password" class="form-control" name="new_confirm">
                            </div>
                            <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
                            <button type="submit" class="ladda-button btn btn-primary full-width m-b btnSubmit" id="btnSubmit" data-style="slide-right"><i class="fa fa-save fa-fw"></i> Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('template/footer'); ?>
