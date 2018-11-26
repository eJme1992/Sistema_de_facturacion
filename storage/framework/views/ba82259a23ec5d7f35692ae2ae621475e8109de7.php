<?php $__env->startSection('title', 'Editar <?php echo e($type); ?>'); ?>
<?php $__env->startSection('content2'); ?>
    <h1 class="mt-5 form-group col-md-12">Editar <?php echo e($type); ?></h1>

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

    <form action="<?php echo e(route('users.update', [$type, $user])); ?>" method="POST">
        <?php echo e(method_field('PUT')); ?>

        <?php echo e(csrf_field()); ?>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputEmail4">Nombre</label>
                <input type="text" class="text-uppercase form-control" name="nombre" value="<?php echo e(old('nombre', $user->nombre)); ?>" >
            </div>

            <div class="form-group col-md-2">
                <label for="inputEmail4">Teléfono</label>
                <input type="number" class="text-uppercase form-control" name="telefono" value="<?php echo e(old('telefono', $user->telefono)); ?>" >
            </div>

            <div class="form-group col-md-2">
                <label for="inputZip">Email</label>
                <input type="email" class="text-uppercase form-control" name="email" value="<?php echo e(old('email', $user->email)); ?>" >
            </div>

            <div class="form-group col-md-2">
                <label for="inputCity">Dirección</label>
                <input type="text" class="text-uppercase form-control" name="direccion" value="<?php echo e(old('direccion', $user->direccion)); ?>" >
            </div>

            <div class="form-group col-md-2">
                <label for="inputState">Fecha de nac.</label>
                <input type="date" class="text-uppercase form-control" name="nacimiento" value="<?php echo e(old('nacimiento', $user->nacimiento)); ?>" >
            </div>

            <?php if($user->id_uType == "1"): ?>
            <div class="form-group col-md-3">
                <label>Password</label>
                <input require type="password" class="text-uppercase form-control" name="password" value="<?php echo e(old('password', $user->password)); ?>" >
            </div>
            <?php else: ?>
            <input type="hidden" name="password" value="<?php echo e(old('password', $user->password)); ?>" >
            <?php endif; ?>
        </div>

        <div class="form-row">
            <input type="hidden" name="id_uType" value="<?php echo e(old('id_uType', $user->id_uType)); ?>" >

            <div class="form-group col-md-2">
                <label>&nbsp;</label>
                <a href="/admin/<?php echo e($type); ?>s" class="btn btn-primary form-control">Volver al listado</a>
            </div>

            <div class="form-group col-md-2">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success form-control">Editar <?php echo e($type); ?></button>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>