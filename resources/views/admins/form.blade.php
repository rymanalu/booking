@extends('layouts.app')

@section('header')
    Admins <small>{{ $isCreate ? 'Create' : 'Edit' }}</small>
@endsection

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-users"></i> Admins</a></li>
    <li class="active">{{ $isCreate ? 'Create' : 'Edit' }}</li>
@endsection

@section('content')
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{ $isCreate ? 'Create' : 'Edit' }}</h3>
            </div>

            <form action="{{ $isCreate ? route('admins.store') : route('admins.update', ['admin' => $admin->id]) }}" class="form-horizontal" method="post">
                @csrf

                @if (! $isCreate)
                    @method('patch')
                @endif

                <div class="box-body">
                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <label for="username" class="col-sm-4 control-label">Username</label>

                        <div class="col-sm-8">
                            <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $admin->username) }}">
                            @if ($errors->has('username'))
                                <span class="help-block">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-sm-4 control-label">Name</label>

                        <div class="col-sm-8">
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $admin->name) }}">
                            @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    @if ($isCreate)
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-sm-4 control-label">Password</label>

                            <div class="col-sm-8">
                                <input type="password" name="password" id="password" class="form-control">
                                @if ($errors->has('password'))
                                    <span class="help-block">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="col-sm-4 control-label">Confirm Password</label>

                            <div class="col-sm-8">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                            </div>
                        </div>
                    @endif
                </div>

                <div class="box-footer">
                    <a href="{{ route('admins.index') }}" class="btn btn-default">Back</a> <input class="btn btn-primary pull-right" title="Save" type="submit" value="Save">
                </div>
            </form>
        </div>
    </div>
@endsection