<?php $__env->startSection('title', 'Ver Profesor'); ?>
<?php $__env->startSection('content2'); ?>
    <h1 class="mt-5form-group col-md-12">Ver Profesor</h1>
    
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Nombre</label>
                <input readonly class="form-control" name="nombre" value="<?php echo e($trainer->nombre); ?>" >
            </div>
                
            <div class="form-group col-md-2">
                <label>Teléfono</label>
                <input readonly class="form-control" name="telefono" value="<?php echo e($trainer->telefono); ?>" >
            </div>
    
            <div class="form-group col-md-2">
                <label>Email</label>
                <input readonly class="form-control" name="email" value="<?php echo e($trainer->email); ?>" >
            </div>
        
            <div class="form-group col-md-2">
                <label>Dirección</label>
                <input readonly class="form-control" name="direccion" value="<?php echo e($trainer->direccion); ?>" >
            </div>
        </div>
    
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Fecha de nac.</label>
                <input readonly class="form-control" name="nacimiento" value="<?php echo e(date('d/m/Y', strtotime($trainer->nacimiento))); ?>" >
            </div>
        
            <div class="form-group col-md-2">
                <label>Inicio</label>
                <input readonly class="form-control" name="inicio" value="<?php echo e(date('d/m/Y', strtotime($trainer->inicio))); ?>" >
            </div>
    
            <div class="form-group col-md-3">
                <label>&nbsp;</label>
                <a href="/admin/profesores" class="btn btn-primary form-control">Volver al listado de profesores</a>
            </div>
                
        </div>
    </form>        
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>