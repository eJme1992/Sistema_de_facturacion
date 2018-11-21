<?php $__env->startSection('content2'); ?>

    <div class="d-flex justify-content-between align-items-end">
        <h1 class="mt-2 mb-3">Listado de <?php echo e($type); ?>s</h1>
        <p>
            <a href="<?php echo e(route('categories.create')); ?>" class="btn btn-primary">Nueva <?php echo e($type); ?></a>
            <a href="<?php echo e(route('products.index')); ?>" class="btn btn-info">ir a Productos</a>
        </p>
    </div>

    <table class="table">
        <thead class="thead-dark"></thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="text-uppercase">
                    <td><?php echo e($category->nombre); ?></td>
                    <td>
                        <form action="<?php echo e(route('categories.delete', $category)); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('DELETE')); ?>

                            
                            <a href="<?php echo e(route('categories.edit', $category)); ?>" class="btn btn-warning"><span class="oi oi-pencil"></span></a>
                            
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>