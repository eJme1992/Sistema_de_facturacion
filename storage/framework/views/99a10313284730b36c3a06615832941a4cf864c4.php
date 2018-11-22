<?php $__env->startSection('content3'); ?>

    <div class="d-flex justify-content-between align-items-end">

            <?php if($caja_abierta): ?>
                <h1 style="color: #009000;"><?php echo e($titulo); ?>

                    <img src="..\..\..\Circle-unlock.png" width="36px" height="36px" style="margin-bottom: 5px;">
                </h1>
            <?php else: ?>
                <h1 style="color: #900000;"><?php echo e($titulo); ?>

                    <img src="..\..\..\Circle-lock.png" width="36px" height="36px" style="margin-bottom: 5px;">
                </h1>
            <?php endif; ?>
        <p>
            <form class="form-inline" method="POST" action="<?php echo e(url('admin/control/')); ?>">
                <?php echo csrf_field(); ?>

                <div class="form-group mx-sm-3 mb-2">
                    <input type="hidden" class="form-control" name="admin" value="<?php echo e(Auth::user()->nombre); ?>">
                    <input
                    <?php if($caja_abierta): ?>
                    disabled
                    <?php endif; ?>
                    type="number" min="0" required class="form-control" name="monto" placeholder="Ingrese un monto">
                    <input type="hidden" class="form-control" name="id_desc" value="1">
                    <input type="hidden" class="form-control" name="detalle" value="Caja Inicial">
                    <input type="hidden" class="form-control" name="caja_abierta" value="1">
                </div>
                <?php if($caja_abierta): ?>
                    <button disabled type="submit" class="btn btn-success mb-2">( Abierta )</button>
                    
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Cerrar</button>
                <?php else: ?>
                    <button disabled type="button" class="btn btn-danger">( Cerrada )</button>
                    <button type="submit" class="btn btn-success mb-2">Abrir</button>
                <?php endif; ?>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" style="padding-top: 150px;" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirmar operación</h5>
                            </div>
                            <div class="modal-body">
                                ¿Deseas cerrar la caja?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <a href="<?php echo e(route('control.caja.cierre')); ?>" class="btn btn-danger">Sí, cerrar</a>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </p>
    </div>

    <table class="table">
        <thead class="thead-dark"></thead>
          <tr></tr>
            <th scope="col">#</th>
            <th scope="col">Usuario</th>
            <th scope="col">Monto</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Borrar</th>
          </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $controls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $control): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="text-uppercase" >
                <th scope="row"><?php echo e($control->id); ?></th>
                <td><?php echo e($control->admin); ?></td>
                <td><b>$</b> <?php echo e($control->monto); ?></td>
                <td><?php echo e($control->created_at->format('d/m/Y')); ?></td>
                <td><?php echo e($control->created_at->format('H:i')); ?> <b class="text-lowercase">hs</b></td>
                <td>
                    <form action="<?php echo e(route('control.delete', [$id = $control->id])); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('DELETE')); ?>

                        <button class="btn btn-danger" type="submit">
                            <span class="oi oi-trash"></span>
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('control.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>