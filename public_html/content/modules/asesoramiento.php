            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                        <?php if (isset($alone)) { ?>
                            <h5>Edificio Asesoramiento ( <small class="text-uppercase"><?php echo $full_address; ?></small> )</h5>
                        <?php } else { ?>
                            <h5>1.- Detalle de la Etapa de Asesoramiento</h5>
                        <?php } ?>
                        </div>
                        <div class="ibox-content">
                            <?php if (!isset($readonly)) { ?>
                            <form role="form" id="addModules" name="addModules" action="<?php echo APP_FOLDER;?>asesoramiento" method="POST" enctype="multipart/form-data">
                            <?php } ?>
                            <div class="row">
                                <div class="col-lg-6 form-horizontal">
                                    <?php if ((bool)$info->usuario_codi_asesor) { ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Ipid Parcela</label>
                                        <div class="col-sm-8">
                                        <?php if (isset($readonly)) { ?>
                                            <p class="form-control-static"><?php echo $info->ipid_parcela; ?></p>
                                        <?php } else { ?>
                                            <input type="text" class="form-control" name="ipid_parcela" value="<?php echo $ipid_parcela = ((bool)$info) ? $info->ipid_parcela : NULL ;?>">
                                        <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Manzana</label>
                                        <div class="col-sm-8">
                                        <?php if (isset($readonly)) { ?>
                                            <p class="form-control-static"><?php echo $info->cod_manzana; ?></p>
                                        <?php } else { ?>
                                            <input type="text" class="form-control" name="cod_manzana" value="<?php echo $cod_manzana = ((bool)$info) ? $info->cod_manzana : NULL ;?>">
                                        <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Central</label>
                                        <div class="col-sm-8">
                                        <?php if (isset($readonly)) { ?>
                                            <p class="form-control-static"><?php echo $info->id_central; ?></p>
                                        <?php } else { ?>
                                            <input type="text" class="form-control" name="id_central" value="<?php echo $id_central = ((bool)$info) ? $info->id_central : NULL ;?>">
                                        <?php } ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Plano Arquitectura</label>
                                        <div class="col-sm-8">
                                            <?php if ((bool)$info->plano_arquitectura) { ?>
                                                <a data-photo-id="<?php echo PATH_PUBLIC_PLANOS.$info->plano_arquitectura;?>" class="btn btn-default viewPicture" role="button"><i class="fa fa-picture-o fa-fw" data-toggle="tooltip" title="Ver Plano"></i> Ver Plano</a>
                                            <?php } else { ?>
                                                <div class="form-group" id="plano_attach">
                                                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                            <div class="form-control" data-trigger="fileinput">
                                                                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                                <span class="fileinput-filename"></span>
                                                            </div>
                                                            <span class="input-group-addon btn btn-info-alt btn-file">
                                                                <span class="fileinput-new">Seleccionar</span>
                                                                <span class="fileinput-exists">Cambiar</span>
                                                                <input type="file" accept="<?php echo gcfg('for_attached','mime_type') ?>" name="userfile_attach">
                                                            </span>
                                                            <a href="#" class="input-group-addon btn btn-danger fileinput-exists" data-dismiss="fileinput">Quitar</a>
                                                        </div>
                                                    </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Código de Asesoramiento</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo $cod_asesoramiento = ((bool)$info->cod_asesoramiento) ? $info->cod_asesoramiento : 'N/A' ; ?></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Observaciones de Asesoramiento</label>
                                        <div class="col-sm-8">
                                        <?php if (isset($readonly)) { ?>
                                            <p class="form-control-static"><?php echo $info->observaciones_asesoramiento; ?></p>
                                        <?php } else { ?>
                                            <textarea class="form-control" name="add_observaciones" rows="4"><?php echo $info->observaciones_asesoramiento;?></textarea>
                                        <?php } ?>
                                        </div>
                                    </div>
                                    <?php if ((bool)$info->ase_cumplido) { ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Asesorado</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo date("d-m-Y",strtotime($info->ase_cumplido)); ?> - <?php echo $asesor; ?></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Observaciones del Asesor</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo $info->asesor_observaciones; ?></p>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <a role="button" href="<?php echo APP_FOLDER;?>listado" class="btn btn-default pull-left"><i class="fa fa-arrow-left"></i> Volver</a>
                                </div>
                                <?php if (!isset($readonly)) { ?>
                                <div class="col-lg-6">
                                    <input type="hidden" name="building_id" value="<?php echo $building_id;?>">
                                    <input type="hidden" name="attach_file" id="attach_file" value="0">
                                    <button type="submit" class="ladda-button btn btn-primary pull-right btnSubmit" id="btnSubmit" data-type-btn="onlySave" data-style="slide-right"><i class="fa fa-floppy-o fa-fw"></i> Guardar</button>
                                </div>
                                </form>
                                <?php } ?>
                            </div>
                            <div class="hr-line-dashed"></div>
                        </div>
                    </div>
                </div>
            </div>
