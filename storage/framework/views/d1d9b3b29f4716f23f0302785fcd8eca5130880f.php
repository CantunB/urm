<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version  v3.2.0
* @link  https://coreui.io
* Copyright (c) 2020 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>SMAPAC - <?php echo $__env->yieldContent('title','Compras'); ?></title>
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo e(asset('admin/assets/favicon/apple-icon-57x57.png')); ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo e(asset('admin/assets/favicon/apple-icon-60x60.png')); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo e(asset('admin/assets/favicon/apple-icon-72x72.png')); ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(asset('admin/assets/favicon/apple-icon-76x76.png')); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo e(asset('admin/assets/favicon/apple-icon-114x114.png')); ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo e(asset('admin/assets/favicon/apple-icon-120x120.png')); ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo e(asset('admin/assets/favicon/apple-icon-144x144.png')); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo e(asset('admin/assets/favicon/apple-icon-152x152.png')); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('admin/assets/favicon/apple-icon-180x180.png')); ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo e(asset('admin/assets/favicon/android-icon-192x192.png')); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('admin/assets/favicon/favicon-32x32.png')); ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo e(asset('admin/assets/favicon/favicon-96x96.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('admin/assets/favicon/favicon-16x16.png')); ?>">
    <link href="<?php echo e(asset('css/all.css')); ?>" rel="stylesheet">
        <link rel="manifest" href="<?php echo e(asset('admin/assets/favicon/manifest.json')); ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo e(asset('admin/assets/favicon/ms-icon-144x144.png')); ?>">
    <meta name="theme-color" content="#ffffff">
    <!-- Main styles for this application-->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui@3.0.0-rc.0/dist/css/coreui.min.css">



    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>

</head>
<body class="c-app">
<?php if(auth()->check()): ?>

<div class="c-sidebar c-sidebar-blank c-sidebar-fixed c-sidebar-lg-show" id="sidebar" >
        <div class="c-sidebar-brand d-lg-down-none">
            <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="<?php echo e(asset('admin/assets/brand/coreui.svg#full')); ?>"></use>
            </svg>
            <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
                <use xlink:href="<?php echo e(asset('admin/assets/brand/coreui.svg#signet')); ?>"></use>
            </svg>
        </div>
        <ul class="c-sidebar-nav">
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?php echo e(route('home')); ?>">
              <svg class="c-sidebar-nav-icon">
                  <use xlink:href="<?php echo e(asset('admin/node_modules/@coreui/icons/sprites/free.svg#cil-drop1')); ?>"></use>
              </svg> INICIO</a>

                </a></li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.index')): ?>
                <li class="c-sidebar-nav-title">Administrador</li>

                <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="<?php echo e(asset('admin/node_modules/@coreui/icons/sprites/free.svg#cil-contact')); ?>"></use>
                        </svg> Administrador</a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users.index')): ?>
                            <li class="c-sidebar-nav-item">
                                <a class="c-sidebar-nav-link active" href="<?php echo e(route('usuarios.index')); ?>">
                                <span class="c-sidebar-nav-icon">
                                </span>Usuarios
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission.index')): ?>
                            <li class="c-sidebar-nav-item">
                                <a class="c-sidebar-nav-link active" href="<?php echo e(route('permisos.index')); ?>">
                                <span class="c-sidebar-nav-icon">
                                </span>Permisos
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles.index')): ?>
                            <li class="c-sidebar-nav-item">
                                <a class="c-sidebar-nav-link active" href="<?php echo e(route('roles.index')); ?>">
                                <span class="c-sidebar-nav-icon">
                                </span>Roles
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>

            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('areas.index')): ?>
                <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="<?php echo e(asset('admin/node_modules/@coreui/icons/sprites/free.svg#cil-bank')); ?>"></use>
                        </svg> Areas</a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('departments.index')): ?>
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link" href="<?php echo e(route('departamentos.index')); ?>">
                                <span class="c-sidebar-nav-icon">
                                </span>Departamentos
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('coordinations.index')): ?>
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link" href="<?php echo e(route('coordinaciones.index')); ?>">
                                <span class="c-sidebar-nav-icon">
                                </span>Coordinaciones
                            </a>
                        </li>
                        <?php endif; ?>

                    </ul>
                </li>
            <?php endif; ?>
            <li class="c-sidebar-nav-title">Departamento</li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('requisitions.index')): ?>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link active" href="<?php echo e(route('requisiciones.index')); ?>">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="<?php echo e(asset('admin/node_modules/@coreui/icons/sprites/free.svg#cil-description')); ?>"></use>
                    </svg> Requisiciones</a>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('quotes.index')): ?>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link active" href="<?php echo e(route('cotizaciones.index')); ?>">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="<?php echo e(asset('admin/node_modules/@coreui/icons/sprites/free.svg#cil-storage')); ?>"></use>
                        </svg> Cotizaciones</a>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchase.index')): ?>
                <li class="c-sidebar-nav-item c-sidebar-nav-dropdown c-sidebar-show"><a class="c-sidebar-nav-link c-sidebar-show c-sidebar-nav-dropdown-toggle">
                        <svg class="c-sidebar-nav-icon">
                            
                            <use xlink:href="<?php echo e(asset('admin/node_modules/@coreui/icons/sprites/free.svg#cil-puzzle')); ?>"></use>
                        </svg> Compras</a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        <li class="c-sidebar-nav-item">
                          <a class="c-sidebar-nav-link" href="<?php echo e(route('ordenes.index')); ?>">
                          <span class="c-sidebar-nav-icon"></span>
                          Ordenes de Compras
                          </a>
                        </li>
                        <li class="c-sidebar-nav-item">
                          <a class="c-sidebar-nav-link" href="<?php echo e(route('autorizadas.index')); ?>">
                            <span class="c-sidebar-nav-icon"></span>
                            Ordenes Autorizadas
                          </a>
                        </li>
                        <li class="c-sidebar-nav-item">
                          <a class="c-sidebar-nav-link" href="<?php echo e(route('facturas.index')); ?>">
                            <span class="c-sidebar-nav-icon"></span>
                            Facturas de Compras
                          </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>


            <li class="c-sidebar-nav-divider"></li>
            <li class="c-sidebar-nav-title">Extras</li>

            <li class="c-sidebar-nav-item mt-auto"><a class="c-sidebar-nav-link c-sidebar-nav-link-danger"
                                                      href="<?php echo e(route('logout')); ?>"
                                                      onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();
                                                       "target="_top">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="<?php echo e(asset('admin/node_modules/@coreui/icons/sprites/free.svg#cil-layers')); ?>"></use>
                    </svg> Cerrar Sesión &nbsp;<strong></strong></a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
            </li>
        </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>

