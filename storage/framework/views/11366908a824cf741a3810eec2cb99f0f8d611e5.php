<?php $__env->startSection('content2'); ?>
    
    <div class="d-flex justify-content-between align-items-end">
        <h1 class="mt-2 mb-3"><?php echo e($titulo); ?></h1>
        <p>
            <a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary">Nuevo Socio</a>
        </p>
    </div>
    
    <table class="table">
        <thead class="thead-dark"></thead>
          <tr></tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Profesor</th>
            <th scope="col">Servicio</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($user->id); ?></th>
                    <td><?php echo e($user->nombre); ?></td>
                    <td>
                        <?php $__currentLoopData = $trainers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($trainer->id == $user->profesor_id): ?>
                                <?php echo e($trainer->nombre); ?>

                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($service->id == $user->servicio_id): ?>
                                <?php echo e($service->nombre); ?>

                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <td>
                        <form action="<?php echo e(route('users.delete', $user)); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('DELETE')); ?>

                            <a href="<?php echo e(route('users.show', $user)); ?>" class="btn btn-success"><span class="oi oi-eye"></span></a>
                            <a href="<?php echo e(route('users.edit', $user)); ?>" class="btn btn-warning"><span class="oi oi-pencil"></span></a>
                            <button class="btn btn-danger" type="submit"><span class="oi oi-trash"></span></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>