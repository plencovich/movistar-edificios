<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
            <div class="wrapper wrapper-content animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Alta de Usuarios <?php echo ucfirst($user_type);?> <small>Ingrese la información del nuevo usuario.</small></h5>
                            </div>
                            <div class="ibox-content">
                                <form role="form" id="user_sheet" name="user_sheet" action="<?php echo APP_FOLDER.'usuarios/'.$this->uri->segment(2).'/save';?>" method="POST">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group" id="first_name">
                                                <label class="control-label">Nombre:</label>
                                                <input type="text" class="form-control" name="first_name" value="<?php echo $first_name = ((bool)$user) ? $user->first_name : NULL ;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group" id="last_name">
                                                <label class="control-label">Apellido:</label>
                                                <input type="text" class="form-control" name="last_name" value="<?php echo $last_name = ((bool)$user) ? $user->last_name : NULL ;?>">
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
                                        <div class="col-lg-4">
                                            <div class="form-group" id="card_id">
                                                <label class="control-label">DNI</label>
                                                <input type="text" class="form-control" name="card_id" value="<?php echo $dni = ((bool)$user) ? $user->dni : NULL ;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group" id="license">
                                                <label class="control-label">Nro. de Matricula COPITEC</label>
                                                <input type="text" class="form-control" name="license" value="<?php echo $matricula = ((bool)$user) ? $user->matricula : NULL ;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group" id="phone">
                                                <label class="control-label">Teléfono</label>
                                                <input type="text" class="form-control" name="phone" value="<?php echo $phone = ((bool)$user) ? $user->phone : NULL ;?>">
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
                                                <input type="hidden" class="form-control" id="stateSelected" value="<?php echo $state = ((bool)$user) ? $user->state : '0' ;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group" id="city_id">
                                                <label class="control-label">Ciudad</label>
                                                <select name="city_id" class="form-control">
                                                <option value="0">-- Primero Seleccione una Provincia --</option>
                                                </select>
                                                <input type="hidden" class="form-control" id="citySelected" value="<?php echo $city = ((bool)$user) ? $user->city : '0' ;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ((bool)$user) { ?>
                                    <div class="hr-line-dashed"></div>
                                    <div class="row">
                                        <div class="col-lg-12 m-b-xs">
                                            <label class="control-label">Miembro de Grupo</label>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                            <?php   foreach ($users_group as $group) { ?>
                                                <label class="control-label checkbox-inline icheck chat">
                                                <?php $group_id=$group['id']; ?>
                                                <?php $checked = NULL; ?>
                                                <?php $item = NULL; ?>
                                                <?php foreach($current_user_group as $grp) { ?>
                                                    <?php if ($group_id == $grp->id) { $checked= 'checked="checked"'; break; } ?>
                                                <?php } ?>
                                                <input class="form-control" type="radio" value="<?php echo $group['id'];?>" name="user_group" <?php echo $checked;?>> <?php echo ucfirst(gcfg($group['name'], 'user_group_translate'));?> </label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                    <input type="hidden" name="user_group" value="<?php echo $user_group;?>">
                                    <?php } ?>
                                    <div class="hr-line-dashed"></div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
                                            <input type="hidden" name="check_m" value="<?php echo $check_m;?>">
                                            <a role="button" href="<?php echo APP_FOLDER.'usuarios/'.$this->uri->segment(2);?>" class="btn btn-default pull-left"><i class="fa fa-arrow-left"></i> Volver</a>
                                            <button type="submit" class="ladda-button btn btn-primary pull-right btnSubmit" id="btnSubmit" data-style="slide-right"><i class="fa fa-floppy-o fa-fw"></i> <?php echo $btn_submit_label;?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php $this->load->view('template/footer'); ?>