<div class="c-wrapper c-fixed-components">
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
            <svg class="c-icon c-icon-lg">
                <use xlink:href="<?php echo e(asset('admin/node_modules/@coreui/icons/sprites/free.svg#cil-menu')); ?>"></use>
            </svg>
        </button><a class="c-header-brand d-lg-none" href="#">
            <svg width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="<?php echo e(asset('admin/assets/brand/smapac.svg#full')); ?>"></use>
            </svg></a>
        <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
            <svg class="c-icon c-icon-lg">
                <use xlink:href="<?php echo e(asset('admin/node_modules/@coreui/icons/sprites/free.svg#cil-menu')); ?>"></use>
            </svg>
        </button>
        <ul class="c-header-nav d-md-down-none">
            <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">
                <?php if(auth()->check()): ?>
                  <?php echo e(Auth::user()->NoEmpleado ." ". Auth::user()->name ."  ". Auth::user()->roles[0]->name); ?>

                    <?php endif; ?>
                </a>
            </li>
        </ul>
         <?php if(auth()->guard()->check()): ?>
        <ul class="c-header-nav ml-auto mr-4">
            
            


            <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="c-avatar"><img class="c-avatar-img" src="<?php echo e(asset('admin/assets/img/avatars/user.png')); ?>" alt="user@email.com"></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right pt-0">
                    <div class="dropdown-header bg-light py-2"><strong>Account</strong></div>
                    <a class="dropdown-item" href="#">
                        <svg class="c-icon mr-2">
                            <use xlink:href="<?php echo e(asset('admin/node_modules/@coreui/icons/sprites/free.svg#cil-user')); ?>"></use>
                        </svg> Cuenta</a>
                        
                        
                        
                    
                     

                    <div class="dropdown-header bg-light py-2"><strong>Configuraciones</strong></div>

                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('requisitions.index')): ?>
                        <a class="dropdown-item" href="<?php echo e(route('requisiciones.list',Auth::user()->id)); ?>">
                        <svg class="c-icon mr-2">
                            <use xlink:href="<?php echo e(asset('admin/node_modules/@coreui/icons/sprites/free.svg#cil-file')); ?>"></use>
                        </svg> Requisiciones<span class="badge badge-primary ml-auto"><?php echo e(auth()->user()->count()); ?></span></a>
                        <?php endif; ?>

                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                           onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        <svg class="c-icon mr-2">
                            <use xlink:href="<?php echo e(asset('admin/node_modules/@coreui/icons/sprites/free.svg#cil-account-logout')); ?>"></use>
                        </svg>                             <?php echo e(__('Cerrar Sesion')); ?>

                        </a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
            </li>
        </ul>

        <?php endif; ?>
            <div class="c-subheader px-3">
                <ol class="breadcrumb border-0 m-0">
                <?php if(auth()->check()): ?>
                   <li class="breadcrumb-item"> <?php echo e(Auth::user()->asignado->areas->departments->name ?? 'Administrador General'); ?></li>
                <?php endif; ?>
                </ol>
            </div>
    </header>
    <?php endif; ?>

    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <?php echo $__env->make('common.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="fade-in">
                    <div class="row">
                    <?php echo $__env->yieldContent('content'); ?>
            </div>
        </main>
    </div>
    <footer class="c-footer">
        <div>&copy;<?php echo e(date('Y')); ?>.Sistema Municipal de Agua Potable y Alcantarillado de Carmen (SMAPAC). H. Ayuntamiento de Carmen. All rights reserved.</div>
    </footer>
</div>
</div>

<!-- CoreUI and necessary plugins-->
<script src="<?php echo e(asset('admin/node_modules/@coreui/coreui/dist/js/coreui.bundle.min.js')); ?>"></script>
<!--[if IE]><!-->
<script src="<?php echo e(asset('admin/node_modules/@coreui/icons/js/svgxuse.min.js')); ?>"></script>
<!--<![endif]-->
<script   src="<?php echo e(asset('/js/alerts.js')); ?>" defer></script>
<!-- Plugins and scripts required by this view-->

 
</body>
</html>
<?php /**PATH C:\xampp\htdocs\PHP\Laravel\urm\resources\views/layouts/CoreUi/app.blade.php ENDPATH**/ ?>