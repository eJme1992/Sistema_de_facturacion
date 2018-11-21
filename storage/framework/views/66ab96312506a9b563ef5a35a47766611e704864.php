<?php $__env->startSection('content2'); ?>

<div id="wrapper">

    <!-- Navigation -->
    <!-- /.navbar-header -->
        <div class="sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw">
                        </i> Caja<span class="fa arrow"></span></a>
                        
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Caja Inicial</a>
                            </li>
                            
                            <li>
                                <a href="#">Retiros</a>
                            </li>
                        </ul>
                        
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw">
                        </i> Gastos<span class="fa arrow"></span></a>
                            
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Limpieza</a>
                            </li>
                            
                            <li>
                                <a href="#">Servicios</a>
                            </li>
                        </ul>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw">
                        </i> Empleados<span class="fa arrow"></span></a>
                        
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Profesores</a>
                            </li>
                            
                            <li>
                                <a href="#">Otros</a>
                            </li>
                        </ul>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw">
                        </i> Movimientos</a>
                            
                            
                </ul>
            </div>
        </div>
    <!-- Page Content -->
    <div id="page-wrapper">
        <h1>Blank</h1>
    </div>
</div>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>