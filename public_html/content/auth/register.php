<?php $this->load->view('template/header'); ?>
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-lg-6">
                        <img class="img-responsive" src="<?php echo wmscp('project_logo_backend'); ?>" alt="<?php echo wmscp('project_name'); ?>">
                    </div>
                    <div class="col-lg-6 text-right">
                        <h2 class="text-navy"><?php echo wmscp('project_name'); ?></h2>
                        <h3 class="text-dark-gray">Registro</h3>
                    </div>
                </div>
            </div>
            <div class="ibox-content">
                <form role="form" action="<?php echo APP_FOLDER;?>check/register" id="registerUser" name="registerUser" method="POST" novalidate>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="alertNotification" class="animated fadeIn hidden"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group" id="first_name">
                            <label class="control-label">Nombre</label>
                            <input type="text" class="form-control" name="first_name" placeholder="Nombre">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group" id="last_name">
                            <label class="control-label">Apellido</label>
                            <input type="text" class="form-control" name="last_name" placeholder="Apellido">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group" id="identity">
                            <label class="control-label">Correo Electrónico</label>
                            <input type="text" class="form-control" name="identity" placeholder="Correo Electrónico">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group" id="card_id">
                            <label class="control-label">DNI</label>
                            <input type="text" class="form-control" name="card_id" placeholder="DNI">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group" id="license">
                            <label class="control-label">Nro. de Matricula COPITEC</label>
                            <input type="text" class="form-control" name="license" placeholder="Nro. de Matricula COPITEC">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group" id="phone">
                            <label class="control-label">Teléfono</label>
                            <input type="text" class="form-control" name="phone" placeholder="Teléfono">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group" id="state_id" data-action-city="<?php echo APP_FOLDER;?>ajax/city/list/">
                            <label class="control-label">Provincia</label>
                            <select name="state_id" class="form-control">
                                <option value="0">-- Seleccione una Provincia --</option>
                                <?php foreach ($state_list as $state) { ?>
                                <option value="<?php echo $state->id_provincia;?>"><?php echo $state->descrip;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="city_id">
                            <label class="control-label">Ciudad</label>
                            <select name="city_id" class="form-control">
                            <option value="0">-- Primero Seleccione una Provincia --</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="ladda-button btn btn-primary btnSubmit pull-right" id="btnSubmit" data-style="slide-right"><i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i> Aceptar</button>
                    </div>
                </div>
                </form>
            </div>
            <div class="ibox-footer">
                <p>Ya tiene usuario y contraseña? <a role="button" class="btn btn-info-alt btn-xs" href="<?php echo APP_FOLDER;?>"><i class="fa fa-sign-in fa-fw" aria-hidden="true"></i> Acceda al Sistema</a></p>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('template/footer'); ?>
