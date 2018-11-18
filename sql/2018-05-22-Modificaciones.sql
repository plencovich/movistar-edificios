// Agrega nuevo campo en la tabla `auth_users` para guardar el `id_usuario` anterior.
ALTER TABLE `auth_users` ADD `user_code` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `visible`;
