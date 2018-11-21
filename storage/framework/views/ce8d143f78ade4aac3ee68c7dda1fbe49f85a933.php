<?php $__env->startSection('content3'); ?>
    
    <div class="d-flex justify-content-between align-items-end">
        
        <?php if($titulo == "Cuotas de " . $tipo): ?>
            <h1 class="mt-2 mb-3"><?php echo e($titulo); ?></h1>
            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Historial
            </button>
        <?php elseif(strpos($titulo, "para")): ?>
            <h2 class="mt-2 mb-3"><?php echo e($titulo); ?></h2>
            <a href="<?php echo e(url('/admin/control/caja/' . $tipo)); ?>" class="btn btn-primary">Volver</a>
        <?php else: ?>
            <h2 class="mt-2 mb-3"><?php echo e($titulo); ?></h2>
            <a href="<?php echo e(url('/admin/control/caja/' . $tipo)); ?>" class="btn btn-primary">Volver</a>
            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Historial
            </button>
        <?php endif; ?> 
        
        <p></p>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <p>
                <form class="form-inline" method="POST" action="<?php echo e(url('/admin/control/caja/ingresos')); ?>">
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
                
                <?php if($titulo == "Cuotas de " . $tipo): ?>
                    <th scope="col">Nombre</th>
                    <th scope="col">Servicio</th>
                    <th scope="col">Monto</th>
                    <th scope="col">Inicio</th>
                    <th scope="col">Último</th>
                
                <?php else: ?> 
                    <th scope="col">Detalle</th>
                    <th scope="col">Monto</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            
            <?php if($titulo == "Cuotas de " . $tipo): ?>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th scope="row"><?php echo e($user->id); ?></th>
                        <td>
                            <?php echo e($user->nombre); ?>

                        </td>
                        <td>
                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($service->id == $user->servicio_id): ?>
                                    <?php $monto=$service->monto ?>
                                    <?php echo e($service->nombre); ?>

                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td>
                            <form class="form-inline" name="myForm" method="POST" action="<?php echo e(url('admin/control/')); ?>">
                                <?php echo csrf_field(); ?>

                                
                                <input style="width: 65px;" required class="form-control" name="monto" placeholder="Cuota" value="<?php echo e($monto); ?>">
                                <input type="hidden" name="admin" value="<?php echo e(Auth::user()->nombre); ?>">
                                <input type="hidden" name="id_desc" value="2">
                                <input type="hidden" name="detalle" value="Cobro de cuota a <?php echo e($user->nombre); ?>">
                                <input type="hidden" name="caja_abierta" value="1">
                                <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
                                <input type="hidden" name="paid_at" value="<?php echo e(date('Y-m-d')); ?>">
                                <button type="submit" class="btn btn-success mb-2">Cobrar</button>
                            </form>
                        </td>
                        <td><?php echo e(date('d/m/y', strtotime($user->created_at))); ?></td>
                        <td><?php echo e(date('d/m/y', strtotime($user->paid_at))); ?></td>
                        <td>
                            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample<?php echo e($user->id); ?>" aria-expanded="false" aria-controls="collapseExample">
                                <span class="oi oi-clock"></span>
                            </button>
                        </td>
                    </tr>
                    <tr class="collapse" id="collapseExample<?php echo e($user->id); ?>">
                        <td class="col-xs-10" colspan="7" >
                            <form class="form-inline" method="POST" action="<?php echo e(url('/admin/control/caja/ingresos/'. $user->nombre)); ?>">
                                <?php echo csrf_field(); ?>

                                <div class="form-group">
                                    <label>Historial de cuotas para <?php echo e($user->nombre); ?> desde</label>
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