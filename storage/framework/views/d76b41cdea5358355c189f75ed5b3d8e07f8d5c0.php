<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="nav nav-pills nav-fill">
                            
                            
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/clientes">Clientes</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/empleados">Empleados</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/encargados">Encargados</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/servicios">Servicios</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/productos">Productos</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/control">Control</a>
                            </li>
                            <?php $caja_abierta = $_SESSION['caja_abierta']; ?>
                           
                           <?php if($caja_abierta==1): ?>
                            <li class="nav-item">
                                 <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalEJ">Facturar</button>
                            </li>
                            <?php endif; ?>
                            
                        </ul>
                    </div>
                    
                    <div class="panel-body">
                        <?php if(session('status')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?>
                    
                        <?php echo $__env->yieldContent('content2'); ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
<?php if($caja_abierta==1): ?>
    <?php 
    
    $empleados =   $_SESSION['empleados'];
    $clientes = $_SESSION['clientes'];
    $id_type =   $_SESSION['id_type'];
    $tipo = $_SESSION['tipo'];
    ?>
  <div class="modal fade" id="myModalEJ" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Facturar</h4>
        </div>
        <div class="modal-body row">
            <div class="col-md-12">
              <form method="POST" action="/admin/control/ingresos/<?php echo e($tipo); ?>">
                        <?php echo csrf_field(); ?>


                        <div class="form-group col-md-3" style="padding-left: 0px;">
                            <label>Atendió</label>
                            <select class="form-control text-uppercase text-uppercase" name="id_empleado" value="<?php echo e(old('id_empleado')); ?>">
                                <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($empleado->activo == 1): ?>
                                    <option value="<?php echo e($empleado->id); ?>"><?php echo e($empleado->nombre); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group col-md-3" style="padding-left: 0px;">
                            <label>Cliente</label>
                            <select class="form-control text-uppercase" name="id_cliente" value="<?php echo e(old('id_cliente')); ?>">
                                <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($cliente->activo == 1): ?>
                                    <option value="<?php echo e($cliente->id); ?>"><?php echo e($cliente->nombre); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <input type="hidden" class="form-control text-uppercase" name="id_type" value="<?php echo e($id_type); ?>">
                        <input type="hidden" class="form-control text-uppercase" name="deHoy" value=1>
                        <input type="hidden" class="form-control text-uppercase" name="completada" value=0>
                        <input type="hidden" class="form-control text-uppercase" name="monto" value=0>
                        <input type="hidden" class="form-control text-uppercase" name="pago_efec" value=0>
                        <input type="hidden" class="form-control text-uppercase" name="pago_tarj" value=0>
                        <input type="hidden" class="form-control text-uppercase" name="descuento" value=0>

                        <div class="form-group col-md-2" style="padding-left: 0px;">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-success form-control">Agregar</button>
                        </div>
                    </form>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>