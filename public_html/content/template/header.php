<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $title.' :: '.wmscp('project_company').' - '.wmscp('project_name');?></title>

    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" type="text/css">
    <link href="<?php echo APP_FOLDER.'assets/css/styles.min.css?'.APP_VERSION;?>" rel="stylesheet" type="text/css">

    <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon">
</head>

<body class="top-navigation <?php echo $classbody = (isset($class_body)) ? 'main-bg img-bg' : NULL ; ?>">
