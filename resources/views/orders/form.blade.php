@extends('layouts.app')

@section('header')
    Orders <small>{{ $isCreate ? 'Create' : 'Edit' }}</small>
@endsection

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-shopping-cart"></i> Orders</a></li>
    <li class="active">{{ $isCreate ? 'Create' : 'Edit' }}</li>
@endsection

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{ $isCreate ? 'Create' : 'Edit' }}</h3>
            </div>

            <form action="{{ $isCreate ? route('orders.store') : route('orders.update', ['order' => $order->id]) }}" class="form-horizontal" method="post">
                @csrf

                @if (! $isCreate)
                    @method('patch')
                @endif

                <div class="box-body">
                    <div class="form-group{{ $errors->has('schedule_id') ? ' has-error' : '' }}">
                        <label for="schedule_id" class="col-sm-3 control-label">Schedule</label>

                        <div class="col-sm-9">
                            <select name="schedule_id" id="schedule_id" class="form-control">
                                @foreach ($schedules as $schedule)
                                    <option data-price="{{ $schedule->price }}" value="{{ $schedule->id }}"{{ old('schedule_id', $order->schedule_id) == $schedule->id ? ' selected' : '' }}>{{ $schedule->fromOutlet->name.' to '.$schedule->toOutlet->name.' ('.$schedule->date->format('d M Y').' - '.$schedule->time.')' }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('schedule_id'))
                                <span class="help-block">{{ $errors->first('schedule_id') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="price" class="col-sm-3 control-label">Price (Rp)</label>

                        <div class="col-sm-9">
                            <input type="number" name="price" id="price" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                        <label for="user_id" class="col-sm-3 control-label">User</label>

                        <div class="col-sm-9">
                            <select name="user_id" id="user_id" class="form-control">
                                @foreach ($users as $id => $name)
                                    <option value="{{ $id }}"{{ old('user_id', $order->user_id) == $id ? ' selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('user_id'))
                                <span class="help-block">{{ $errors->first('user_id') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('qty') ? ' has-error' : '' }}">
                        <label for="qty" class="col-sm-3 control-label">Qty</label>

                        <div class="col-sm-9">
                            <input type="number" name="qty" id="qty" class="form-control" value="{{ old('qty', $order->qty ?? 0) }}" min="0">
                            @if ($errors->has('qty'))
                                <span class="help-block">{{ $errors->first('qty') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="total" class="col-sm-3 control-label">Total (Rp)</label>

                        <div class="col-sm-9">
                            <input type="number" name="total" id="total" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <a href="{{ route('orders.index') }}" class="btn btn-default">Back</a> <input class="btn btn-primary pull-right" title="Save" type="submit" value="Save">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        function set_price() {
            var price = $('#schedule_id option:selected').attr('data-price');

            $('#price').val(price);
        }

        function set_total() {
            var price = $('#price').val();
            var qty = $('#qty').val();

            $('#total').val(price * qty);
        }

        $(document).ready(function () {
            set_price();
            set_total();

            $('#schedule_id').change(function () {
                set_price();
                set_total();
            });

            $('#qty').on('change keydown paste input', function () {
                set_total();
            });
        });
    </script>
@endsection
