<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <form class="form-signin" method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo e(csrf_field()); ?>

                        
                        <img class="mb-4" src="lock.svg" alt="" width="72" height="72">
                        
                        <h1 class="h2" style="margin-top: 10px;">Entrar</h1>
                        
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger alert-dismissible" style="padding-right: 15px;" role="alert">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($error); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <button type="button" style="top: 145px; right: 40px;position: absolute;" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <label for="login" class="sr-only">Email address</label>
                        <input id="email" type="text" class="form-control" name="email" value="<?php echo e(old('email')); ?>" placeholder="Introduce tu E-Mail o Nº de teléfono" required autofocus>
                        
                        <p></p>
                        
                        <label for="Password" class="sr-only">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                        <?php if($errors->has('password')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('password')); ?></strong>
                            </span>
                        <?php endif; ?>
                        
                        <div class="checkbox mb-3">
                            <label>
                                <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> 
                                Recordarme
                            </label>
                        </div>
                        
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                        
                        <p></p>
                        <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>