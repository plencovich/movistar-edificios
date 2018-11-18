<?php
/**
 * Textos del Sistema
 *
 * @author Diego Plenco (www.plen.co)
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/* Alertas */
$lang['yes'] = 'Si';
$lang['no'] = 'No';
$lang['thanks'] = 'Gracias!';
$lang['title_ok'] = 'Listo!';
$lang['title_error'] = 'Ups!';
$lang['title_warning'] = 'Ups!';
$lang['title_delete'] = 'Está Seguro?';
$lang['label_delete'] = 'Se eliminará del sistema.';
$lang['btn_del_yes'] = 'Si, eliminar!';
$lang['btn_del_no'] = 'No, cancelar!';
$lang['missing_data'] = 'Uno o más campos obligatorios están vacios.';
$lang['only_numbers'] = 'Debe ingresar sólo números.';
$lang['only_letters'] = 'Debe ingresar sólo letras.';
$lang['email_not_valid'] = 'El email ingresado no es válido.';
$lang['min_length'] = 'Debe ingresar al menos %s caracteres de longitud.';
$lang['max_length'] = 'No debe superar los %s caracteres de longitud.';
$lang['matches'] = 'Ambos campos deben coincidir.';
$lang['create_ok'] = 'Nuevo registro creado.';
$lang['create_fail'] = 'Registro no creado.<br>Intente nuevamente.';
$lang['update_ok'] = 'Registro actualizado.';
$lang['update_fail'] = 'Registro sin modificaciones.';
$lang['form_fail'] = 'Problemas al procesar el formulario. (Error %s)';
$lang['delete_ok'] = 'Registro eliminado.';
$lang['delete_fail'] = 'Registro no eliminado.';
$lang['error_update_gral'] = 'Error inesperado.<br>Consulte con su administrador. <small class="text-danger">(Error 4x)</small>';
$lang['error_save_file'] = 'Error 777<br>Consulte con su administrador.';
$lang['not_unique'] = 'Ya existe en nuestro sistema';
$lang['not_selected'] = 'Faltan seleccionar items.';

// Globales para los SWAL
$lang['msg_central'] = '<p class="text-left">%s %s %s</p>';
$lang['create'] = 'Crear';
$lang['update'] = 'Actualizar';
$lang['delete'] = 'Borrar';

$lang['plano'] = 'Plano Arquitectura';

/* Errors */
$lang['error_404'] = 'Página no encontrada.';
$lang['error_403'] = 'Su nivel de usuario no tiene permisos de acceso.<br>Consulte con su administrador.';
$lang['error_general'] = 'Error Operativo.';

/* Login */
$lang['login_incorrect'] = 'Email y/o Contraseña incorrecto.';
$lang['recovery_ok'] = 'Un email con las instrucciones para recuperar su contraseña ha sido enviado.';

/* Mail Status */
$lang['mail_send_ok'] = 'un email con los datos de acceso fue enviado.';
$lang['mail_send_fail'] = 'pero hubo un Error al enviar el email.';


/* Mail Subject */
$lang['mail_welcome'] = '[MOVISTAR] Datos de Acceso';
$lang['mail_forgotten_password'] = '[MOVISTAR] Verificación de contraseña olvidada';
