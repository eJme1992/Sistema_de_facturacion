<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/open-iconic-bootstrap.css')); ?>" rel="stylesheet">
    
    <!-- Bootstrap Core CSS -->
        <link href="/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="/css/sb-admin-2.css" rel="stylesheet">

        <!-- font-awesome -->
        <link rel="stylesheet" href="/css/all.css">


    <!-- Custom styles for this template -->
    <style>
        /* Sticky footer styles-------------------------------------------------- */
    html {
        position: relative;
        min-height: 100%;
    }
    body {
    /* Margin bottom by footer height */
        margin-bottom: 60px;
    }

    @media (min-width: 768px) 
    {
        .sidebar 
        {
          margin-top: 0px;
        }
    }
    
    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
    /* Set the fixed height of the footer here */
        height: 60px;
        line-height: 60px; /* Vertically center the text there */
        background-color: #ffffffd9;
    }
    
    /* Custom page CSS
    -------------------------------------------------- */
    /* Not required for template or sticky footer method. */
  
    body > .container {
        padding: 60px 15px 0;
    }
    
    .navbar-default{
        background-image: url(/cisca.png);
        background-position: center;
        background-position-y: 0px;
        background-repeat: no-repeat;
        background-size: 160px;
    }

    .footer > .container {
        padding-right: 15px;
        padding-left: 15px;
        background-image: url(/logo.png);
        background-size: 180px;
        background-repeat: no-repeat;
        background-position: right;
        background-position-y: 0px;
    }
    /* Para las imagenes de Productos. */
    .zoom {
        padding: 1px;
        background-color: #dbdbdb;
        transition: transform .2s;
    }
    
    .zoom:hover {
        -ms-transform: scale(8); /* IE 9 */
        -webkit-transform: scale(8); /* Safari 3-8 */
        transform: scale(8); 
    }
    
    code {
        font-size: 80%;
    }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                        <?php echo e(config('app.name', 'Laravel')); ?>

                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <?php if(auth()->guard()->guest()): ?>
                            
                            
                        <?php else: ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    <?php echo e(Auth::user()->nombre); ?> <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo e(route('logout')); ?>"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Cerrar sesión
                                        </a>

                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                            <?php echo e(csrf_field()); ?>

                                        </form>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <?php echo $__env->yieldContent('content'); ?>
        
    </div>
    
    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
        <footer class="footer">
            <div class="container">
                <span class="text-muted">Por <b>JABlack Soft</b> | Copyright © 2018
                </span>
            </div>
        </footer>
      
          
        <!-- wrapper -->
        <!-- Metis Menu Plugin JavaScript -->
        <script src="/metisMenu/metisMenu.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="/js/sb-admin-2.js"></script>
    </body>
</html>