<?php $__env->startSection('content2'); ?>

    <div class="d-flex justify-content-between align-items-end">
        <?php if($activos == true): ?>
        <h1 class="mt-2 mb-3">Listado de <?php echo e($type); ?>s</h1>
        <?php else: ?>
        <h1 class="mt-2 mb-3">Listado de <?php echo e($type); ?>s borrados</h1>
        <?php endif; ?>
        <p>
            <?php if($activos == true): ?>
            <a href="/admin/<?php echo e($type); ?>s/nuevo" class="btn btn-primary">Nuevo <?php echo e($type); ?></a>
            <a href="/admin/<?php echo e($type); ?>s/papelera" class="btn btn-danger"><span class="oi oi-trash"></span> Papelera</a>
            <?php else: ?>
            <a href="/admin/<?php echo e($type); ?>s" class="btn btn-primary">Volver</a>
            <?php endif; ?>
        </p>
    </div>

    <table class="table">

        <thead class="thead-dark"></thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Teléfono</th>
                <th scope="col">E-Mail</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($activos == false): ?>
                <tr style="background-color: #ff8e8e;">
                <?php else: ?>
                <tr class="text-uppercase" >
                <?php endif; ?>
                    <td><?php echo e($user->nombre); ?></td>
                    <td><?php echo e($user->telefono); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td>
                        <?php if($user->activo == 1): ?>
                            <form action="<?php echo e(route('users.delete', [$type, $user])); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('DELETE')); ?>

                            <a href="<?php echo e(route('users.show', [$type, $nombre = $user->nombre])); ?>" class="btn btn-success"><span class="oi oi-eye"></span></a>
                            <a href="<?php echo e(route('users.edit', [$type, $nombre = $user->nombre])); ?>" class="btn btn-warning"><span class="oi oi-pencil"></span></a>
                            <button class="btn btn-danger" type="submit"><span class="oi oi-trash"></span></button>
                            <?php if($user->id_uType == 3): ?>
                            <a href="<?php echo e(route('users.record', [$nombre = $user->nombre])); ?>" class="btn btn-info"><span class="oi oi-clock"></span></a>
                            <?php endif; ?>
                            </form>
                        <?php else: ?>
                        <form action="<?php echo e(route('users.resurrect', [$type, $user])); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('DELETE')); ?>

                            <button class="btn btn-danger" type="submit"><span class="oi oi-action-undo"></span> Recuperar</button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>