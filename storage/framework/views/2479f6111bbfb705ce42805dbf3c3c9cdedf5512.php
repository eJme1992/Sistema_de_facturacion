    <style>
        .verde{
            background-color: #00cf01;
            color: white;
        }
        .roja{
            background-color: #ce0000;
            color: white;
        }
        .verdeOscuro{
            background-color: #007701;
            color:gray;
        }
        .rojaOscuro{
            background-color: #770000;
            color:gray;
        }
        .celeste{
            background-color: #2196f3;
            color: white;
        }
        .azul{
            background-color: #005cce;
            color: white;
        }
        .azulOscuro{
            background-color: #003575;
            color: gray;
        }
        .fila{
            font-size: large;
        }
        .table > tbody > tr.fila > td{
            padding: 7px;
            padding-left: 15px;
        }
    </style>
<?php $__env->startSection('content3'); ?>
    
    <div class="d-flex justify-content-between align-items-end">
        <h1 class="mt-2 mb-3"><?php echo e($titulo); ?></h1>
        <?php if($titulo == "Movimientos del turno"): ?>
            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Historial
            </button>
        <?php else: ?>
            <a href="<?php echo e(url('/admin/control/movimientos/')); ?>" class="btn btn-primary">Volver</a>
        <?php endif; ?> 
    </div>
    <p></p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <p>
                <form class="form-inline" method="POST" action="<?php echo e(url('/admin/control/movimientos/historial')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <label> Desde </label>
                        <input required type="date" class="form-control" name="desde" value="<?php echo e(date("Y-m-d", strtotime("yesterday"))); ?>">
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

    <table class="table table-bordered" style="border: 5px;border-style: inset;">
        <tbody>
            <tr
                <?php if($caja_inicial == 0): ?> 
                    class="fila verdeOscuro"
                <?php else: ?>
                    class="fila verde"
                <?php endif; ?>>
                <td>Inicio Caja</td>
                <td>$ <?php echo e($caja_inicial); ?></td>
            </tr>
            <tr
                <?php if($ingXprod_efec + $ingXprod_tarj == 0): ?> 
                    class="fila verdeOscuro"
                <?php else: ?>
                    class="fila verde"
                <?php endif; ?> >
                <td>Ingresos x Productos</td>
                <td>$ <?php echo e($ingXprod_efec + $ingXprod_tarj); ?></td>
            </tr>
            <tr
                <?php if($ingXserv_efec + $ingXserv_tarj == 0): ?> 
                    class="fila verdeOscuro"
                <?php else: ?>
                    class="fila verde"
                <?php endif; ?>>
                <td>Ingresos x Servicios</td>
                <td>$ <?php echo e($ingXserv_efec + $ingXserv_tarj); ?></td>
            </tr>
            <tr
                <?php if($gastXlimp == 0): ?> 
                    class="fila rojaOscuro"
                <?php else: ?>
                    class="fila roja"
                <?php endif; ?>>
                <td>Gastos x Limpieza</td>
                <td>$ <?php echo e($gastXlimp); ?></td>
            </tr>
            <tr
                <?php if($gastXserv == 0): ?> 
                    class="fila rojaOscuro"
                <?php else: ?>
                    class="fila roja"
                <?php endif; ?>>
                <td>Gastos x Servicios</td>
                <td>$ <?php echo e($gastXserv); ?></td>
            </tr>
            <tr
                <?php if($gastXmerc == 0): ?> 
                    class="fila rojaOscuro"
                <?php else: ?>
                    class="fila roja"
                <?php endif; ?>>
                <td>Gastos x Mercaderías</td>
                <td>$ <?php echo e($gastXmerc); ?></td>
            </tr>
            <tr
                <?php if($gastXcomi == 0): ?> 
                    class="fila rojaOscuro"
                <?php else: ?>
                    class="fila roja"
                <?php endif; ?>>
                <td>Gastos x Comida</td>
                <td>$ <?php echo e($gastXcomi); ?></td>
            </tr>
            <tr
                <?php if($gastXcont == 0): ?> 
                    class="fila rojaOscuro"
                <?php else: ?>
                    class="fila roja"
                <?php endif; ?>>
                <td>Gastos x Contador</td>
                <td>$ <?php echo e($gastXcont); ?></td>
            </tr>
            <tr
                <?php if($retiros == 0): ?> 
                    class="fila rojaOscuro"
                <?php else: ?>
                    class="fila roja"
                <?php endif; ?>>
                <td>Retiros</td>
                <td>$ <?php echo e($retiros); ?></td>
            </tr>
            <tr
                <?php if($adelantos == 0): ?> 
                    class="fila rojaOscuro"
                <?php else: ?>
                    class="fila roja"
                <?php endif; ?>>
                <td>Adelantos</td>
                <td>$ <?php echo e($adelantos); ?></td>
            </tr>
            <tr
                <?php if($sueldos == 0): ?> 
                    class="fila rojaOscuro"
                <?php else: ?>
                    class="fila roja"
                <?php endif; ?>>
                <td>Sueldos</td>
                <td>$ <?php echo e($sueldos); ?></td>
            </tr>
            <tr
                <?php if($comisiones == 0): ?> 
                    class="fila rojaOscuro"
                <?php else: ?>
                    class="fila roja"
                <?php endif; ?>>
                <td>Comisiones</td>
                <td>$ <?php echo e($comisiones); ?></td>
            </tr>
            <tr
                <?php if($total_efec == 0): ?> 
                    class="fila azulOscuro"
                <?php else: ?>
                    class="fila celeste"
                <?php endif; ?>>
                <td>Total en Efectivo</td>
                <td>$ <?php echo e($total_efec); ?></td>
            </tr>
            <tr
                <?php if($total_tarj == 0): ?> 
                    class="fila azulOscuro"
                <?php else: ?>
                    class="fila celeste"
                <?php endif; ?>>
                <td>Total en Tarjeta</td>
                <td>$ <?php echo e($total_tarj); ?></td>
            </tr>
            <tr
                <?php if($total_efec + $total_tarj == 0): ?> 
                    class="fila azulOscuro"
                <?php else: ?>
                    class="fila azul"
                <?php endif; ?>>
                <td>TOTAL</td>
                <td>$ <?php echo e($total_efec + $total_tarj); ?></td>
            </tr>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('control.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>