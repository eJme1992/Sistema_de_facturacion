@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <form class="form-signin" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        
                        <img class="mb-4" src="lock.svg" alt="" width="72" height="72">
                        
                        <h1 class="h2" style="margin-top: 10px;">Entrar</h1>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible" style="padding-right: 15px;" role="alert">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                                <button type="button" style="top: 145px; right: 40px;position: absolute;" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <label for="login" class="sr-only">Email address</label>
                        <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Introduce tu E-Mail o Nº de teléfono" required autofocus>
                        
                        <p></p>
                        
                        <label for="Password" class="sr-only">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        
                        <div class="checkbox mb-3">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 
                                Recordarme
                            </label>
                        </div>
                        
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                        
                        <p></p>
                        <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
                    </form>
                    {{--  <form class="form-login" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
                            <label for="login" class="col-md-4 control-label">E-Mail o Usuario</label>

                            <div class="col-md-6">
                                <input id="login" type="login" class="form-control" name="login" value="{{ old('login') }}" 
                                    required autofocus placeholder="Introduce tu E-Mail o Nombre de Usuario">

                                @if ($errors->has('login'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>  --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
