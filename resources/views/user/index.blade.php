@extends('layout.app')

@section('content')

@include('inc.header')

<div class="container">
    <div class="row">
        <div class="col s12 right-align">
            <a href="{{ route('user.create') }}" class="btn waves-effect waves-light">NEW USER
                <i class="material-icons right">add</i>
            </a>
        </div>
    </div>

    <div class="row">
        <form method="GET" action="{{ route('user.search') }}" class="col s12 m12">
            <div class="row">
                <div class="input-field col s12 m4">
                    <input id="keyword" name="keyword" type="text" value="{{ $keyword ?? '' }}">
                    <label for="keyword">Type the name or email</label>
                </div>

                <div class="input-field col s12 m3">
                    <select name="type">
                        <option value="">All users</option>
                        <option value="0" @if (isset($type) && $type == 0) selected @endif>Normal users</option>
                        <option value="1" @if (isset($type) && $type == 1) selected @endif>Admin users</option>
                    </select>
                    <label>Select the users type</label>
                </div>

                <div class="col s4">
                    <button class="btn waves-effect waves-light" type="submit">Filter
                        <i class="material-icons right">search</i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if ($users->count())
        <table class="striped highlight responsive-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Created at</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @include('inc.pagination', ['paginator' => $users])
    @else
        Users not found...
    @endif
</div>

@endsection
