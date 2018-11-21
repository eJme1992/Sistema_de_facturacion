<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <p>
                            You are logged in!
                    </p>
                    <p>
                            Partamos realizando una nueva copia de Laravel 5.5: Fuente de la imagen: 
                            Luego ejecutar el comando php artisan para crear el recurso de autenticación 
                            php artisan make:auth. Crear el modelo Role con su respectiva migración
                    </p>
                    <p>
                            Partamos realizando una nueva copia de Laravel 5.5: Fuente de la imagen: 
                            Luego ejecutar el comando php artisan para crear el recurso de autenticación 
                            php artisan make:auth. Crear el modelo Role con su respectiva migración
                    </p>
                    <p>
                            Partamos realizando una nueva copia de Laravel 5.5: Fuente de la imagen: 
                            Luego ejecutar el comando php artisan para crear el recurso de autenticación 
                            php artisan make:auth. Crear el modelo Role con su respectiva migración
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>