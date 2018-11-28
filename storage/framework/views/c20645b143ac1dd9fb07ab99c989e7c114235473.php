<?php $__env->startSection('content3'); ?>

    <div class="d-flex justify-content-between align-items-end">

        <?php if($titulo == "Gastos de " . $nombre . " del día"): ?>
            <h1 class="mt-2 mb-3"><?php echo e($titulo); ?></h1>
        <?php else: ?>
            <h2 class="mt-2 mb-3"><?php echo e($titulo); ?></h2>
        <?php endif; ?>

        <p>
            <form class="form-inline" method="POST" action="<?php echo e(url('admin/control/')); ?>">
                <?php echo csrf_field(); ?>


                <?php if($titulo == "Gastos de " . $nombre . " del día"): ?>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="hidden" class="form-control" name="admin" value="<?php echo e(Auth::user()->nombre); ?>">
                    <input type="number" required class="form-control" name="monto" placeholder="Cargar gasto">
                    <input type="hidden" class="form-control" name="id_desc" value="<?php echo e($id_desc); ?>">
                    <input type="text" class="form-control" name="detalle" placeholder="Cargar detalle del gasto" value="Gastos de <?php echo e($nombre); ?>">
                    <input type="hidden" class="form-control" name="caja_abierta" value="1">
                </div>

                <button type="submit" class="btn btn-primary mb-2">Cargar</button>
                <?php else: ?>
                <a href="<?php echo e(url('/admin/control/gastos/' . $nombre)); ?>" class="btn btn-primary">Volver</a>
                <?php endif; ?>
                <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Historial
                </button>
            </form>
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <p>
                        <form class="form-inline" method="POST" action="<?php echo e(url('/admin/control/gastos/' . $nombre)); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label> Desde </label>
                                <input required type="date" class="form-control" name="desde">
                            </div>
                            <div class="form-group">
                                <label> Hasta </label>
                                <input required type="date" class="form-control" name="hasta" value="<?php echo e(date("Y-m-d")); ?>">
                            </div>

                            <button type="submit" class="btn btn-success">Buscar</button>
                        </form>
                    </p>
                </div>
            </div>
        </p>
    </div>

    <table class="table">
        <thead class="thead-dark"></thead>
            <tr></tr>
                <th scope="col">#</th>
                <th scope="col">Usuario</th>
                <th scope="col">Detalle</th>
                <th scope="col">Monto</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                <?php if($titulo == "Gastos de " . $nombre . " del día"): ?>
                    <th scope="col">Borrar</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $controls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $control): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="text-uppercase" >
                    <th scope="row"><?php echo e($control->id); ?></th>
                    <td><?php echo e($control->admin); ?></td>
                    <td><?php echo e($control->detalle); ?></td>
                    <td><b>$</b> <?php echo e($control->monto); ?></td>
                    <td><?php echo e(date('d/m/y', strtotime($control->created_at))); ?></td>
                    <td><?php echo e(date('H:i', strtotime($control->created_at))); ?> <b>hs</b></td>
                    <?php if($titulo == "Gastos de " . $nombre . " del día"): ?>
                        <td>
                            <form action="<?php echo e(route('control.delete', [$id = $control->id])); ?>" method="POST">
                                <?php echo e(csrf_field()); ?>

                                <?php echo e(method_field('DELETE')); ?>

                                <button class="btn btn-danger" type="submit">
                                    <span class="oi oi-trash"></span>
                                </button>
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('control.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>