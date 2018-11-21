<?php $__env->startSection('content3'); ?>

    <div style="display: flex;">
        <div>
            <h1 style="margin-top: auto;"><?php echo e($titulo); ?></h1>
        </div>
        <?php if($subtitulo != "La orden todavía no existe"): ?>
            <div style="margin-left: auto; margin-top: 3px;">
                <label class="btn btn-success">TOTAL $<?php echo e($order->monto); ?></label>
            </div>
            <div style="margin-top: 3px; margin-left: 5px;">
                <?php if($order->descuento == 0): ?>
                    <?php if($order->completada == 0): ?>
                    <form method="POST" action="/admin/control/<?php echo e($tipo); ?>/descuento/<?php echo e($id_order); ?>">
                        <?php echo csrf_field(); ?>

                        <input class="btn btn-default" type="number" min="0" max="25" name="descuento" placeholder="DESC %" style="width: 105px;">
                    </form>
                    <?php else: ?>
                        <label class="btn btn-default">DESC $<?php echo e($order->descuento); ?></label>
                    <?php endif; ?>
                <?php else: ?>
                    <label class="btn btn-danger">DESC $<?php echo e($order->descuento); ?></label>
                <?php endif; ?>
            </div>
            <div style="margin-top: 3px; margin-left: 5px;">
                <label class="btn btn-warning">MONTO $<?php echo e($order->monto - $order->descuento); ?></label>
            </div>
            <div style="margin-top: 3px; margin-left: 5px;">
                <?php if($order->completada == 1): ?>
                    <?php if(str_contains(URL::previous(), 'clientes')): ?>
                    <a href="<?php echo e(URL::previous()); ?>" class="btn btn-primary"><span class="oi oi-arrow-left"></span> <b>VOLVER</b></a>
                    <?php else: ?>
                    <a href="/admin/control/ingresos/<?php echo e($tipo); ?>" class="btn btn-primary"><span class="oi oi-arrow-left"></span> <b>VOLVER</b></a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <p>
        <h4 class="mt-2 mb-3"><?php echo e($subtitulo); ?></h4>
    </p>

    <?php if($subtitulo != "La orden todavía no existe"): ?>
        <div style="display: flex; margin-top: 0px;">
            <h4 style="margin-top: 10px;color: darkviolet;" class="mt-2 mb-3"><?php echo e($pie); ?></h4>
            <div style="margin-top: 2px; margin-left: auto;">
                <?php if($order->completada != 1): ?>
                    <form method="POST" action="/admin/control/<?php echo e($tipo); ?>/cerrar/<?php echo e($id_order); ?>">
                    <?php echo csrf_field(); ?>

                        <?php if($order->id_forma_pago == 3): ?>
                        <input required class="btn btn-default" type="number" min="0" name="pago_efec" placeholder="Efectivo" style="width: 105px;">
                        <input required class="btn btn-default" type="number" min="0" name="pago_tarj" placeholder="Tarjeta" style="width: 105px;">
                        <?php endif; ?>
                        <input type="hidden" class="form-control" name="completada" value="1">
                        <button type="submit" class="btn btn-danger" style="width: 98px;margin-right: 5px;">Terminar</button>
                    </form>
                <?php endif; ?>
            </div>
            
        </div>

        <div class="card card-body">
            <p>
                <?php if($order->completada != "1"): ?>
                    <form method="POST" action="/admin/control/ingresos/<?php echo e($tipo); ?>/<?php echo e($id_order); ?>">
                        <?php echo csrf_field(); ?>

                        
                        <?php if($id_type == 2): ?>
                            <div class="form-group col-md-3" style="padding-left: 0px;">
                                <label>Servicio</label>
                                <select class="form-control text-uppercase" name="id_servicio" value="<?php echo e(old('id_servicio')); ?>">
                                    <?php $__currentLoopData = $servicios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($servicio->id); ?>"><?php echo e($servicio->nombre); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6" style="padding-left: 0px;">
                                <label>Detalle</label>
                                <input required type="text" maxlength="100" class="form-control text-uppercase" name="detalle" value="<?php echo e(old('detalle')); ?>">
                            </div>
                            
                        <?php else: ?>
                            <div class="form-group col-md-5" style="padding-left: 0px;">
                                <label>Producto</label>
                                <select class="form-control text-uppercase " name="id_producto" value="<?php echo e(old('id_producto')); ?>">
                                    <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($producto->id); ?>"><?php echo e($producto->nombre); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group col-md-2" style="padding-left: 0px;">
                                <label>Cant</label>
                                <input required type="number" min="0" class="form-control" name="cantidad" value="<?php echo e(old('cantidad')); ?>">
                            </div>
                        <?php endif; ?>
                        <input type="hidden" class="form-control" name="id_type" value="<?php echo e($id_type); ?>">
                        <input type="hidden" class="form-control" name="id_order" value="<?php echo e($id_order); ?>">
                        
                        <div class="form-group col-md-2" style="padding-left: 0px;">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-success form-control">Agregar</button>
                        </div>
                    </form>
                <?php endif; ?>
            </p>
        </div>

        <p></p>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <?php if($id_type == 2): ?>
                        <th scope="col">Servicio</th>
                        <th scope="col">Detalle</th>
                    <?php else: ?>
                        <th scope="col">Producto</th>
                        <th scope="col">Cant.</th>
                    <?php endif; ?>
                    <th scope="col">Monto</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    <?php if($order->completada != 1): ?>
                    <th scope="col">Borrar</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orders_indiv; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderind): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="text-uppercase" >
                        <?php if($id_type == 2): ?>
                            <td scope="row">
                                <?php $__currentLoopData = $servicios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($servicio->id == $orderind->id_servicio): ?>
                                        <?php echo e($servicio->nombre); ?>

                                        <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <td><?php echo e($orderind->detalle); ?></td>
                        <?php else: ?>
                            <td scope="row">
                                <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($producto->id == $orderind->id_producto): ?>
                                        <?php echo e($producto->nombre); ?>

                                        <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <td><?php echo e($orderind->cantidad); ?></td>
                        <?php endif; ?>
                        <td><b>$</b> <?php echo e($orderind->monto); ?></td>
                        <td><?php echo e(date('d/m/y', strtotime($orderind->created_at))); ?></td>
                        <td><?php echo e(date('H:i', strtotime($orderind->created_at))); ?> <b>hs</b></td>
                        <?php if($order->completada != 1): ?>
                            <td>
                                
                                <form method="POST" action="/admin/control/ingresos/<?php echo e($tipo); ?>/<?php echo e($id = $orderind->id); ?>">
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
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('control.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>