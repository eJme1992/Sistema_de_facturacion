<?php $__env->startSection('content3'); ?>
    
    <div class="d-flex justify-content-between align-items-end">
        <h1 class="mt-2 mb-3"><?php echo e($titulo); ?></h1>
        
        <p>
            <form class="form-inline" method="POST" action="<?php echo e(url('admin/control/')); ?>">
                <?php echo csrf_field(); ?>

                
                <?php if($titulo == "Gastos de limpieza del día"): ?>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="hidden" class="form-control" name="admin" value="<?php echo e(Auth::user()->nombre); ?>">
                    <input type="number" required class="form-control" name="monto" placeholder="Cargar gasto">
                    <input type="hidden" class="form-control" name="id_desc" value="3">
                    <input type="text" class="form-control" name="detalle" placeholder="Cargar detalle del gasto" value="Gastos de limpieza">
                    <input type="hidden" class="form-control" name="caja_abierta" value="1">
                </div>
                
                <button type="submit" class="btn btn-primary mb-2">Cargar</button>
                <?php else: ?>
                <a href="<?php echo e(route('control.gastos.limpieza')); ?>" class="btn btn-primary">Volver a gastos de limpieza de hoy</a>
                <?php endif; ?>
                <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Historial
                </button>
            </form>
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <p>
                        <form class="form-inline" method="POST" action="<?php echo e(url('/admin/control/gastos/limpieza')); ?>">
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
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $controls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $control): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($control->id); ?></th>
                    <td><?php echo e($control->admin); ?></td>
                    <td><?php echo e($control->detalle); ?></td>
                    <td><b>$</b> <?php echo e($control->monto); ?></td>
                    <td><?php echo e(date('d-m-Y', strtotime($control->created_at))); ?></td>
                    <td><?php echo e(date('H:i', strtotime($control->created_at))); ?> <b>hs</b></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('control.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>