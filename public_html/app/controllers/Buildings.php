<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buildings extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect(APP_FOLDER.'acceso');
        } else {
            allow_only(array('administrators','managers'));
            $this->user_info = $this->ion_auth->user()->row();
            $this->data['user_logged'] = $this->user_info;
            $this->load->model('backend/Building_model', 'building');
            $this->load->library('MovistarLib');
        }
    }

    public function list_get()
    {
        $this->data['title'] = gcfg('buildings-list', 'page_title');
        $this->load->view('buildings/list', $this->data);
    }

    public function list_post()
    {
        $list_buildings = $this->building->make_datatables($this->user_info->user_code);
        $data = array();
        foreach($list_buildings as $building) {
            $id_solicitud_encode = $this->pcrypt->data('encode',$building->id_solicitud);
            $status_ingresada = $building->ingresada;
            $is_codi_asesor = ($building->usuario_codi_asesor != 0) ? 1 : 0 ;
            $request_btn = ($building->ase_presentacion == '' ) ? '<a class="btn-link" href="'.APP_FOLDER.'asesoramiento/'.$id_solicitud_encode.'">Pedir</a>' : '<a class="btn-link" href="'.APP_FOLDER.'asesoramiento/'.$id_solicitud_encode.'">'.date('d-m-Y',strtotime($building->ase_presentacion)).' '.gcfg($is_codi_asesor,'status_codi_asesor').'</a>';
            $request = ((bool)$status_ingresada) ? $request_btn : NULL ;
            $is_approval = $building->pla_aprobacion > '0000-00-00' ? TRUE : FALSE;

            if ((bool)$is_codi_asesor) {
                $plan = (is_null($building->pla_presentacion) OR $building->pla_presentacion == '0000-00-00' ) ? 'Presentar' : date('d-m-Y',strtotime($building->pla_presentacion));
                $is_plan = ($building->pla_presentacion > '0000-00-00' ) ? 1 : 0;
                $reject_btn = ($building->pla_rechazo > '0000-00-00' ) ? ' '.gcfg('0','status_request') : NULL;
                $approval_btn = ((bool)$is_plan AND $is_approval) ? ' '.gcfg('1','status_request') : NULL;
                $plan_btn = $plan.$reject_btn.$approval_btn;
            }
            $plan = ((bool)$is_codi_asesor) ? $plan_btn : NULL ;

            $test = NULL;
            if ((bool)$is_approval) {
                $pru_solicitud = date("d-m-Y",strtotime($building->pru_solicitud));
                $it_approved = ($building->pru_aprobacion > '0000-00-00' ) ? $pru_solicitud.' '.gcfg('1','status_request') : NULL;
                if (is_null($it_approved)) {
                    if ($building->pru_rechazo_cantidad > 0) {
                        if ($building->pru_rechazo_cantidad >= 3) {
                            $test = '<span class="text-danger">Rechazado</span>';
                        } else {
                            $test = (strtotime($building->pru_rechazada) > strtotime($building->pru_solicitud)) ? 'Solicitar '.gcfg('0','status_request') : $pru_solicitud ;
                        }
                    } else {
                        $test = ($building->pru_solicitud > '0000-00-00' ) ? $pru_solicitud : 'Solicitar';
                    }

                } else {
                    $test = $it_approved;
                }
            }
            $path_sheet = ((bool)$status_ingresada) ? 'detail/' : 'edit/' ;
            $altura = ($building->numero_desde == $building->numero_hasta) ? $building->numero_desde : $building->numero_desde.' / '.$building->numero_hasta;
            $sub_array = array();
            $sub_array[] = $building->id_solicitud;
            $sub_array[] = $building->address.' '.$altura;
            $sub_array[] = $building->state;
            $sub_array[] = $building->city;
            $sub_array[] = $building->cantidad_pisos;
            $sub_array[] = $building->cantidad_viviendas;
            $sub_array[] = $building->cantidad_oficinas;
            $sub_array[] = $building->cantidad_locales;
            $sub_array[] = date('d-m-y H:i', strtotime($building->fecha_alta));
            $sub_array[] = $request;
            $sub_array[] = $plan;
            $sub_array[] = $test;
            $sub_array[] = '<a href="'.APP_FOLDER.$path_sheet.$id_solicitud_encode.'" class="'.gcfg($status_ingresada,'action_ico_class').'" role="button" data-toggle="tooltip" title="'.gcfg($status_ingresada,'action_ico_tooltip').'"><i class="'.gcfg($status_ingresada,'action_ico').'"></i></a>';
            $data[] = $sub_array;
        }
        $draw = (isset($_POST["draw"])) ? intval($_POST["draw"]) : 1 ;
        $output = array(
            'draw' => $draw,
            'recordsTotal' => $this->building->get_all_data($this->user_info->user_code),
            'recordsFiltered' => $this->building->get_filtered_data($this->user_info->user_code),
            'data' => $data
        );
        echo json_encode($output);
    }

    public function sheet_get($type, $id_solicitud_encode = NULL)
    {
        if (in_array($type,array('add','edit','detail','asesoramiento'))) {
            $this->load->model('backend/General_model', 'gral');
            $this->data['title'] = gcfg('buildings-'.$type, 'page_title');
            $this->data['state_list'] = $this->gral->state_list()->result();
            $this->data['building_cat'] = $this->gral->building_cat_list()->result();
            if (isset($id_solicitud_encode)) {
                $id_solicitud = $this->pcrypt->data('decode', $id_solicitud_encode);
                $info =  $this->building->get_info($id_solicitud,$this->user_info->user_code);
                if ($info->num_rows() > 0) {
                    $this->data['info'] = $info->row();
                    $this->data['building_id'] = $id_solicitud_encode;
                } else {
                    $this->errorlib->show(404);
                }
            }
            switch ($type) {
                case 'add':
                    $this->data['info'] = NULL;
                    $this->data['load_gmaps'] = 1;
                    $this->data['building_id'] = $this->pcrypt->data('encode', 0);
                    $type_file = 'sheet';
                break;

                case 'edit':
                    $this->data['load_gmaps'] = 1;
                    $type_file = 'sheet';
                break;

                case 'detail':
                    $this->data['calle1_name'] = $this->gral->street_info($info->row()->entre_calle1)->row()->descrip;
                    $this->data['calle2_name'] = $this->gral->street_info($info->row()->entre_calle2)->row()->descrip;
                    $this->data['calle3_name'] = $this->gral->street_info($info->row()->entre_calle3)->row()->descrip;
                    $this->data['categoria_name'] = $this->gral->categoria_info($info->row()->categoria)->row()->descri;
                    $type_file = 'detail';

                    $this->data['asesor'] = ((bool)$info->row()->usuario_codi_asesor) ? $this->movistarlib->get_usuario_codi_asesor($info->row()) : NULL ;
                    $this->data['readonly'] = 1;
                break;

                case 'asesoramiento';
                    $this->data['asesor'] = ((bool)$info->row()->usuario_codi_asesor) ? $this->movistarlib->get_usuario_codi_asesor($info->row()) : NULL ;
                    $this->data['readonly'] = ((bool)$info->row()->usuario_codi_asesor) ? 1 : NULL ;
                    $this->data['alone'] = 1;
                    $this->data['full_address'] = $info->row()->calle_name.' ';
                    $this->data['full_address'] .= ($info->row()->numero_desde == $info->row()->numero_hasta) ? $info->row()->numero_desde : $info->row()->numero_desde.'/'.$info->row()->numero_hasta;
                    $doble_frente_altura = ($info->row()->numero_df_desde == $info->row()->numero_df_hasta) ? $info->row()->numero_df_desde : $info->row()->numero_df_desde.'/'.$info->row()->numero_df_hasta;
                    $calle_df = ((bool)$info->row()->calle_df) ? $this->gral->street_info($info->row()->calle_df)->row()->descrip : NULL;
                    $this->data['full_address'] .= ((bool)$info->row()->calle_df) ? ' ( '.$calle_df.' '.$doble_frente_altura.' ) ' : NULL;
                    $this->data['full_address'] .= $info->row()->barrio.', '.$info->row()->ciudad_name.', '.$info->row()->provincia_name;
                    $type_file = 'asesoramiento';
                break;
            }

            $this->load->view('buildings/'.$type_file, $this->data);
        } else {
            $this->errorlib->show(404);
        }
    }

    function sheet_post($type)
    {
        if ($this->input->is_ajax_request()) {
            $custom_address = $this->input->post('custom_address');
            $arr = array();
            $building_id = $this->input->post('building_id');
            $building_id_decode = $this->pcrypt->data('decode', $building_id);
            $btn_type = $this->input->post('btn_focus_type');

            switch ($type) {
                case 'add':
                    $this->load->library('form_validation');

                    $this->form_validation->set_message('required', '{field}|required');
                    $this->form_validation->set_message('numeric', '{field}|numeric');
                    $this->form_validation->set_message('is_natural_no_zero', '{field}|is_natural_no_zero');

                    if (!(bool)$this->form_validation->run('building_new_'.$custom_address)) {
                        $chk_required = strpos(validation_errors(), 'required');
                        $chk_numeric = strpos(validation_errors(), 'numeric');
                        $chk_not_zero = strpos(validation_errors(), 'is_natural_no_zero');

                        if ($chk_required !== FALSE) {
                            $message = lang('missing_data');
                        } elseif ($chk_numeric !== FALSE) {
                            $message = lang('only_numbers');
                        } elseif ($chk_not_zero !== FALSE) {
                            $message = lang('not_selected');
                        }

                        $arr = alertSwal('error','validation',$message,FALSE);
                        $arr['errors'] = validation_errors(' ','|');

                    } else {

                        if ((bool)$building_id_decode) {
                            $info = $this->_data_buildings('edit');
                            $check = $this->building->update_data($info,$building_id_decode);
                            $msg_general = ((bool)$check) ? lang('update_ok') : lang('update_fail') ;
                        } else {
                            $info = $this->_data_buildings('new');
                            $check = $this->building->save_data($info);
                            $msg_general = ((bool)$check) ? lang('create_ok') : lang('create_fail') ;
                            $building_id_decode = $this->db->insert_id();
                        }

                        if ($btn_type === 'saveSend') {
                            $alta_en_movistar = $this->_crear_solicitud($building_id_decode);
                        }
                    }
                break;

                case 'asesoramiento':
                    $attach_file = $this->input->post('attach_file');
                    if ((bool)$attach_file) {
                        $info =  $this->building->get_info($building_id_decode,$this->user_info->user_code)->row();
                        $plano = $this->_save_plano($info);
                        extract($plano);

                        if ((bool)$check) {

                            $fecha_presentacion = ($info->ase_presentacion == '') ? date('Y-m-d H:i:s') : $info->ase_presentacion ;
                            $fecha_presentacion_pdo = ($info->ase_presentacion == '') ? date_to('customDateTime',date('Y-m-d H:i:s')) : $info->ase_presentacion ;

                            $sql_add_data = $building_id_decode."', ";
                            $sql_add_data .= "'".$fecha_presentacion_pdo."', ";
                            $sql_add_data .= "'".$this->input->post('add_observaciones')."', ";
                            $sql_add_data .= "'".$file_name."', ";

                            $update_asesoramiento = $this->movistarlib->update_asesoramiento_solicitud($sql_data);

                            $presentacion = ((bool)$update_asesoramiento) ? $fecha_presentacion : NULL ;

                            if (gnou() == 'administrators') {
                                $info_asesoramiento = array(
                                    'observaciones_asesoramiento' => $this->input->post('add_observaciones'),
                                    'usuario_codi_asesor' => $this->user_info->user_code,
                                    'ase_cumplido' => $presentacion
                                );
                            } else {
                                $info_asesoramiento = array(
                                    'observaciones_asesoramiento' => $this->input->post('add_observaciones'),
                                    'ase_presentacion' => $presentacion
                                );
                            }
                            $check = $this->building->update_data($info_asesoramiento,$building_id_decode);
                            $msg_general = sprintf(lang('msg_central'),lang('update'),'Asesoramiento',gcfg($check,'status_label_update')).$msg_general;
                        }
                    } else {
                        $msg_general = sprintf(lang('msg_central'),lang('update'),lang('plano'),gcfg('0','status_label_update'));
                        $check = TRUE;
                    }
                break;
            }
            if (isset($check) AND (bool)$check) {
                $arr = alertSwal('ok',NULL,$msg_general,TRUE,TRUE,APP_FOLDER.'listado');
            } else {
                $arr = alertSwal('error',NULL,$msg_general,FALSE);
            }
            echo json_encode($arr);
        } else {
            $this->errorlib->show(404);
        }
    }

    private function _crear_solicitud($building_id_decode)
    {
        if ($this->input->post('add_altura_desde') == $this->input->post('add_altura_hasta')) {

            $get_central = $this->movistarlib->get_parcela($this->input->post('street_id'),$this->input->post('add_altura_desde'));

            $id_central = ((bool)$get_central) ? $get_central->codigo_central : 0 ;
            $ipid_parcela = ((bool)$get_central) ? $get_central->ipid_parcela : 0 ;
            $cod_manzana = ((bool)$get_central) ? $get_central->cod_manzana : 0 ;
        }

        $cod_asesoramiento = 0;
        $doble_frente = ((bool)$this->input->post('add_doble_frente')) ? 'SI' : 'NO' ;
        $apto_profesional = ((bool)$this->input->post('add_apto_profesional')) ? 'SI' : 'NO' ;
        $fecha_hab = date_to('customDate',$this->input->post('add_habilitacion'));
        $fecha_alta = date_to('customDateTime',now());

        $sql_add_data .= $cod_asesoramiento.', '.$building_id_decode.', ';
        $sql_add_data .= $id_central.', ';
        $sql_add_data .= $this->input->post('city_id').', ';
        $sql_add_data .= $this->input->post('street_id').', "';
        $sql_add_data .= $this->input->post('add_altura_desde').'", "';
        $sql_add_data .= $this->input->post('add_altura_hasta').'", "';
        $sql_add_data .= "'".$doble_frente."', ";
        $sql_add_data .= $this->input->post('street_id_df').", '";
        $sql_add_data .= $this->input->post('add_altura_desde_df')."', '";
        $sql_add_data .= $this->input->post('add_altura_hasta_df')."', '";
        $sql_add_data .= $this->user_info->matricula."', '";
        $sql_add_data .= $ipid_parcela."', ";
        $sql_add_data .= "'".$this->input->post('add_denominacion')."', ";
        $sql_add_data .= $this->input->post('street_id_one').", ";
        $sql_add_data .= $this->input->post('street_id_two').", ";
        $sql_add_data .= $this->input->post('street_id_three').", '";
        $sql_add_data .= $cod_manzana."', '";
        $sql_add_data .= $this->input->post('add_constructora')."', ";
        $sql_add_data .= "'".$this->input->post('add_contacto')."', '";
        $sql_add_data .= $this->input->post('add_telefono')."', '";
        $sql_add_data .= $this->input->post('add_email')."', ";
        $sql_add_data .= $this->input->post('add_pisos').", ";
        $sql_add_data .= $this->input->post('add_viviendas').", ";
        $sql_add_data .= $this->input->post('add_oficinas').", ";
        $sql_add_data .= $this->input->post('add_locales').", ";
        $sql_add_data .= $this->input->post('add_building_cat').", '";
        $sql_add_data .= $apto_profesional."', '";
        $sql_add_data .= $fecha_alta."', '";
        $sql_add_data .= $fecha_hab."'";
        $sql_add_data .= ", '".$this->input->post('add_building_lat')."', '";
        $sql_add_data .= $this->input->post('add_building_lng')."', '";
        $sql_add_data .= $this->input->post('add_observaciones')."'";

        $exec = $this->movistarlib->crear_solicitud($sql_data);

        if ((bool)$exec) {

            $get_cod_asesoramiento = $this->movistarlib->get_cod_asesoramiento($building_id_decode);

            if ((bool)$get_cod_asesoramiento) {
                $cod_asesoramiento = $get_cod_asesoramiento->edificios_codi;

                $info = array(
                    'cod_asesoramiento' => $cod_asesoramiento,
                    'ingresada' => 1
                );
            }

            $this->building->update_data($info, $building_id_decode);

            return TRUE;
        } return FALSE;
    }

    private function _data_buildings($type)
    {
        $info = array(
            'denominacion' => $this->input->post('add_denominacion'),
            'cd_calle' => $this->input->post('street_id'),
            'calle' => $this->input->post('add_building_address'),
            'numero_desde' => $this->input->post('add_altura_desde'),
            'numero_hasta' => $this->input->post('add_altura_hasta'),
            'entre_calle1' => $this->input->post('street_id_one'),
            'entre_calle2' => $this->input->post('street_id_two'),
            'entre_calle3' => $this->input->post('street_id_three'),
            'doble_frente' => $this->input->post('add_doble_frente'),
            'calle_df' => $this->input->post('street_id_df'),
            'numero_df_desde' => '0',
            'numero_df_hasta' => '0',
            'id_provincia' => $this->input->post('state_id'),
            'id_ciudad' => $this->input->post('city_id'),
            'id_partido' => $this->input->post('region_id'),
            'barrio' => $this->input->post('add_barrio'),
            'cantidad_pisos' => $this->input->post('add_pisos'),
            'cantidad_viviendas' => $this->input->post('add_viviendas'),
            'cantidad_oficinas' => $this->input->post('add_oficinas'),
            'cantidad_locales' => $this->input->post('add_locales'),
            'fec_habilitacion' => date_to('sql',$this->input->post('add_habilitacion')),
            'apto_profesional' => $this->input->post('add_apto_profesional'),
            'categoria' => $this->input->post('add_building_cat'),
            'const_inmob' => $this->input->post('add_constructora'),
            'contacto' => $this->input->post('add_contacto'),
            'telefonos' => $this->input->post('add_telefono'),
            'email' => $this->input->post('add_email'),
            'observaciones' => $this->input->post('add_observaciones'),
            'lat' => $this->input->post('add_building_lat'),
            'lng' => $this->input->post('add_building_lng'),
            'ingresada' => 0,
            'id_usuario_alta' => $this->user_info->user_code
        );

        $now = date('Y-m-d H:i:s', now());
        switch ($type) {
            case 'new':
                $new_info = array(
                    'fecha_alta' => $now
                );
                $info = array_merge($info, $new_info);
            break;

            case 'edit':
                $edit_info = array(
                    'id_usuario_modif' => $this->user_info->user_code,
                    'ultima_modif' => $now
                );
                $info = array_merge($info, $edit_info);
            break;
        }

        if ($this->input->post('add_altura_desde') == $this->input->post('add_altura_hasta')) {

            $get_central = $this->movistarlib->get_parcela($this->input->post('street_id'),$this->input->post('add_altura_desde'));

            if ((bool)$get_central) {
                $add_info = array(
                    'id_central' => $get_central->codigo_central,
                    'cod_manzana' => $get_central->codigo_manzana,
                    'ipid_parcela' => $get_central->ipid_parcela
                );
                $info = array_merge($info, $add_info);
            }
        }

        return $info;
    }

    private function _save_plano($item)
    {
        $this->load->library('upload');
        $file_name = $item->id_solicitud.'-'.create_slug($item->denominacion).'-'.strtolower(str_rand(4));
        $config_plano['upload_path'] = FCPATH.PATH_PRIVATE_PLANOS;
        $config_plano['allowed_types'] = gcfg('for_config', 'mime_type');
        $config_plano['file_name'] = $file_name;
        $config_plano['file_ext_tolower'] = TRUE;
        $this->upload->initialize($config_plano, TRUE);

        if ($this->upload->do_upload('userfile_attach')) {
            $data_file = $this->upload->data();

            if ((bool)$item->plano_arquitectura) {
                $this->_delete_file(PATH_PRIVATE_PLANOS,$item->plano_arquitectura);
            }
            $check = $this->building->update_data(array('plano_arquitectura' => $data_file['file_name']), $item->id_solicitud);
            $msg_general = sprintf(lang('msg_central'),lang('update'),lang('plano'),gcfg($check,'status_label'));
            $file_name = $data_file['file_name'];

        } else {
            $check = FALSE;
            $file_name = FALSE;
            $msg_general = sprintf(lang('msg_central'),lang('update'),lang('plano'),gcfg($check,'status_label').': '.$this->upload->display_errors('',''));
        }

        return array('check' => $check, 'msg_general' => $msg_general, 'file_name' => $file_name);
    }

    private function _delete_file($path,$file)
    {
        $full_path_file = FCPATH.$path.$file;

        if (file_exists($full_path_file)) {
            unlink($full_path_file);
            return TRUE;
        }
        return FALSE;
    }

    function city_region_list_post($state_id)
    {
        if ($this->input->is_ajax_request()) {
            $this->load->model('backend/General_model', 'gral');
            $arr = array();

            $list_all_city = $this->gral->city_list($state_id);
            if ($list_all_city->num_rows() > 0) {
                $arr['city_list'] = $list_all_city->result();
            } else {
                $arr['city_list'] = NULL;
            }

            $list_all_region = $this->gral->region_list($state_id);
            if ($list_all_region->num_rows() > 0) {
                $arr['region_list'] = $list_all_region->result();
            } else {
                $arr['region_list'] = NULL;
            }
            echo json_encode($arr);
        } else {
            $this->errorlib->show(404);
        }
    }

    function street_list_post($city_id)
    {
        if ($this->input->is_ajax_request()) {
            $this->load->model('backend/General_model', 'gral');
            $arr = array();

            $list_all_street = $this->gral->street_list($city_id);
            if ($list_all_street->num_rows() > 0) {
                $arr['street_list'] = $list_all_street->result();
            } else {
                $arr['street_list'] = NULL;
            }
            echo json_encode($arr);
        } else {
            $this->errorlib->show(404);
        }
    }
}
