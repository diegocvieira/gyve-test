@extends('layout.app')

@section('content')

@include('inc.header')

<div class="container">
    <div class="row">
        <form method="POST" action="{{ route('order.store') }}" class="col s12">
            @csrf

            <div class="row">
                <div class="col s12 right-align">
                    <button class="btn waves-effect waves-light" type="submit">NEW ORDER
                        <i class="material-icons right">add</i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <form method="GET" action="{{ route('order.search') }}" class="col s12 m12">
            <div class="row">
                <div class="input-field col s12 m4">
                    <input id="control_number" name="control_number" type="text" value="{{ $controlNumber ?? '' }}">
                    <label for="control_number">Type the control number</label>
                </div>

                <div class="input-field col s12 m3">
                    <select name="state">
                        <option value="">All states</option>
                        <option value="1" @if(isset($state) && $state == 1) selected @endif>Pending</option>
                        <option value="2" @if(isset($state) && $state == 2) selected @endif>In progress</option>
                        <option value="3" @if(isset($state) && $state == 3) selected @endif>Completed</option>
                    </select>
                    <label>Select the state</label>
                </div>

                <div class="col s4">
                    <button class="btn waves-effect waves-light" type="submit">Filter
                        <i class="material-icons right">search</i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if ($orders->count())
        <table class="striped highlight responsive-table">
            <thead>
                <tr>
                    <th>Control number</th>
                    <th>State</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->control_number }}</td>
                        <td>{{ $order->getStateName() }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                            <form method="POST" action="{{ route('order.update.state') }}">
                                @method('PUT')
                                @csrf

                                <input type="hidden" name="order_id" value="{{ $order->id }}" />

                                @if ($order->stateIsPending())
                                    <input type="hidden" name="state" value="2" />
                                    <button type="submit" class="btn-small waves-effect waves-light">Start progress</button>
                                @elseif ($order->stateIsInProgress())
                                    <input type="hidden" name="state" value="3" />
                                    <button type="submit" class="btn-small waves-effect waves-light">Complete</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @include('inc.pagination', ['paginator' => $orders])
    @else
        Orders not found...
    @endif
</div>

@endsection
