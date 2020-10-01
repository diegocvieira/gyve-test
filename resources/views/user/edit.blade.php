@extends('layout.app')

@section('content')

@include('inc.header')

<div class="container">
    <div class="row" style="margin-top: 50px;">
        <form method="POST" action="{{ route('user.update') }}" class="col s12 m6 offset-m3">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="input-field col s12">
                    <input id="name" name="name" type="text" value="{{ $user->name }}" required>
                    <label for="name">Name</label>
                </div>

                <div class="input-field col s12">
                    <input id="email" name="email" type="email" value="{{ $user->email }}" required>
                    <label for="email">E-mail</label>
                </div>

                <div class="input-field col s12">
                    <input id="password" name="password" type="password">
                    <label for="password">New password</label>
                </div>

                <div class="input-field col s12">
                    <label for="is-admin">
                        <input type="checkbox" name="is_admin" id="is-admin" value="1" class="filled-in" @if ($user->is_admin) checked @endif />
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

        <div class="col s12 m4 offset-m4" style="margin-top: 50px;">
            <form method="POST" action="{{ route('user.destroy') }}">
                @csrf
                @method('DELETE')

                <button class="btn red darken-3" type="submit" style="width: 100%;">DELETE ACCOUNT
                    <i class="material-icons right">delete</i>
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
