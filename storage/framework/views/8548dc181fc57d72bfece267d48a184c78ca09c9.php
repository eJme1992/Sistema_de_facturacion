<?php $__env->startSection('title', 'Editar Servicio'); ?>
<?php $__env->startSection('content2'); ?>
    <h1 class="mt-5form-group col-md-12">Editar servicio</h1>
    
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <p>Por favor, corrige los errores debajo</p>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <form method="POST" action="<?php echo e(url("admin/servicios/{$service->id}")); ?>">
        <?php echo e(method_field('PUT')); ?>

        <?php echo e(csrf_field()); ?>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo e(old('nombre', $service->nombre)); ?>" >
            </div>

            <div class="form-group col-md-3">
                <label>Monto</label>
                <input type="number" class="form-control" name="monto" value="<?php echo e(old('monto', $service->monto)); ?>" >
            </div>
        
            <div class="form-group col-md-3">
                <label>&nbsp;</label>
                <a href="/admin/servicios" class="btn btn-primary form-control">Volver</a>
            </div>
                
            <div class="form-group col-md-3">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success form-control">Editar servicio</button>
            </div>
        </div>
    </form>        
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>