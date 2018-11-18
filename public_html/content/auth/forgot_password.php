<?php $this->load->view('template/header'); ?>
<div class="passwordBox animated fadeInDown">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox-content text-center">
                <img class="img-responsive center-block" src="<?php echo wmscp('project_logo_backend'); ?>" alt="<?php echo wmscp('project_name'); ?>">
                <h2 class="text-navy"><?php echo wmscp('project_name'); ?></h2>
                <h3 class="text-dark-gray">Recuperar contraseña</h3>
                <p>Por favor, introduce tu dirección de email para que podamos enviarte las instrucciones para restablecer el acceso.</p>
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" action="<?php echo APP_FOLDER;?>check/recovery" class="m-t" id="forgotForm" name="forgotForm" method="POST" novalidate>
                            <div id="alertNotification" class="animated fadeIn hidden"></div>
                            <div class="form-group" id="email">
                                <input type="email" class="form-control" name="email" placeholder="Dirección de Email">
                            </div>
                            <button type="submit" class="ladda-button btn btn-primary full-width m-b btnSubmit" id="btnSubmit" data-style="slide-right">Restablecer contraseña</button>
                            <p>Ya tiene usuario y contraseña?</p>
                            <a role="button" class="btn btn-info-alt btn-xs full-width" href="<?php echo APP_FOLDER;?>"><i class="fa fa-sign-in fa-fw" aria-hidden="true"></i> Acceda al Sistema</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('template/footer'); ?>
