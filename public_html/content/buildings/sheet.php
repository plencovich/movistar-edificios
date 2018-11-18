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
                            <form role="form" id="addBuilding" name="addBuilding" action="<?php echo APP_FOLDER;?>add" method="POST">
                                <div class="row">
                                    <?php if ((bool)$info) { ?>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Edificio Número</label>
                                            <p class="form-control-static"><?php echo $info->id_solicitud; ?></p>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="col-lg-8">
                                        <div class="form-group" id="add_denominacion">
                                            <label class="control-label">Denominación</label>
                                            <input type="text" class="form-control" name="add_denominacion" value="<?php echo $add_denominacion = ((bool)$info) ? $info->denominacion : NULL ;?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group" id="state_id" data-action-city-region="<?php echo APP_FOLDER;?>ajax/city-region/list/">
                                            <label class="control-label">Provincia</label>
                                            <select name="state_id" class="form-control">
                                                <option value="0">-- Seleccione una Provincia --</option>
                                                <?php foreach ($state_list as $state) { ?>
                                                <option value="<?php echo $state->id_provincia;?>"><?php echo $state->descrip;?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if ((bool)$info) { ?>
                                            <input type="hidden" name="state_id_selected" value="<?php echo $info->id_provincia;?>">
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group" id="city_id" data-action-street="<?php echo APP_FOLDER;?>ajax/street/list/">
                                            <label class="control-label">Ciudad</label>
                                            <select name="city_id" class="form-control">
                                            <option value="0">-- Primero Seleccione una Provincia --</option>
                                            </select>
                                            <?php if ((bool)$info) { ?>
                                            <input type="hidden" name="city_id_selected" value="<?php echo $info->id_ciudad;?>">
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group" id="region_id">
                                            <label class="control-label">Partido</label>
                                            <select name="region_id" class="form-control">
                                            <option value="0">-- Primero Seleccione una Provincia --</option>
                                            </select>
                                            <?php if ((bool)$info) { ?>
                                            <input type="hidden" name="region_id_selected" value="<?php echo $info->id_partido;?>">
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group" id="add_barrio">
                                            <label class="control-label">Barrio</label>
                                            <input type="text" class="form-control" name="add_barrio" value="<?php echo $add_barrio = ((bool)$info) ? $info->barrio : NULL ;?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group" id="street_id">
                                            <label class="control-label">Calle</label>
                                            <select name="street_id" class="form-control">
                                            <option value="0">-- Primero Seleccione una Ciudad --</option>
                                            </select>
                                            <?php if ((bool)$info) { ?>
                                            <input type="hidden" name="street_id_selected" value="<?php echo $info->cd_calle;?>">
                                            <?php }?>
                                        </div>
                                        <div class="form-group hidden" id="noStreetFound">
                                            <label class="control-label">Calle</label>
                                            <p class="text-danger">Debe utilizar el mapa para seleccionar el edificio.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group" id="add_altura_desde">
                                            <label class="control-label">Altura:</label>
                                            <input type="text" class="form-control" name="add_altura_desde" value="<?php echo $add_altura_desde = ((bool)$info) ? $info->numero_desde : NULL ;?>" placeholder="Desde">
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group" id="add_altura_hasta">
                                            <label class="control-label">&nbsp;</label>
                                            <input type="text" class="form-control" name="add_altura_hasta" value="<?php echo $add_altura_hasta = ((bool)$info) ? $info->numero_hasta : NULL ;?>" placeholder="Hasta">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="m-b-xs">
                                            <label class="control-label">Doble Frente</label>
                                        </div>
                                        <div class="form-group" id="add_doble_frente">
                                            <label class="control-label checkbox-inline icheck chat">
                                                <input class="form-control" type="radio" value="1" name="add_doble_frente" <?php echo $add_doble_frente = ((bool)$info AND (bool)$info->doble_frente) ? 'checked' : NULL ;?>> Si
                                            </label>
                                            <label class="control-label checkbox-inline icheck chat">
                                                <input class="form-control" type="radio" value="0" name="add_doble_frente" <?php echo $add_doble_frente = ((bool)$info AND (bool)$info->doble_frente) ? NULL : 'checked' ;?>> No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group hidden" id="street_id_df">
                                            <label class="control-label">Calle Secundaria</label>
                                            <select name="street_id_df" class="form-control">
                                            <option value="0">-- Primero Seleccione una Ciudad --</option>
                                            </select>
                                            <?php if ((bool)$info) { ?>
                                            <input type="hidden" name="street_id_df_selected" value="<?php echo $info->calle_df;?>">
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group" id="street_id_one">
                                            <label class="control-label">Calle 1</label>
                                            <select name="street_id_one" class="form-control">
                                            <option value="0">-- Primero Seleccione una Ciudad --</option>
                                            </select>
                                            <?php if ((bool)$info) { ?>
                                            <input type="hidden" name="street_id_one_selected" value="<?php echo $info->entre_calle1;?>">
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group" id="street_id_two">
                                            <label class="control-label">Calle 2</label>
                                            <select name="street_id_two" class="form-control">
                                            <option value="0">-- Primero Seleccione una Ciudad --</option>
                                            </select>
                                            <?php if ((bool)$info) { ?>
                                            <input type="hidden" name="street_id_two_selected" value="<?php echo $info->entre_calle2;?>">
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group" id="street_id_three">
                                            <label class="control-label">Calle 3</label>
                                            <select name="street_id_three" class="form-control">
                                            <option value="0">-- Primero Seleccione una Ciudad --</option>
                                            </select>
                                            <?php if ((bool)$info) { ?>
                                            <input type="hidden" name="street_id_three_selected" value="<?php echo $info->entre_calle3;?>">
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-1">
                                        <div class="form-group" id="add_pisos">
                                            <label class="control-label">Pisos #</label>
                                            <input type="text" class="form-control" name="add_pisos" value="<?php echo $add_pisos = ((bool)$info) ? $info->cantidad_pisos : NULL ;?>" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group" id="add_viviendas">
                                            <label class="control-label">Viviendas #</label>
                                            <input type="text" class="form-control" name="add_viviendas" value="<?php echo $add_viviendas = ((bool)$info) ? $info->cantidad_viviendas : NULL ;?>" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group" id="add_oficinas">
                                            <label class="control-label">Oficinas #</label>
                                            <input type="text" class="form-control" name="add_oficinas" value="<?php echo $add_oficinas = ((bool)$info) ? $info->cantidad_oficinas : NULL ;?>" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group" id="add_locales">
                                            <label class="control-label">Locales #</label>
                                            <input type="text" class="form-control" name="add_locales" value="<?php echo $add_locales = ((bool)$info) ? $info->cantidad_locales : NULL ;?>" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="m-b-xs">
                                            <label class="control-label">Apto Profesional</label>
                                        </div>
                                        <div class="form-group" id="add_apto_profesional">
                                            <label class="control-label checkbox-inline icheck chat">
                                                <input class="form-control" type="radio" value="1" name="add_apto_profesional" <?php echo $add_apto_profesional = ((bool)$info AND (bool)$info->apto_profesional) ? 'checked' : NULL ;?>> Si
                                            </label>
                                            <label class="control-label checkbox-inline icheck chat">
                                                <input class="form-control" type="radio" value="0" name="add_apto_profesional" <?php echo $add_apto_profesional = ((bool)$info AND (bool)$info->apto_profesional) ? NULL : 'checked' ;?>> No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group" id="add_building_cat">
                                            <label class="control-label">Categoría</label>
                                            <select name="add_building_cat" class="form-control">
                                                <option value="0">-- Seleccione --</option>
                                                <?php foreach ($building_cat as $bc) { ?>
                                                <?php $cat_selected = ((bool)$info AND $bc->edificios_cate_codi == $info->categoria) ? 'selected' : NULL ; ?>
                                                <option value="<?php echo $bc->edificios_cate_codi;?>" <?php echo $cat_selected;?>><?php echo $bc->descri;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group" id="add_habilitacion">
                                            <label class="control-label">Fecha de Habilitación</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i id="ico_add_habilitacion" class="fa fa-calendar" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control sDate" name="add_habilitacion" value="<?php echo $add_habilitacion = ((bool)$info) ? date_to('human', $info->fec_habilitacion) : NULL ;?>"
                                                    data-lang="es"
                                                    data-large-mode="true"
                                                    data-large-default="true"
                                                    data-theme="movistar"
                                                    data-format="d-m-Y",
                                                    data-default-date="<?php echo $add_habilitacion = ((bool)$info) ? date_to('eng', $info->fec_habilitacion) : NULL ;?>"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group" id="add_constructora">
                                            <label class="control-label">Constructora / Inmobiliaria</label>
                                            <input type="text" class="form-control" name="add_constructora" value="<?php echo $add_constructora = ((bool)$info) ? $info->const_inmob : NULL ;?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group" id="add_contacto">
                                            <label class="control-label">Contacto</label>
                                            <input type="text" class="form-control" name="add_contacto" value="<?php echo $add_contacto = ((bool)$info) ? $info->contacto : NULL ;?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group" id="add_telefono">
                                            <label class="control-label">Teléfono</label>
                                            <input type="text" class="form-control" name="add_telefono" value="<?php echo $add_telefono = ((bool)$info) ? $info->telefonos : NULL ;?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group" id="add_email">
                                            <label class="control-label">Email</label>
                                            <input type="text" class="form-control" name="add_email" value="<?php echo $add_email = ((bool)$info) ? $info->email : NULL ;?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group" id="add_observaciones">
                                            <label class="control-label">Observaciones</label>
                                            <textarea class="form-control" name="add_observaciones" rows="6"><?php echo $add_observaciones = ((bool)$info) ? $info->observaciones : NULL ;?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row" id="place_item_location">
                                            <div class="col-lg-12">
                                                <div class="form-group input-group" id="input_location">
                                                    <input type="text" id="search_location" name="input_location" class="form-control" placeholder="Seleccione Provincia, Ciudad, Calle y Altura; luego presione localizar.">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-primary get_map"><i class="fa fa-location-arrow fa-fw" aria-hidden="true"></i> Localizar</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p>Presione sobre la marca y arrastre hasta la ubicación correcta.</p>
                                                <div class="google-map" id="geomap"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="row" id="geoData">
                                            <div class="col-lg-12">
                                                <div class="form-group" id="add_building_address">
                                                    <label class="control-label">Domicilio</label>
                                                    <input type="text" class="form-control search_addr" name="add_building_address" value="<?php echo $add_building_address = ((bool)$info) ? $info->calle : NULL ;?>" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group" id="add_building_city">
                                                    <label class="control-label">Ciudad</label>
                                                    <input type="text" class="form-control search_city" name="add_building_city" value="" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group" id="add_building_state">
                                                    <label class="control-label">Provincia</label>
                                                    <input type="text" class="form-control search_state" name="add_building_state" value="" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group" id="add_building_lat">
                                                    <label class="control-label">Latitud</label>
                                                    <input type="text" class="form-control search_latitude" name="add_building_lat" value="<?php echo $add_building_lat = ((bool)$info) ? $info->lat : NULL ;?>" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group" id="add_building_lng">
                                                    <label class="control-label">Longitud</label>
                                                    <input type="text" class="form-control search_longitude" name="add_building_lng" value="<?php echo $add_building_lng = ((bool)$info) ? $info->lng : NULL ;?>" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="hidden" name="custom_address" value="0">
                                        <input type="hidden" name="building_id" value="<?php echo $building_id;?>">
                                        <input type="hidden" name="btn_focus_type" id="btn_focus_type" value="0">
                                        <a role="button" href="<?php echo APP_FOLDER;?>listado" class="btn btn-default pull-left"><i class="fa fa-arrow-left"></i> Volver</a>
                                    </div>
                                    <div class="col-lg-6">
                                        <button type="submit" class="ladda-button btn btn-info pull-right btnSubmit m-l" id="btnSubmit" data-type-btn="saveSend" data-style="slide-right"><i class="fa fa-paper-plane-o fa-fw"></i> Guardar y Enviar</button>
                                        <button type="submit" class="ladda-button btn btn-primary pull-right btnSubmit" id="btnSubmit" data-type-btn="onlySave" data-style="slide-right"><i class="fa fa-floppy-o fa-fw"></i> Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php $this->load->view('template/footer'); ?>
