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
                        
                        <label for="login" class="sr-only">Email address</label>
                        <input type="login" id="login" class="form-control" placeholder="Introduce tu E-Mail o Nombre de Usuario" required autofocus name="login" value="<?php echo e(old('login')); ?>">
                        <?php if($errors->has('login')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('login')); ?></strong>
                            </span>
                        <?php endif; ?>
                        
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