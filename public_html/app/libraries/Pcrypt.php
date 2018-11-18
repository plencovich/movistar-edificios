<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * pCrypt Library
 *
 * @author Diego Plenco (www.plen.co)
 *
 */

class Pcrypt
{
    public function __get($var)
    {
        return get_instance()->$var;
    }

    public function __construct()
    {
        $this->secret_key = 'j7Nzkq0Y';
        $this->secret_iv = 'MOVISTAR18';

        $this->output = false;
        $this->encrypt_method = "blowfish";
        $this->key = hash( 'sha256', $this->secret_key );
        $this->iv = substr( hash( 'sha256', $this->secret_iv ), 0, 8 );
    }

    function data($method, $input)
    {
        switch ($method) {
            case 'encode':
                $output = base64_encode( openssl_encrypt( $input, $this->encrypt_method, $this->key, 0, $this->iv ) );
                $string=str_replace(array('+', '/', '='), array('-', '_', '~'), $output);
            break;

            case 'decode':
                $output=str_replace(array('-', '_', '~'), array('+', '/', '='), $input);
                $string = openssl_decrypt( base64_decode( $output ), $this->encrypt_method, $this->key, 0, $this->iv );
            break;
        }
        return $string;
    }
}
