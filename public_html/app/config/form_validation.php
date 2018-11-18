<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Global Form Validation
 *
 * @author Diego Plenco (www.plen.co)
 *
 */

$config = array(
    'login' => array(
        array(
            'field' => 'identity',
            'label' => 'identity',
            'rules' => 'trim|required|valid_email'
        ),
        array(
            'field' => 'password',
            'label' => 'password',
            'rules' => 'trim|required'
        )
    ),
    'recovery' => array(
        array(
            'field' => 'email',
            'label' => 'email',
            'rules' => 'trim|required|valid_email'
        )
    ),
    'reset_password' => array(
        array(
            'field' => 'new',
            'label' => 'new',
            'rules' => 'required|min_length['.gcfg('min_password_length', 'ion_auth').']|max_length['.gcfg('max_password_length', 'ion_auth').']|matches[new_confirm]'
        ),
        array(
            'field' => 'new_confirm',
            'label' => 'new_confirm',
            'rules' => 'required'
        )
    ),
    'register' => array(
        array(
            'field' => 'first_name',
            'label' => 'first_name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'last_name',
            'label' => 'last_name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'identity',
            'label' => 'identity',
            'rules' => 'trim|required|valid_email|is_unique[auth_users.email]'
        ),
        array(
            'field' => 'card_id',
            'label' => 'card_id',
            'rules' => 'trim|required|numeric|is_unique[auth_users.dni]'
        ),
        array(
            'field' => 'license',
            'label' => 'license',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'phone',
            'label' => 'phone',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'state_id',
            'label' => 'state_id',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        ),
        array(
            'field' => 'city_id',
            'label' => 'city_id',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        )
    ),
    'profile_no_pass_no_mail' => array(
        array(
            'field' => 'first_name',
            'label' => 'first_name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'last_name',
            'label' => 'last_name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'card_id',
            'label' => 'card_id',
            'rules' => 'trim|required|numeric|is_unique[auth_users.dni]'
        ),
        array(
            'field' => 'license',
            'label' => 'license',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'phone',
            'label' => 'phone',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'state_id',
            'label' => 'state_id',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        ),
        array(
            'field' => 'city_id',
            'label' => 'city_id',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        )
    ),
    'profile_no_pass_yes_mail' => array(
        array(
            'field' => 'first_name',
            'label' => 'first_name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'last_name',
            'label' => 'last_name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'email',
            'label' => 'email',
            'rules' => 'trim|required|valid_email|is_unique[auth_users.email]'
        ),
        array(
            'field' => 'card_id',
            'label' => 'card_id',
            'rules' => 'trim|required|numeric|is_unique[auth_users.dni]'
        ),
        array(
            'field' => 'license',
            'label' => 'license',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'phone',
            'label' => 'phone',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'state_id',
            'label' => 'state_id',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        ),
        array(
            'field' => 'city_id',
            'label' => 'city_id',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        )
    ),
    'profile_yes_pass_no_mail' => array(
        array(
            'field' => 'first_name',
            'label' => 'first_name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'last_name',
            'label' => 'last_name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'password',
            'label' => 'password',
            'rules' => 'required|min_length['.gcfg('min_password_length', 'ion_auth').']|max_length['.gcfg('max_password_length', 'ion_auth').']|matches[confirm_password]'
        ),
        array(
            'field' => 'confirm_password',
            'label' => 'confirm_password',
            'rules' => 'required'
        ),
        array(
            'field' => 'card_id',
            'label' => 'card_id',
            'rules' => 'trim|required|numeric|is_unique[auth_users.dni]'
        ),
        array(
            'field' => 'license',
            'label' => 'license',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'phone',
            'label' => 'phone',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'state_id',
            'label' => 'state_id',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        ),
        array(
            'field' => 'city_id',
            'label' => 'city_id',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        )
    ),
    'profile_yes_pass_yes_mail' => array(
        array(
            'field' => 'first_name',
            'label' => 'first_name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'last_name',
            'label' => 'last_name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'password',
            'label' => 'password',
            'rules' => 'required|min_length['.gcfg('min_password_length', 'ion_auth').']|max_length['.gcfg('max_password_length', 'ion_auth').']|matches[confirm_password]'
        ),
        array(
            'field' => 'confirm_password',
            'label' => 'confirm_password',
            'rules' => 'required'
        ),
        array(
            'field' => 'email',
            'label' => 'email',
            'rules' => 'trim|required|valid_email|is_unique[auth_users.email]'
        ),
        array(
            'field' => 'card_id',
            'label' => 'card_id',
            'rules' => 'trim|required|numeric|is_unique[auth_users.dni]'
        ),
        array(
            'field' => 'license',
            'label' => 'license',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'phone',
            'label' => 'phone',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'state_id',
            'label' => 'state_id',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        ),
        array(
            'field' => 'city_id',
            'label' => 'city_id',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        )
    ),
    'user_no_mail' => array(
        array(
            'field' => 'first_name',
            'label' => 'first_name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'last_name',
            'label' => 'last_name',
            'rules' => 'trim|required'
        )
    ),
    'user_yes_mail' => array(
        array(
            'field' => 'first_name',
            'label' => 'first_name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'last_name',
            'label' => 'last_name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'email',
            'label' => 'email',
            'rules' => 'trim|required|valid_email|is_unique[auth_users.email]'
        )
    ),
    'building_new_0' => array(
        array(
            'field' => 'add_denominacion',
            'label' => 'add_denominacion',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'state_id',
            'label' => 'state_id',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        ),
        array(
            'field' => 'city_id',
            'label' => 'city_id',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        ),
        array(
            'field' => 'region_id',
            'label' => 'region_id',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        ),
        array(
            'field' => 'street_id',
            'label' => 'street_id',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        ),
        array(
            'field' => 'add_altura_desde',
            'label' => 'add_altura_desde',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        ),
        array(
            'field' => 'add_altura_hasta',
            'label' => 'add_altura_hasta',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        ),
        array(
            'field' => 'add_doble_frente',
            'label' => 'add_doble_frente',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'street_id_one',
            'label' => 'street_id_one',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        ),
        array(
            'field' => 'street_id_two',
            'label' => 'street_id_two',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        ),
        array(
            'field' => 'street_id_three',
            'label' => 'street_id_three',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        ),
        array(
            'field' => 'add_pisos',
            'label' => 'add_pisos',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'add_viviendas',
            'label' => 'add_viviendas',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'add_oficinas',
            'label' => 'add_oficinas',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'add_locales',
            'label' => 'add_locales',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'add_viviendas',
            'label' => 'add_viviendas',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'add_apto_profesional',
            'label' => 'add_apto_profesional',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'add_building_cat',
            'label' => 'add_building_cat',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        ),
        array(
            'field' => 'add_habilitacion',
            'label' => 'add_habilitacion',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'add_constructora',
            'label' => 'add_constructora',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'add_contacto',
            'label' => 'add_contacto',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'add_telefono',
            'label' => 'add_telefono',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'add_email',
            'label' => 'add_email',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'add_observaciones',
            'label' => 'add_observaciones',
            'rules' => 'trim'
        )
    ),
    'building_new_1' => array(
        array(
            'field' => 'add_denominacion',
            'label' => 'add_denominacion',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'state_id',
            'label' => 'state_id',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        ),
        array(
            'field' => 'city_id',
            'label' => 'city_id',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        ),
        array(
            'field' => 'region_id',
            'label' => 'region_id',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        ),
        array(
            'field' => 'add_building_address',
            'label' => 'add_building_address',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'input_location',
            'label' => 'input_location',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'add_building_lat',
            'label' => 'add_building_lat',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'add_building_lng',
            'label' => 'add_building_lng',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'add_altura_desde',
            'label' => 'add_altura_desde',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        ),
        array(
            'field' => 'add_altura_hasta',
            'label' => 'add_altura_hasta',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        ),
        array(
            'field' => 'add_doble_frente',
            'label' => 'add_doble_frente',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'add_pisos',
            'label' => 'add_pisos',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'add_viviendas',
            'label' => 'add_viviendas',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'add_oficinas',
            'label' => 'add_oficinas',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'add_locales',
            'label' => 'add_locales',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'add_viviendas',
            'label' => 'add_viviendas',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'add_apto_profesional',
            'label' => 'add_apto_profesional',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'add_building_cat',
            'label' => 'add_building_cat',
            'rules' => 'trim|required|numeric|is_natural_no_zero'
        ),
        array(
            'field' => 'add_habilitacion',
            'label' => 'add_habilitacion',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'add_constructora',
            'label' => 'add_constructora',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'add_contacto',
            'label' => 'add_contacto',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'add_telefono',
            'label' => 'add_telefono',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'add_email',
            'label' => 'add_email',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'add_observaciones',
            'label' => 'add_observaciones',
            'rules' => 'trim'
        )
    )
);
