<?php $__env->startSection('content2'); ?>
    <h1 class="form-group col-md-12">Crear Socio</h1>
    
    <?php if($errors->any()): ?>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(url('admin/socios')); ?>">
        <?php echo csrf_field(); ?>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputEmail4">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo e(old('nombre')); ?>" >
            </div>
            
            <div class="form-group col-md-2">
                <label for="inputEmail4">Usuario</label>
                <input type="text" class="form-control" name="username" value="<?php echo e(old('username')); ?>" >
            </div>

            <div class="form-group col-md-2">
                <label for="inputZip">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" >
            </div>
    
            <div class="form-group col-md-2">
                <label for="inputPassword4">Password</label>
                <input type="password" class="form-control" name="password" value="<?php echo e(old('password')); ?>" >
            </div>
        
            <div class="form-group col-md-2">
                <label for="inputAddress">DNI</label>
                <input type="number" class="form-control" name="dni" value="<?php echo e(old('dni')); ?>" >
            </div>
    
            <div class="form-group col-md-2">
                <label for="inputCity">Dirección</label>
                <input type="text" class="form-control" name="direccion" value="<?php echo e(old('direccion')); ?>" >
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputState">Fecha de nac.</label>
                <input type="date" class="form-control" name="nacimiento" value="<?php echo e(old('nacimiento')); ?>" >
            </div>
    
            <div class="form-group col-md-1">
                <label for="inputZip">Edad</label>
                <input type="number" class="form-control" name="edad" value="<?php echo e(old('edad')); ?>" >
            </div>
        
            <div class="form-group col-md-1">
                <label for="inputAddress">Peso</label>
                <input type="text" class="form-control" name="peso" value="<?php echo e(old('peso')); ?>" >
            </div>

            <div class="form-group col-md-1">
                <label for="inputCity">Altura</label>
                <input type="number" class="form-control" name="altura" value="<?php echo e(old('altura')); ?>" >
            </div>

            <div class="form-group col-md-2">
                <label for="inputCity">Inicio</label>
                <input type="date" class="form-control" name="inicio" value="<?php echo e(old('inicio')); ?>" >
            </div>

            <div class="form-group col-md-3">
                <label for="inputCity">Profesores</label>
                <select class="form-control" name="profesor_id" value="<?php echo e(old('profesor_id')); ?>">
                    <?php $__currentLoopData = $trainers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($trainer->id); ?>"><?php echo e($trainer->nombre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="inputCity">Servicios</label>
                <select class="form-control" name="servicio_id" value="<?php echo e(old('servicio_id')); ?>">
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($service->id); ?>"><?php echo e($service->nombre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            
            <div class="form-group col-md-2">
                <label>&nbsp;</label>
                <a href="/admin/socios" class="btn btn-primary form-control">Volver</a>
            </div>
            
            <div class="form-group col-md-2">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success form-control">Agregar socio</button>
            </div>
        </div>
    </form>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>