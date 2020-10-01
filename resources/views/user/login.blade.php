@extends('layout.app')

@section('content')

<div class="container">
    <div class="row" style="margin: 50px auto;">
        <div class="col s12 center-align">
            <h1 style="font-size: 3rem;">Order Management System</h1>
        </div>
    </div>

    <div class="row">
        <form method="POST" action="{{ route('user.login') }}" class="col s12 m6 offset-m3">
            @csrf

            <div class="row">
                <div class="input-field col s12">
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required>
                    <label for="email">E-mail</label>
                </div>

                <div class="input-field col s12">
                    <input id="password" name="password" type="password" required>
                    <label for="password">Password</label>
                </div>

                <div class="col s12">
                    <button class="btn waves-effect waves-light" type="submit" style="width: 100%;">LOGIN
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
