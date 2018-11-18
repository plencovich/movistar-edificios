<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
        <div class="wrapper wrapper-content animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Listado de Edificios</h5>
                            <div class="ibox-tools">
                                <a href="<?php echo APP_FOLDER;?>add" class="btn btn-primary btn-xs"><i class="fa fa-plus fa-fw"></i> Agregar Edificio</a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12 text-right visible-lg m-b-lg">
                                    <a role="button" class="btn btn-info-alt btn-xs toggle-vis" data-column="0" data-toggle="button" aria-pressed="false" autocomplete="off">Registro</a>
                                    <a role="button" class="btn btn-info-alt btn-xs toggle-vis" data-column="1" data-toggle="button" aria-pressed="false" autocomplete="off">Dirección</a>
                                    <a role="button" class="btn btn-info-alt btn-xs toggle-vis" data-column="2" data-toggle="button" aria-pressed="false" autocomplete="off">Provincia</a>
                                    <a role="button" class="btn btn-info-alt btn-xs toggle-vis" data-column="3" data-toggle="button" aria-pressed="false" autocomplete="off">Ciudad</a>
                                    <a role="button" class="btn btn-info-alt btn-xs toggle-vis active" data-column="4" data-toggle="button" aria-pressed="true" autocomplete="off">Pisos</a>
                                    <a role="button" class="btn btn-info-alt btn-xs toggle-vis active" data-column="5" data-toggle="button" aria-pressed="true" autocomplete="off">Viviendas</a>
                                    <a role="button" class="btn btn-info-alt btn-xs toggle-vis active" data-column="6" data-toggle="button" aria-pressed="true" autocomplete="off">Oficinas</a>
                                    <a role="button" class="btn btn-info-alt btn-xs toggle-vis active" data-column="7" data-toggle="button" aria-pressed="true" autocomplete="off">Locales</a>
                                    <a role="button" class="btn btn-info-alt btn-xs toggle-vis" data-column="8" data-toggle="button" aria-pressed="false" autocomplete="off">Ingreso</a>
                                    <a role="button" class="btn btn-info-alt btn-xs toggle-vis" data-column="9" data-toggle="button" aria-pressed="false" autocomplete="off">Asesoramiento</a>
                                    <a role="button" class="btn btn-info-alt btn-xs toggle-vis" data-column="10" data-toggle="button" aria-pressed="false" autocomplete="off">Plano</a>
                                    <a role="button" class="btn btn-info-alt btn-xs toggle-vis" data-column="11" data-toggle="button" aria-pressed="false" autocomplete="off">Pruebas</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="buildingsTable" class="table table-striped table-bordered table-hover" data-action="<?php echo APP_FOLDER.uri_string();?>">
                                    <thead>
                                        <tr>
                                            <th>Registro</th>
                                            <th>Dirección</th>
                                            <th>Provincia</th>
                                            <th>Ciudad</th>
                                            <th>Pisos</th>
                                            <th>Viviendas</th>
                                            <th>Oficinas</th>
                                            <th>Locales</th>
                                            <th>Ingreso</th>
                                            <th>Asesoramiento</th>
                                            <th>Plano</th>
                                            <th>Pruebas</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php $this->load->view('template/footer'); ?>
