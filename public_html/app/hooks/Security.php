<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Seguridad
 *
 * @author Diego Plenco (www.plen.co)
 *
 */

function secure_project()
{
	$CI =& get_instance();
	$CI->config->set_item('cookie_secure', TRUE);
	$CI->config->set_item('cookie_httponly', TRUE);

	$CI->output->set_header("Strict-Transport-Security: max-age=2629800") // Forzar futuras solicitudes para que superen HTTPS (la edad máxima se establece en 1 mes)
			   ->set_header("X-Content-Type-Options: nosniff") // Deshabilitar el rastreo de tipo MIME
			   ->set_header("Referrer-Policy: strict-origin") // Permitir que solo se envíen referencias en el sitio web
			   ->set_header("X-Frame-Options: DENY") // No se permiten Frames
			   ->set_header("X-XSS-Protection: 1; mode=block"); // Habilitar la protección XSS en el navegador
}
