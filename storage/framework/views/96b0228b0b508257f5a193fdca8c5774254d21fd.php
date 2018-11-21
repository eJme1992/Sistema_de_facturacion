<?php $__env->startSection('content2'); ?>

    <div class="d-flex justify-content-between align-items-end">

        <?php if($titulo == "Historial para " . $nombre .  " (Últimos 6 meses)"): ?>
            <h1 class="mt-2 mb-3"><?php echo e($titulo); ?></h1>
        <?php else: ?>
            <h2 class="mt-2 mb-3"><?php echo e($titulo); ?></h2>
        <?php endif; ?>
        <a href="/admin/clientes" class="btn btn-primary col-md-1">Volver</a>
        <button style="margin-left: 4px;" class="btn btn-info" data-toggle="collapse" data-target="#collapseExample2">
            Búsqueda
        </button>
        <div class="collapse indent" id="collapseExample2">
            <div class="card card-body">
                <p>
                    <form class="form-inline" method="POST" action="<?php echo e(url('/admin/clientes/'.$nombre.'/historial')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <label> Desde </label>
                            <input required type="date" class="text-uppercase form-control" name="desde" value="<?php echo e(date("Y-m-d")); ?>">
                        </div>
                        <div class="form-group">
                            <label> Hasta </label>
                            <input required type="date" class="text-uppercase form-control" name="hasta" value="<?php echo e(date("Y-m-d")); ?>">
                        </div>

                        <button type="submit" class="btn btn-success">Buscar</button>

                    </form>
                </p>
            </div>
        </div>
    </div>

    <p></p>

    <table class="table">
        <thead class="thead-dark"></thead>
            <tr>
                <th scope="col">Atendió</th>
                <th scope="col">Orden</th>
                <th scope="col">Tipo</th>
                <th scope="col">Pago con</th>
                <th scope="col">Monto</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                <th scope="col">Ver</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="text-uppercase" >
                    <td>
                        <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($empleado->id == $order->id_empleado): ?>
                                <?php echo e($empleado->nombre); ?>

                                <?php break; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>#<?php echo e($order->id); ?></td>
                    <td>
                        <?php $__currentLoopData = $orderTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipoOrden): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($tipoOrden->id == $order->id_type): ?>
                                <?php echo e($tipoOrden->nombre); ?>

                                <?php break; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <?php $__currentLoopData = $formasPago; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formaPago): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($formaPago->id == $order->id_forma_pago): ?>
                                <?php echo e($formaPago->nombre); ?>

                                <?php break; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td><b>$</b> <?php echo e($order->monto - $order->descuento); ?></td>
                    <td><?php echo e(date('d/m/y', strtotime($order->created_at))); ?></td>
                    <td><?php echo e(date('H:i', strtotime($order->created_at))); ?> <b>hs</b></td>
                    <td><a href="/admin/control/ingresos/<?php echo e($tipoOrden->nombre); ?>/<?php echo e($order->id); ?>" class="btn btn-success"><span class="oi oi-eye"></span></a></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>