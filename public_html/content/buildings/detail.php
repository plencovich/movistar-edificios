<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
        <div class="wrapper wrapper-content animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><?php echo $title; ?></h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label class="control-label">Registro</label>
                                        <p class="form-control-static"><?php echo $info->id_solicitud; ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">Denominación</label>
                                        <p class="form-control-static"><?php echo $info->denominacion; ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label">Ingresado</label>
                                        <p class="form-control-static"><i class="fa fa-user fa-fw" aria-hidden="true"></i> <?php echo $info->full_name; ?> <i class="fa fa-clock-o fa-fw" aria-hidden="true"></i> <?php echo date_to('humanWithTime',$info->fecha_alta); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">Dirección Principal</label>
                                        <p class="form-control-static"><?php echo $info->calle_name; ?> <?php echo $altura = ($info->numero_desde == $info->numero_hasta) ? $info->numero_desde : $info->numero_desde.'/'.$info->numero_hasta; ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label class="control-label">Doble Frente</label>
                                        <p class="form-control-static"><?php echo $df = ((bool)$info->doble_frente) ? 'SI' : 'NO' ; ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">Entre Calles</label>
                                        <p class="form-control-static"><?php echo $calle1_name.' | '.$calle2_name.' | '.$calle3_name; ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label class="control-label">Pisos</label>
                                        <p class="form-control-static"><?php echo $info->cantidad_pisos; ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label class="control-label">Viviendas</label>
                                        <p class="form-control-static"><?php echo $info->cantidad_viviendas; ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label class="control-label">Locales</label>
                                        <p class="form-control-static"><?php echo $info->cantidad_locales; ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label class="control-label">Oficinas</label>
                                        <p class="form-control-static"><?php echo $info->cantidad_oficinas; ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label class="control-label">Profesional</label>
                                        <p class="form-control-static"><?php echo $df = ((bool)$info->apto_profesional) ? 'SI' : 'NO' ; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="control-label">Provincia</label>
                                        <p class="form-control-static"><?php echo $info->provincia_name; ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">Ciudad / Partido</label>
                                        <p class="form-control-static"><?php echo $info->ciudad_name.''.$info->partido_name; ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label class="control-label">Barrio</label>
                                        <p class="form-control-static"><?php echo $info->barrio; ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label class="control-label">Categoría</label>
                                        <p class="form-control-static"><?php echo $categoria_name; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="control-label">Fecha de Habilitación</label>
                                        <p class="form-control-static"><i class="fa fa-calendar-o fa-fw" aria-hidden="true"></i> <?php echo date_to('human', $info->fec_habilitacion); ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">Constructora / Inmobiliaria</label>
                                        <p class="form-control-static"><?php echo $info->const_inmob; ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">Contacto / Teléfono</label>
                                        <p class="form-control-static"><?php echo $info->contacto.' / '.$info->telefonos; ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <p class="form-control-static"><?php echo $info->email; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group" id="add_observaciones">
                                        <label class="control-label">Observaciones</label>
                                        <p class="form-control-static"><?php echo $info->observaciones; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <a role="button" href="<?php echo APP_FOLDER;?>listado" class="btn btn-default pull-left"><i class="fa fa-arrow-left"></i> Volver</a>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                        </div>
                    </div>
                </div>
            </div>
<?php if ((bool)$info->ase_presentacion) { ?>
<?php $this->load->view('modules/asesoramiento'); ?>
<?php } ?>
<?php if ((bool)$info->pla_presentacion) { ?>
<?php $this->load->view('modules/planos'); ?>
<?php } ?>
<?php if ((bool)$info->pru_solicitud) { ?>
<?php $this->load->view('modules/pruebas'); ?>
<?php } ?>
        </div>
<?php $this->load->view('template/footer'); ?>
