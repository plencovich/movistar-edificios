<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function ask_advice($user_code)
    {
        $query = $this->db->from('solicitudes')
                            ->where('id_usuario_alta',$user_code)
                            ->where('ingresada',1)
                            ->where('ase_presentacion IS NULL')
                            ->count_all_results();
        return $query;
    }

    public function submit_plans($user_code)
    {
        $query = $this->db->from('solicitudes')
                            ->where('id_usuario_alta',$user_code)
                            ->where('ingresada',1)
                            ->where('usuario_codi_asesor != 0')
                            ->group_start()
                                ->where('pla_presentacion IS NULL')
                                ->or_where('pla_presentacion', '0000-00-00')
                            ->group_end()
                            ->count_all_results();
        return $query;
    }

    public function request_test($user_code)
    {
        $query = $this->db->from('solicitudes')
                            ->where('id_usuario_alta',$user_code)
                            ->where('ingresada',1)
                            ->where('pru_solicitud IS NULL')
                            ->where('pru_rechazada IS NULL')
                            ->where('pru_aprobacion IS NULL')
                            ->where('pla_rechazo > 0')
                            ->count_all_results();
        return $query;
    }
}
