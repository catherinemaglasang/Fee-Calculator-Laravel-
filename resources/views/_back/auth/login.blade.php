@extends('welcome')

@section('content')
    <div id="login" class="login">
        <h1><a href="/"><img src="images/trdealerlogin.png"></a></h1>
        
        @include('flash')

        @include('errors')

        <form method="POST" action="/login">
            {!! csrf_field() !!}

            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? ' checked' : '' }}> Remember Me
                </label>
                <button type="submit" class="btn btn-default">Sign In</button>
            </div>
        </form>
    </div>
@stop