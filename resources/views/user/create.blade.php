@extends('layout.app')

@section('content')

@include('inc.header')

<div class="container">
    <div class="row" style="margin-top: 50px;">
        <form method="POST" action="{{ route('user.store') }}" class="col s12 m6 offset-m3">
            @csrf

            <div class="row">
                <div class="input-field col s12">
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required>
                    <label for="name">Name</label>
                </div>

                <div class="input-field col s12">
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required>
                    <label for="email">E-mail</label>
                </div>

                <div class="input-field col s12">
                    <input id="password" name="password" type="password" required>
                    <label for="password">Password</label>
                </div>

                <div class="input-field col s12">
                    <label for="is-admin">
                        <input type="checkbox" name="is_admin" id="is-admin" value="1" class="filled-in" />
                        <span>Is admin?</span>
                    </label>
                </div>

                <div class="col s12" style="margin-top: 50px;">
                    <button class="btn waves-effect waves-light" type="submit" style="width: 100%;">SAVE
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
