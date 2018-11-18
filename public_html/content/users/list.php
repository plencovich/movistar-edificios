<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/navbar'); ?>
        <div class="wrapper wrapper-content animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Listado de <?php echo ucfirst($user_type);?></h5>
                            <div class="ibox-tools">
                                <a href="<?php echo APP_FOLDER.uri_string();?>/add" class="btn btn-primary btn-xs"><i class="fa fa-plus fa-fw"></i> Agregar <?php echo ucfirst($user_type);?></a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="footable table table-striped table-hover" id="usersList#<?php echo $user_logged->user_id; ?>">
                                    <thead>
                                        <tr>
                                            <th data-sorted="true" data-direction="ASC">Nombre Completo</th>
                                            <th data-breakpoints="xs">Email</th>
                                            <th data-breakpoints="xs">Provincia</th>
                                            <th data-breakpoints="xs">Ciudad</th>
                                            <th data-breakpoints="xs" data-type="date">Último Ingreso</th>
                                            <th data-sortable="false" data-filterable="false">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($users as $user) { ?>
                                        <?php $user_id = $this->pcrypt->data('encode', $user->user_id); ?>
                                        <?php $last_login = ((bool) $user->last_login) ? date('d/m/y H:i', $user->last_login) : NULL ; ?>
                                        <?php $active_status = ((bool) $user->active) ? gcfg('enable_user', 'icons') : gcfg('disable_user', 'icons'); ?>

                                        <tr>
                                            <td><?php echo $user->first_name.' '.$user->last_name;?></td>
                                            <td><?php echo $user->email;?></td>
                                            <td><?php echo ucwords(strtolower($user->state_name));?></td>
                                            <td><?php echo ucwords(strtolower($user->city_name));?></td>
                                            <td><?php echo $last_login;?></td>
                                            <td class="center btn-group" data-item-id="<?php echo $user_id;?>">
                                                <a data-tagtype="moderate" data-status="<?php echo $user->active;?>" class="btn btn-default moderate" role="button" data-toggle="tooltip" title="Acceso"><i class="<?php echo $active_status;?>"></i></a>
                                                <a href="<?php echo APP_FOLDER.uri_string().'/edit/'.$user_id;?>" class="btn btn-info" role="button" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger delete" role="button" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                                <span id="infoActions" data-action-delete="<?php echo APP_FOLDER.uri_string().'/delete';?>" data-action-moderate="<?php echo APP_FOLDER.uri_string().'/moderate';?>"></span>
                                <span id="formDelete" data-title-delete="<?php echo lang('title_delete');?>" data-label-delete="<?php echo lang('label_delete');?>" data-yes="<?php echo lang('btn_del_yes');?>" data-no="<?php echo lang('btn_del_no');?>"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php $this->load->view('template/footer'); ?>
