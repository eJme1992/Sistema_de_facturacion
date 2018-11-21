<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item">
                          <a class="nav-link active" href="/admin">Inicio</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="/admin/socios">Socios</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="/admin/profesores">Profesores</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="/admin/servicios">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/control">Control de Caja</a>
                        </li>
                    </ul>
                </div>
                <div class="panel-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                
                    <?php echo $__env->yieldContent('content2'); ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>