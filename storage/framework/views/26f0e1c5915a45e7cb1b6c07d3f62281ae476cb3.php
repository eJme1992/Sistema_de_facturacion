<?php $__env->startSection('content3'); ?>
    
    <script language="javascript">
        function fAgrega()
        {
            [].forEach.call(document.querySelectorAll(".porc"), function(element, index)
            {
                element.addEventListener("input", function()
                {
                    document.querySelectorAll(".sueldo")[index].value = this.value*document.querySelectorAll(".total")[index].value/100;
                }, false);
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
                <th scope="col">#</th>
                <?php if($titulo == "Sueldos de " . $tipo): ?>
                    <th scope="col">Nombre</th>
                    <th scope="col">Alumnos</th>
                    <th scope="col">Total $</th>
                    <th scope="col">Porc. %</th>
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
                <?php $__currentLoopData = $trainers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th scope="row"><?php echo e($trainer->id); ?></th>
                        <td>
                            <?php echo e($trainer->nombre); ?>

                        </td>
                        <td>
                            <?php $i=0; $total=0 ?>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($user->profesor_id == $trainer->id): ?>
                                    <?php ++$i ?>
                                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($service->id == $user->servicio_id): ?>
                                            <?php $total=$total+$service->monto ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($i>0): ?>
                                <b class="btn btn-success"><?php echo e($i); ?> <span class="oi oi-people"></span></b>
                            <?php else: ?>
                                <b class="btn btn-default" disabled><?php echo e($i); ?> <span class="oi oi-people"></span></b>
                            <?php endif; ?>
                        </td>
                        <td>
                            <label style="width: 75px;" class="form-control"><?php echo e($total); ?></label>
                            <input type="hidden" id="Total" class="form-control total" value="<?php echo e($total); ?>" >
                        </td>
                        <td>
                            <?php $porc=30 ?>
                            <input type="number" id="Porc" class="form-control porc" style="width: 60px;" placeholder="Porcentaje" value="<?php echo e($porc); ?>" onchange="fAgrega();">
                        </td>
                        <td>
                            <form class="form-inline" name="myForm" method="POST" action="<?php echo e(url('admin/control/')); ?>">
                                <?php echo csrf_field(); ?>

                                
                                <input id="Sueldo" style="width: 65px;" required class="form-control sueldo" name="monto" placeholder="Sueldo" value="<?php echo e($porc*$total/100); ?>">
                                <input type="hidden" name="admin" value="<?php echo e(Auth::user()->nombre); ?>">
                                <input type="hidden" name="id_desc" value="5">
                                <input type="hidden" name="detalle" value="Pago de sueldo a <?php echo e($trainer->nombre); ?> (<?php echo e($i); ?> socios / $<?php echo e($total); ?>)">
                                <input type="hidden" name="caja_abierta" value="1">
                                <button type="submit" class="btn btn-primary mb-2">Pagar</button>
                            </form>
                        </td>
                        <td>
                            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample<?php echo e($trainer->id); ?>" aria-expanded="false" aria-controls="collapseExample">
                                <span class="oi oi-clock"></span>
                            </button>
                        </td>
                    </tr>
                    <tr class="collapse" id="collapseExample<?php echo e($trainer->id); ?>">
                        <td class="col-xs-10" colspan="7" >
                            <form class="form-inline" method="POST" action="<?php echo e(url('/admin/control/sueldos/' . $tipo . '/'. $trainer->nombre)); ?>">
                                <?php echo csrf_field(); ?>

                                <div class="form-group">
                                    <label>Historial de sueldos para <?php echo e($trainer->nombre); ?> desde</label>
                                    <input type="hidden" name="profesor" value="<?php echo e($trainer->nombre); ?>">
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
                    <th scope="row"><?php echo e($control->id); ?></th>
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