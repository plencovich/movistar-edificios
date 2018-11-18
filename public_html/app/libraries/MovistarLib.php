<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Content Manager Option Library
 *
 * @author Diego Plenco (www.plen.co)
 *
 */

class MovistarLib
{
    public function __get($var)
    {
        return get_instance()->$var;
    }

    public function __construct()
    {
        $this->pdo = new \PDO("dblib:host=10.249.16.105;dbname=sigest_edificios","sigestEdifMat" ,"sg30EM10");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function get_parcela($calle_id,$calle_nro)
    {
        $sql = 'exec Edificios_wm_datos_parcela_sel '.$calle_id.', '.$calle_nro;

        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_OBJ);

        return ($stm->rowCount() > 0) ? $result[0] : FALSE ;
    }

    public function crear_solicitud($sql_data)
    {
        $sql = 'exec edificios_wm_alta '.$sql_data;

        $stm = $this->pdo->prepare($sql);
        $stm->execute();

        return ($stm->rowCount() > 0) ? TRUE : FALSE ;
    }

    public function get_cod_asesoramiento($building_id_decode)
    {
        $sql = 'exec edificios_wm_edificios_sel '.$building_id_decode;

        $stm = $this->pdo->prepare($sql);
        $stm->execute();

        $result = $stm->fetchAll(PDO::FETCH_OBJ);

        return ($stm->rowCount() > 0) ? $result[0] : FALSE ;
    }

    public function get_usuario_codi_asesor($info)
    {
        $sql = 'exec edificios_wm_usuario_detalle_sel '.$info->usuario_codi_asesor;

        $stm = $this->pdo->prepare($sql);
        $stm->execute();

        $result = $stm->fetchAll(PDO::FETCH_OBJ);

        return ($stm->rowCount() > 0) ? $result[0] : FALSE ;
    }

    public function update_asesoramiento_solicitud($sql_data)
    {
        $sql = 'exec Edificios_wm_ases_solic_upd '.$sql_data;

        $stm = $this->pdo->prepare($sql);
        $stm->execute();

        return ($stm->rowCount() > 0) ? TRUE : FALSE ;
    }
}
