<?php $__env->startSection('content3'); ?>
<div style="display: flex;">
    <div>
        <h1 style="margin-top: auto;"><?php echo e($titulo); ?></h1>
    </div>
    <?php if($subtitulo != "La orden todavía no existe"): ?>
    <div style="margin-top: 3px; margin-left: auto;">
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
                    <option value="<?php echo e($servicio->id); ?>"><?php echo e($servicio->nombre); ?> - $<?php echo e($servicio->monto); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group col-md-5" style="padding-left: 0px;">
                <label>Detalle</label>
                <input required type="text" maxlength="100" class="form-control text-uppercase" name="detalle" value="<?php echo e(old('detalle')); ?>">
            </div>
            <div class="form-group col-md-2" style="padding-left: 0px;">
                <label>% Descuento</label>
                <input required type="number" min="0" max="50" class="form-control" name="descuento1" value="0">
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
            <th scope="col">% Desc.</th>
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
            <td> <?php echo e($orderind->descuento); ?><b>%</b></td>
            <td><?php echo e(date('d/m/y', strtotime($orderind->created_at))); ?></td>
            <td><?php echo e(date('H:i', strtotime($orderind->created_at))); ?> <b class="text-lowercase" >hs</b></td>
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
    <!-- DD-->
    <div style="display: flex; margin-top:40px">
        <div style="margin-top: 3px; margin-left: 5px;">
            <?php if($order->descuento == 0): ?>
            <?php if($order->completada == 0): ?>
            
            
                <div class="col-md-12 col-md-offset-11">
                    <table class="table col-md-offset-11">
                        <tr>
                            <td class="text-left" ><h4>Subtotal: </h4> </td>
                            <td class="text-left" ><h4>$ <?php echo e($order->monto); ?></h4></td>
                        </tr>
                        <tr>
                            <td class="text-left" style="vertical-align: middle;"  ><h4 >Descuento: %</h4> </td>
                            <td class="text-left" ><h4 class="text-success" >
                                <form method="POST" action="/admin/control/<?php echo e($tipo); ?>/descuento/<?php echo e($id_order); ?>">
                                    <?php echo csrf_field(); ?>

                                    <div class="form-group col-md-4" style="padding-left: 0px;">
                                        <input class="btn btn-default" type="number" min="0" max="50" name="descuento" placeholder="Desc %" value="0" style="width: 70px;">
                                    </div>
                                    <div class="form-group col-md-8" >
                                        <button type="submit" style="display:none" ></button>
                                    </div>
                                </form>
                            </h4></td>
                        </tr>
                        <tr>
                            <td class="text-left" ><h4>Total:</h4></td>
                            <td class="text-left" ><h4>$ <?php echo e($order->monto - $order->descuento); ?></h4> </td>
                        </tr>
                    </table>
                    <?php else: ?>
                    <div class="col-md-12 col-md-offset-12">
                        <div class="col-md-12 col-md-offset-12">
                            <table class="table col-md-offset-12">
                                <tr>
                                    <td class="text-left" ><h4>Subtotal:</h4> </td>
                                    <td class="text-left" ><h4> $ <?php echo e($order->monto); ?></h4></td>
                                </tr>
                                <tr>
                                    <td class="text-left" style="vertical-align: middle;"   ><h4>Descuento: </h4> </td>
                                    <td class="text-left" ><h4>$ <?php echo e($order->descuento); ?>

                                    </h4> </span>
                                </button></td>
                            </tr>
                            <tr>
                                <td class="text-left" ><h4>Total: </h4></td>
                                <td class="text-left" ><h4>$ <?php echo e($order->monto - $order->descuento); ?></h4> </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php endif; ?>
                <?php else: ?>
                <div class="col-md-12 col-md-offset-6">
                    <div class="col-md-12 col-md-offset-5">
                        <table class="table col-md-offset-5">
                            <tr>
                                <td class="text-left" ><h4>Subtotal:</h4> </td>
                                <td class="text-left" ><h4> $ <?php echo e($order->monto); ?></h4></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-left" style="vertical-align: middle;"   ><h4><?php echo e($order->descuento); ?>% OFF Descuento: </h4> </td>
                                <td class="text-left" ><h4>$ <?php echo e(ceil(($order->monto * ($order->descuento /100)))); ?>

                                </h4> </td>
                                <td style="vertical-align: middle;">
                                    <form method="POST" action="/admin/control/<?php echo e($tipo); ?>/<?php echo e($id_order); ?>">
                                        <?php echo csrf_field(); ?>


                                        <button class="btn btn-danger" type="submit">
                                        <span class="oi oi-trash"></span>
                                        </button>

                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left" ><h4>Total: </h4></td>
                                <td class="text-left" ><h4>$ <?php echo e(ceil($order->monto - ($order->monto * ($order->descuento /100)))); ?></h4> </td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
    </div>
</div>
<!-- ACA EMPIEZA EL PROCESADOR DE PAGOS-->
<div class="modal-footer" style="display: flex; margin-top: 0px;">
    <div style="margin-top: 2px; margin-left: auto;" class="col-md-9">
        <?php if($order->completada != 1): ?>
        <form method="POST" action="/admin/control/<?php echo e($tipo); ?>/cerrar/<?php echo e($id_order); ?>">
            <div class="col-md-6" style="display: flex; margin-top: 15px; margin-left: -2%;">
                <h4 style="margin-top: 10px;color: darkviolet; display:" class="mt-2 mb-3"><?php echo e($pie); ?></h4>
                <div class="form-group " style="padding-left: 0px;">
                    <select class="form-control text-uppercase" id="id_forma_pago" name="id_forma_pago" value="<?php echo e(old('id_forma_pago')); ?>">
                        <?php $__currentLoopData = $formasPago; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formaPago): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($formaPago->id); ?>"><?php echo e($formaPago->nombre); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <?php echo csrf_field(); ?>

            <div class="col-md-6">
                <div class="ocultar" id="op" style="display: inline; margin-bottom:15px; padding-bottom:15px;">
                    <input required disabled="" class="btn btn-default " type="number" min="0" name="pago_efec" id="pago_efec" placeholder="Efectivo" style="width: 105px;">
                    <input required disabled="" class="btn btn-default" type="number" min="0" name="pago_tarj" id="pago_tarj" placeholder="Tarjeta" style="width: 105px;">
                    <input required disabled="" class="btn btn-default" type="number" min="0" name="numero_de_tarjeta" id="numero_de_tarjeta" placeholder="ultimos 4 numeros de la tarjeta" style="width: 105px;">
                </div>
                <input type="hidden" class="form-control" name="completada" value="1">
                <button type="submit" class="btn btn-danger btn-block" style="width: 98px;margin-right: 5px; margin-top:15px;width: 100%;">Terminar</button>
            </div>
        </form>
        <?php endif; ?>
    </div>
    
</div>
<?php endif; ?>
<script type="text/javascript">
$( document ).ready(function() {
$("#id_forma_pago").change(function (event) {
var id = $("#id_forma_pago").find(':selected').val();
if(id == 3){
$("#pago_efec").prop('disabled', false);
$("#pago_tarj").prop('disabled', false);
$("#numero_de_tarjeta").prop('disabled', false);
document.getElementById("op").className -= " ocultar";
}else{
$("#pago_efec").prop('disabled', true);
$("#pago_tarj").prop('disabled', true);
$("#numero_de_tarjeta").prop('disabled', true);
document.getElementById("op").className += " ocultar";
}
});
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('control.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>