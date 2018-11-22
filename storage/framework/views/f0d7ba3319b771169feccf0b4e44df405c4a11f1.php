<?php $__env->startSection('content2'); ?>

    <div class="d-flex justify-content-between align-items-end">
        <h1 class="mt-2 mb-3">Listado de <?php echo e($type); ?>s</h1>
        <p>
            <a href="<?php echo e(route('services.create')); ?>" class="btn btn-primary">Nuevo <?php echo e($type); ?></a>
        </p>
    </div>

    <table class="table">
        <thead class="thead-dark"></thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Monto</th>
                <th scope="col">Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="text-uppercase">
                    <td><?php echo e($service->nombre); ?></td>
                    <td><b>$</b> <?php echo e($service->monto); ?></td>
                    <td>
                        <form action="<?php echo e(route('services.delete', $service)); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('DELETE')); ?>

                            
                            <a href="<?php echo e(route('services.edit', $service)); ?>" class="btn btn-warning"><span class="oi oi-pencil"></span></a>
                            
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>