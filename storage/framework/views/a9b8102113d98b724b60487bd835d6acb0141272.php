<?php $__env->startSection('title', 'Editar Profesor'); ?>
<?php $__env->startSection('content2'); ?>
    <h1 class="mt-5form-group col-md-12">Editar profesor</h1>
    
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
    
    <form method="POST" action="<?php echo e(url("admin/profesores/{$trainer->id}")); ?>">
        <?php echo e(method_field('PUT')); ?>

        <?php echo e(csrf_field()); ?>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo e(old('nombre', $trainer->nombre)); ?>" >
            </div>

            <div class="form-group col-md-2">
                <label for="inputEmail4">Teléfono</label>
                <input type="text" class="form-control" name="telefono" value="<?php echo e(old('telefono', $trainer->telefono)); ?>" >
            </div>
    
            <div class="form-group col-md-2">
                <label for="inputZip">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo e(old('email', $trainer->email)); ?>" >
            </div>
        
            <div class="form-group col-md-2">
                <label for="inputCity">Dirección</label>
                <input type="text" class="form-control" name="direccion" value="<?php echo e(old('direccion', $trainer->direccion)); ?>" >
            </div>
        </div>
    
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputState">Fecha de nac.</label>
                <input type="date" class="form-control" name="nacimiento" value="<?php echo e(old('nacimiento', $trainer->nacimiento)); ?>" >
            </div>
        
            <div class="form-group col-md-2">
                <label for="inputCity">Inicio</label>
                <input type="date" class="form-control" name="inicio" value="<?php echo e(old('inicio', $trainer->inicio)); ?>" >
            </div>
    
            <div class="form-group col-md-6">
                <label>&nbsp;</label>
                <a href="/admin/profesores" class="btn btn-primary form-control">Volver</a>
            </div>
                
            <div class="form-group col-md-6">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success form-control">Editar profesor</button>
            </div>
        </div>
    </form>        
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>