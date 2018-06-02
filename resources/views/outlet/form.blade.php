@extends('layouts.app')

@section('header')
    Schedules <small>{{ $isCreate ? 'Create' : 'Edit' }}</small>
@endsection

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-building"></i> Outlet</a></li>
    <li class="active">{{ $isCreate ? 'Create' : 'Edit' }}</li>
@endsection

@section('content')
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{ $isCreate ? 'Create' : 'Edit' }}</h3>
            </div>

            <form action="{{ $isCreate ? route('outlet.store') : route('outlet.update', ['outlet' => $outlet->id]) }}" class="form-horizontal" method="post">
                @csrf

                @if (! $isCreate)
                    @method('patch')
                @endif

                <div class="box-body">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="time" class="col-sm-3 control-label">Name</label>

                        <div class="col-sm-9">
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $outlet->name) }}">
                            @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                        <label for="price" class="col-sm-3 control-label">Address</label>

                        <div class="col-sm-9">
                            <textarea name="address" id="address" class="form-control">{{ old('address', $outlet->address) }}</textarea>
                            @if ($errors->has('address'))
                                <span class="help-block">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <a href="{{ route('outlet.index') }}" class="btn btn-default">Back</a> <input class="btn btn-primary pull-right" title="Save" type="submit" value="Save">
                </div>
            </form>
        </div>
    </div>
@endsection
