<?php $__env->startSection('content2'); ?>
    
    <div class="d-flex justify-content-between align-items-end">
        <h1 class="mt-2 mb-3"><?php echo e($titulo); ?></h1>
        <p>
            <a href="<?php echo e(route('trainers.create')); ?>" class="btn btn-primary">Nuevo Profesor</a>
        </p>
    </div>
    
    <table class="table">
        <thead class="thead-dark"></thead>
          <tr></tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Teléfono</th>
            <th scope="col">E-Mail</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $trainers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?php echo e($trainer->id); ?></th>
                <td><?php echo e($trainer->nombre); ?></td>
                <td><?php echo e($trainer->telefono); ?></td>
                <td><?php echo e($trainer->email); ?></td>
                <td>
                    <form action="<?php echo e(route('trainers.delete', $trainer)); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('DELETE')); ?>

                        <a href="<?php echo e(route('trainers.show', $trainer)); ?>" class="btn btn-success"><span class="oi oi-eye"></span></a>
                        <a href="<?php echo e(route('trainers.edit', $trainer)); ?>" class="btn btn-warning"><span class="oi oi-pencil"></span></a>
                        <button class="btn btn-danger" type="submit"><span class="oi oi-trash"></span></button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>