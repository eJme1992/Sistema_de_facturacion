<?php $__env->startSection('title', 'Editar <?php echo e($type); ?>'); ?>
<?php $__env->startSection('content2'); ?>

    <h1 class="mt-5form-group col-md-12">Editar <?php echo e($type); ?></h1>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <p>Por favor, corrige los errores debajo:</p>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" files="true" action="/admin/<?php echo e($type); ?>s/<?php echo e($product->id); ?>" enctype="multipart/form-data">
        <?php echo e(method_field('PUT')); ?>

        <?php echo e(csrf_field()); ?>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Nombre</label>
                <input maxlength="55" type="text" class="text-uppercase form-control" name="nombre" value="<?php echo e(old('nombre', $product->nombre)); ?>" >
            </div>

            <div class="form-group col-md-2">
                <label>Categoria</label>
                <select class="text-uppercase form-control" name="id_categoria" value="<?php echo e(old('id_categoria', $product->id_categoria)); ?>">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($category->id == $product->id_categoria): ?>
                            <option selected value="<?php echo e($category->id); ?>"><?php echo e($category->nombre); ?></option>
                        <?php else: ?>
                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->nombre); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-row">
                <div class="form-group col-md-2">
                    <label>Código de barras</label>
                    <input type="number" min="1" class="text-uppercase form-control" name="codigo" value="<?php echo e(old('codigo', $product->codigo)); ?>" >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1">
                    <label>Agregar</label>
                    <input type="number" min="0" class="text-uppercase form-control" name="pedido" value="0" >
                </div>
            </div>

            <input type="hidden" class="text-uppercase form-control" name="quedan" value="<?php echo e(old('quedan', $product->quedan)); ?>" >

            <div class="form-row">
                <div class="form-group col-md-1">
                    <label>Costo</label>
                    <input class="text-uppercase form-control" name="costo" value="<?php echo e(old('costo', $product->costo)); ?>" >
                </div>
            </div>

            <div class="form-group col-md-1">
                <label>Monto</label>
                <input class="text-uppercase form-control" name="monto" value="<?php echo e(old('monto', $product->monto)); ?>" >
            </div>

            <div class="form-group col-md-1">
                <label>Imagen</label>
                <label class="btn btn-default btn-file col-md-12">
                    Elegir<input type="file" style="display: none;" name="archivo">
                </label>
            </div>

            <div class="form-group col-md-1">
                <label>&nbsp;</label>
                <a href="/admin/<?php echo e($type); ?>s" class="btn btn-primary form-control">Volver</a>
            </div>

            <div class="form-group col-md-1">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success form-control">Editar</button>
            </div>

        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>