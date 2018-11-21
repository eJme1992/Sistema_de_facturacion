<?php $__env->startSection('title', 'Ver <?php echo e($type); ?>'); ?>
<?php $__env->startSection('content2'); ?>
    <h1 class="mt-5form-group col-md-12">Ver <?php echo e($type); ?></h1>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Nombre</label>
                <input readonly class="text-uppercase form-control" name="nombre" value="<?php echo e($user->nombre); ?>" >
            </div>

            <div class="form-group col-md-2">
                <label>Teléfono</label>
                <input readonly class="text-uppercase form-control" name="telefono" value="<?php echo e($user->telefono); ?>" >
            </div>

            <div class="form-group col-md-2">
                <label>Email</label>
                <input readonly class="text-uppercase form-control" name="email" value="<?php echo e($user->email); ?>" >
            </div>

            <div class="form-group col-md-2">
                <label>Dirección</label>
                <input readonly class="text-uppercase form-control" name="direccion" value="<?php echo e($user->direccion); ?>" >
            </div>

            <div class="form-group col-md-2">
                <label>Fecha de nac.</label>
                <input readonly class="text-uppercase form-control" name="nacimiento" value="<?php echo e(date('d/m/Y', strtotime($user->nacimiento))); ?>" >
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label>&nbsp;</label>
                <a href="/admin/<?php echo e($type); ?>s" class="btn btn-primary text-uppercase form-control">Volver</a>
            </div>
        </div>

    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>