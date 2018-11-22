<?php $__env->startSection('content2'); ?>
    <h1 class="form-group col-md-12">Agregar <?php echo e($userType->nombre); ?></h1>

    <?php if($errors->any()): ?>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>

    <form method="POST" action="/admin/<?php echo e($type); ?>s">
        <?php echo csrf_field(); ?>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Nombre</label>
                <input required type="text" class="text-uppercase form-control" name="nombre" value="<?php echo e(old('nombre')); ?>" >
            </div>

            <div class="form-group col-md-2">
                <label>Teléfono</label>
                <input type="number" class="text-uppercase form-control" name="telefono" placeholder="Sin 0 ni 15" value="<?php echo e(old('telefono')); ?>" >
            </div>

            <div class="form-group col-md-3">
                <label>Email</label>
                <input type="email" class="text-uppercase form-control" name="email" value="<?php echo e(old('email')); ?>" >
            </div>

            <div class="form-group col-md-2">
                <label>Dirección</label>
                <input type="text" class="text-uppercase form-control" name="direccion" value="<?php echo e(old('direccion')); ?>" >
            </div>

            <div class="form-group col-md-2">
                <label>Fecha de nac.</label>
                <input type="date" class="text-uppercase form-control" name="nacimiento" value="<?php echo e(old('nacimiento')); ?>" >
            </div>

            <?php if($userType->nombre == "encargado"): ?>
            <div class="form-group col-md-3">
                <label>Password</label>
                <input required type="password" class="text-uppercase form-control" name="password" value="<?php echo e(old('password')); ?>" >
            </div>
            <?php endif; ?>
        </div>

        <div class="form-row">
            <input type="hidden" name="id_uType" value="<?php echo e($userType->id); ?>" >

            <div class="form-group col-md-3">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success form-control">Agregar <?php echo e($type); ?></button>
            </div>

            <div class="form-group col-md-2">
                <label>&nbsp;</label>
                <a href="/admin/<?php echo e($type); ?>s" class="btn btn-primary form-control">Volver</a>
            </div>
        </div>
    </form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>