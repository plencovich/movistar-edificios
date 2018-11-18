<?php $this->load->view('template/header'); ?>
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">
                <img class="img-responsive center-block" src="<?php echo wmscp('project_logo_backend'); ?>" alt="<?php echo wmscp('project_name'); ?>">
                <h2 class="text-navy"><?php echo wmscp('project_name'); ?></h2>
                <h3 class="text-dark-gray">Acceso</h3>
                <form role="form" action="<?php echo APP_FOLDER;?>check/login" class="m-t" id="loginForm" name="loginForm" method="POST" novalidate>
                    <div id="alertNotification" class="animated fadeIn hidden"></div>
                    <div class="form-group" id="identity">
                        <input type="email" class="form-control" name="identity" placeholder="Usuario" autofocus>
                    </div>
                    <div class="form-group" id="password">
                        <input type="password" class="form-control" name="password" placeholder="Contraseña">
                    </div>
                    <div class="form-group">
                        <label> <input type="checkbox" name="remember"> Recordarme</label>
                    </div>
                        <button type="submit" class="ladda-button btn btn-primary full-width m-b btnSubmit" id="btnSubmit" data-style="slide-right"><i class="fa fa-sign-in fa-fw"></i> <?php echo lang('login_heading');?></button>
                        <p>¿Has olvidado tu contraseña?<br><a href="<?php echo APP_FOLDER;?>recuperar">Recuperar Contraseña</a></p>
                </form>
            </div>
            <div class="ibox-footer">
                <a href="<?php echo APP_FOLDER;?>registro" role="button" class="btn btn-info-alt full-width m-t-sm m-b-sm"><i class="fa fa-pencil-square-o fa-fw"></i> Registrarse</a>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('template/footer'); ?>
