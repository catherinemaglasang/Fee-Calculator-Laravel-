@extends('partials.login')

@section('content')

<div id="login" class="register">

    <h1><a href="/"><img src="images/trdealerlogin.png"></a></h1>

    @include('dialog.info')

    <form method="POST" action="/register">
        {!! csrf_field() !!}

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="form-group clearfix">
            <button type="submit" class="btn btn-default">Register</button>
        </div>
    </form>
</div>
@stop