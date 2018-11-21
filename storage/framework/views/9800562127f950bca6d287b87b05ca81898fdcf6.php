<?php $__env->startSection('content3'); ?>
    
    <script language="javascript">
        function fAgrega()
        {
            [].forEach.call(document.querySelectorAll(".porcS"), function(element, index)
            {
                element.addEventListener("input", function()
                {
                    document.querySelectorAll(".sueldo")[index].value = parseInt(this.value) / 100 * parseInt(document.querySelectorAll(".totalS")[index].value) +  parseInt(document.querySelectorAll(".porcP")[index].value) * parseInt(document.querySelectorAll(".totalP")[index].value) / 100;
                },  false);
            });
            [].forEach.call(document.querySelectorAll(".porcP"), function(element, index)
            {
                element.addEventListener("input", function()
                {
                    document.querySelectorAll(".sueldo")[index].value = parseInt(this.value) / 100 * parseInt(document.querySelectorAll(".totalP")[index].value) +  parseInt(document.querySelectorAll(".porcS")[index].value) * parseInt(document.querySelectorAll(".totalS")[index].value) / 100;
                },  false);
            });
        }
    </script>

    <div class="d-flex justify-content-between align-items-end">
        <?php if($titulo == "Sueldos de " . $tipo): ?>
            <h1 class="mt-2 mb-3"><?php echo e($titulo); ?></h1>
            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Historial
            </button>
        <?php elseif(strpos($titulo, "istorial")): ?>
            <h2 class="mt-2 mb-3"><?php echo e($titulo); ?></h2>
            <a href="<?php echo e(url('/admin/control/sueldos/' . $tipo)); ?>" class="btn btn-primary">Volver</a>
        <?php else: ?>
            <h2 class="mt-2 mb-3"><?php echo e($titulo); ?></h2>
            <a href="<?php echo e(url('/admin/control/sueldos/' . $tipo)); ?>" class="btn btn-primary">Volver</a>
            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Historial
            </button>
        <?php endif; ?> 
        
        <p></p>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <p>
                <form class="form-inline" method="POST" action="<?php echo e(url('/admin/control/sueldos/' . $tipo)); ?>">
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
    <table class="table">
        <thead class="thead-dark"></thead>
            <tr>
                <?php if($titulo == "Sueldos de " . $tipo): ?>
                    <th scope="col">Nombre</th>
                    <th scope="col">$ por Serv</th>
                    <th scope="col">% X Serv</th>
                    <th scope="col">$ por Prod</th>
                    <th scope="col">% X Prod</th>
                    <th scope="col">Sueldo</th>
                    <th scope="col">Pagos</th>
                <?php else: ?>
                    <th scope="col">Detalle</th>
                    <th scope="col">Monto</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if($titulo == "Sueldos de " . $tipo): ?>
                <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="vertical-align: middle;">
                            <?php echo e($empleado->nombre); ?>

                        </td>
                        <td>
                            <?php $totalS=0 ?>
                            <?php $__currentLoopData = $ordenes_serv; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orden_serv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($orden_serv->id_empleado == $empleado->id): ?>
                                    <?php $totalS=$totalS+$orden_serv->monto ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <label class="form-control" style="width: 70px;text-align: center;"><?php echo e($totalS); ?></label>
                            <input type="hidden" class="totalS" value="<?php echo e($totalS); ?>">
                        </td>
                        <td>
                            <?php $porcS=10 ?>
                            <input required type="number" min="7" max="30" id="PorcS" class="form-control porcS" style="width: 60px;" placeholder="Porcentaje" value="<?php echo e($porcS); ?>" onchange="fAgrega();">
                        </td>
                        <td>
                            <?php $totalP=0 ?>
                            <?php $__currentLoopData = $ordenes_prod; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orden_prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($orden_prod->id_empleado == $empleado->id): ?>
                                    <?php $totalP=$totalP+$orden_prod->monto ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <label class="form-control" style="width: 70px;text-align: center;"><?php echo e($totalP); ?></label>
                            <input type="hidden" class="totalP" value="<?php echo e($totalP); ?>">
                        </td>
                        <td>
                            <?php $porcP=10 ?>
                            <input required type="number" min="7" max="30" id="PorcP" class="form-control porcP" style="width: 60px;" placeholder="Porcentaje" value="<?php echo e($porcP); ?>" onchange="fAgrega();">
                        </td>
                        <td>
                            <form class="form-inline" name="myForm" method="POST" action="<?php echo e(url('admin/control/')); ?>">
                                <?php echo csrf_field(); ?>

                                
                                <input id="Sueldo" style="width: 65px;" required class="form-control sueldo" name="monto" placeholder="Sueldo" value="<?php echo e(($porcP*$totalP/100)+($porcS*$totalS/100)); ?>">
                                <input type="hidden" name="admin" value="<?php echo e(Auth::user()->nombre); ?>">
                                <input type="hidden" name="id_desc" value="5">
                                <input type="hidden" name="detalle" value="Pago de sueldo a <?php echo e($empleado->nombre); ?>">
                                <input type="hidden" name="caja_abierta" value="1">
                                <button type="submit" class="btn btn-primary mb-2">Pagar</button>
                            </form>
                        </td>
                        <td>
                            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample<?php echo e($empleado->id); ?>" aria-expanded="false" aria-controls="collapseExample">
                                <span class="oi oi-clock"></span>
                            </button>
                        </td>
                    </tr>
                    <tr class="collapse" id="collapseExample<?php echo e($empleado->id); ?>">
                        <td class="col-xs-10" colspan="7" >
                            <form class="form-inline" method="POST" action="<?php echo e(url('/admin/control/sueldos/' . $tipo . '/'. $empleado->nombre)); ?>">
                                <?php echo csrf_field(); ?>

                                <div class="form-group">
                                    <label>Historial de sueldos para <?php echo e($empleado->nombre); ?> desde</label>
                                    <input type="hidden" name="profesor" value="<?php echo e($empleado->nombre); ?>">
                                    <input required type="date" class="form-control" name="desde">
                                </div>
                                <div class="form-group">
                                    <label>hasta</label>
                                    <input required type="date" class="form-control" name="hasta" value="<?php echo e(date("Y-m-d")); ?>">
                                </div>
                                                
                                <button type="submit" class="btn btn-success">Buscar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <?php $__currentLoopData = $controls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $control): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($control->detalle); ?></td>
                    <td><b>$ </b><?php echo e($control->monto); ?></td>
                    <td><?php echo e(date('d/m/y', strtotime($control->created_at))); ?></td>
                    <td><?php echo e(date('H:i', strtotime($control->created_at))); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('control.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>