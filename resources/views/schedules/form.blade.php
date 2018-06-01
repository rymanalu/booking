@extends('layouts.app')

@section('header')
    Schedules <small>{{ $isCreate ? 'Create' : 'Edit' }}</small>
@endsection

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-calendar"></i> Schedules</a></li>
    <li class="active">{{ $isCreate ? 'Create' : 'Edit' }}</li>
@endsection

@section('content')
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{ $isCreate ? 'Create' : 'Edit' }}</h3>
            </div>

            <form action="{{ $isCreate ? route('schedules.store') : route('schedules.update', ['schedule' => $schedule->id]) }}" class="form-horizontal" method="post">
                @csrf

                @if (! $isCreate)
                    @method('patch')
                @endif

                <div class="box-body">
                    <div class="form-group{{ $errors->has('from') ? ' has-error' : '' }}">
                        <label for="from" class="col-sm-3 control-label">From</label>

                        <div class="col-sm-9">
                            <select name="from" id="from" class="form-control">
                            @foreach ($outlets as $id => $outlet)
                                    <option value="{{ $id }}"{{ old('from', $schedule->from) == $id ? ' selected' : '' }}>{{ $outlet }}</option>
                            @endforeach
                            </select>
                            @if ($errors->has('from'))
                                <span class="help-block">{{ $errors->first('from') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('to') ? ' has-error' : '' }}">
                        <label for="to" class="col-sm-3 control-label">To</label>

                        <div class="col-sm-9">
                            <select name="to" id="to" class="form-control">
                                @foreach ($outlets as $id => $outlet)
                                    <option value="{{ $id }}"{{ old('to', $schedule->to) == $id ? ' selected' : '' }}>{{ $outlet }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('to'))
                                <span class="help-block">{{ $errors->first('to') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                        <label for="date" class="col-sm-3 control-label">Date</label>

                        <div class="col-sm-9">
                            <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $schedule->date ? $schedule->date->format('Y-m-d') : null) }}">
                            @if ($errors->has('date'))
                                <span class="help-block">{{ $errors->first('date') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                        <label for="time" class="col-sm-3 control-label">Time</label>

                        <div class="col-sm-9">
                            <input type="time" name="time" id="time" class="form-control" value="{{ old('time', $schedule->time) }}">
                            @if ($errors->has('time'))
                                <span class="help-block">{{ $errors->first('time') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                        <label for="price" class="col-sm-3 control-label">Price</label>

                        <div class="col-sm-9">
                            <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $schedule->price) }}" min="0">
                            @if ($errors->has('price'))
                                <span class="help-block">{{ $errors->first('price') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <a href="{{ route('schedules.index') }}" class="btn btn-default">Back</a> <input class="btn btn-primary pull-right" title="Save" type="submit" value="Save">
                </div>
            </form>
        </div>
    </div>
@endsection
