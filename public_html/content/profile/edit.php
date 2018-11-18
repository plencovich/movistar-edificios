<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
            <div class="wrapper wrapper-content animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Edición de Perfíl<small> Ingrese la nueva información de su cuenta</small></h5>
                            </div>
                            <div class="ibox-content">
                                <form role="form" id="user_sheet" name="user_sheet" action="<?php echo APP_FOLDER.uri_string();?>" method="POST">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group" id="first_name">
                                                <label class="control-label">Nombre:</label>
                                                <input type="text" class="form-control" name="first_name" value="<?php echo $first_name = ((bool)$user) ? $user->first_name : NULL ;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group" id="last_name">
                                                <label class="control-label">Apellido:</label>
                                                <input type="text" class="form-control" name="last_name" value="<?php echo $last_name = ((bool)$user) ? $user->last_name : NULL ;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group" id="card_id">
                                                <label class="control-label">DNI:</label>
                                                <input type="text" class="form-control" name="card_id" value="<?php echo $dni = ((bool)$user) ? $user->dni : NULL ;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group" id="license">
                                                <label class="control-label">Matricula COPITEC:</label>
                                                <input type="text" class="form-control" name="license" value="<?php echo $matricula = ((bool)$user) ? $user->matricula : NULL ;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group" id="phone">
                                                <label class="control-label">Teléfono:</label>
                                                <input type="text" class="form-control" name="phone" value="<?php echo $phone = ((bool)$user) ? $user->phone : NULL ;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group" id="email">
                                                <label class="control-label">Email:</label>
                                                <input type="text" class="form-control" name="email" value="<?php echo $email = ((bool)$user) ? $user->email : NULL ;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="form-group" id="state_id" data-action-city="<?php echo APP_FOLDER;?>ajax/city/list/">
                                                <label class="control-label">Provincia</label>
                                                <select name="state_id" class="form-control">
                                                    <option value="0">-- Seleccione una Provincia --</option>
                                                    <?php foreach ($state_list as $state) { ?>
                                                    <option value="<?php echo $state->id_provincia;?>"><?php echo $state->descrip;?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php if ((bool)$user) { ?>
                                                <input type="hidden" name="state_id_selected" value="<?php echo $user->state;?>">
                                                <?php }?>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group" id="city_id" data-action-street="<?php echo APP_FOLDER;?>ajax/street/list/">
                                                <label class="control-label">Ciudad</label>
                                                <select name="city_id" class="form-control">
                                                <option value="0">-- Primero Seleccione una Provincia --</option>
                                                </select>
                                                <?php if ((bool)$user) { ?>
                                                <input type="hidden" name="city_id_selected" value="<?php echo $user->city;?>">
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group" id="password">
                                                <label class="control-label"><?php echo lang('change_password_validation_new_password_label');?>  <i class="text-warning fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="<?php echo sprintf(lang('reset_password_new_password_label'), gcfg('min_password_length', 'ion_auth'));?>"></i></label>
                                                <input type="password" class="form-control" name="password">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group" id="confirm_password">
                                                <label class="control-label"><?php echo lang('reset_password_new_password_confirm_label');?>  <i class="text-warning fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="<?php echo lang('change_password_validation_new_password_confirm_label');?>"></i></label>
                                                <input type="password" class="form-control" name="confirm_password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
                                            <a role="button" href="/" class="btn btn-default pull-left"><i class="fa fa-arrow-left"></i> Volver</a>
                                            <button type="submit" class="ladda-button btn btn-primary pull-right btnSubmit" id="btnSubmit" data-style="slide-right"><i class="fa fa-floppy-o fa-fw"></i> Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php $this->load->view('template/footer'); ?>
