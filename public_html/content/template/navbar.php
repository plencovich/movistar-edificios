<div id="wrapper">
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom-shadow p-w-sm">
            <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-header">
                    <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                        <i class="fa fa-reorder"></i>
                    </button>
                    <a href="/" class="navbar-brand"><img alt="<?php echo wmscp('project_name'); ?>" class="img-responsive center-block m-t-n-xs" src="<?php echo wmscp('project_logo_backend'); ?>"></a>
                </div>
                <div class="navbar-collapse collapse" id="navbar">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="<?php echo APP_FOLDER;?>listado"><i class="fa fa-building fa-fw"></i> <span class="nav-label">Edificios</span></a>
                        </li>
                        <?php if ((bool) only(array('administrators'))) { ?>
                        <li class="dropdown">
                            <a aria-expanded="false" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-fw nav-label"></i> <span class="nav-label">Usuarios <span class="caret"></span></span></a>
                            <ul role="menu" class="dropdown-menu">
                            <?php foreach ($this->ion_auth->groups()->result() as $group) { ?>
                                <li><a href="<?php echo APP_FOLDER;?>usuarios/<?php echo $group->name;?>"><?php echo $group->description;?></a></li>
                            <?php } ?>
                            </ul>
                        </li>
                        <?php } ?>
                    </ul>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="<?php echo APP_FOLDER;?>perfil"><i class="fa fa-user-circle fa-fw"></i> <span class="nav-label"> <?php echo $user_logged->full_name;?></span></a>
                        </li>
                        <li>
                            <a href="<?php echo APP_FOLDER;?>salir"><i class="fa fa-sign-out fa-fw"></i> <span class="nav-label"> Salir</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
