<?php $__env->startSection('title', 'Ver Usuario'); ?>
<?php $__env->startSection('content2'); ?>
    <h1 class="mt-5form-group col-md-12">Ver Socio</h1>
    
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Nombre</label>
                <input readonly class="form-control" name="nombre" value="<?php echo e($user->nombre); ?>" >
            </div>
                
            <div class="form-group col-md-2">
                <label>Usuario</label>
                <input readonly class="form-control" name="username" value="<?php echo e($user->username); ?>" >
            </div>
    
            <div class="form-group col-md-2">
                <label>Email</label>
                <input readonly class="form-control" name="email" value="<?php echo e($user->email); ?>" >
            </div>
        
            <div class="form-group col-md-2">
                <label>Password</label>
                <input type="password" readonly class="form-control" name="password" value="<?php echo e($user->password); ?>" >
            </div>
        
            <div class="form-group col-md-2">
                <label>DNI</label>
                <input readonly class="form-control" name="dni" value="<?php echo e($user->dni); ?>" >
            </div>
    
            <div class="form-group col-md-2">
                <label>Dirección</label>
                <input readonly class="form-control" name="direccion" value="<?php echo e($user->direccion); ?>" >
            </div>
        </div>
    
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Fecha de nac.</label>
                <input readonly class="form-control" name="nacimiento" value="<?php echo e(date('d/m/Y', strtotime($user->nacimiento))); ?>" >
            </div>
        
            <div class="form-group col-md-1">
                <label>Edad</label>
                <input readonly class="form-control" name="edad" value="<?php echo e($user->edad); ?>" >
            </div>
            
            <div class="form-group col-md-1">
                <label>Peso</label>
                <input readonly class="form-control" name="peso" value="<?php echo e($user->peso); ?>" >
            </div>
    
            <div class="form-group col-md-1">
                <label>Altura</label>
                <input readonly class="form-control" name="altura" value="<?php echo e($user->altura); ?>" >
            </div>
    
            <div class="form-group col-md-2">
                <label>Inicio</label>
                <input readonly class="form-control" name="inicio" value="<?php echo e(date('d/m/Y', strtotime($user->inicio))); ?>" >
            </div>
    
            <div class="form-group col-md-2">
                <label>Profesor</label>
                <?php $__currentLoopData = $trainers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($trainer->id == $user->profesor_id): ?>
                        <input readonly class="form-control" name="profesor_id" value="<?php echo e($trainer->nombre); ?>">
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="form-group col-md-2">
                <label>Servicio</label>
                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($service->id == $user->servicio_id): ?>
                        <input readonly class="form-control" name="servicio_id" value="<?php echo e($service->nombre); ?>">
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
                
            <div class="form-group col-md-1">
                <label>&nbsp;</label>
                <a href="/admin/socios" class="btn btn-primary form-control">Volver</a>
            </div>
                
        </div>
    </form>        
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>