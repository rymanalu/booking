@extends('layouts.app')

@section('header')
    Users <small>{{ $isCreate ? 'Create' : 'Edit' }}</small>
@endsection

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-users"></i> Users</a></li>
    <li class="active">{{ $isCreate ? 'Create' : 'Edit' }}</li>
@endsection

@section('content')
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{ $isCreate ? 'Create' : 'Edit' }}</h3>
            </div>

            <form action="{{ $isCreate ? route('users.store') : route('users.update', ['user' => $user->id]) }}" class="form-horizontal" method="post">
                @csrf

                @if (! $isCreate)
                    @method('patch')
                @endif

                <div class="box-body">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-sm-4 control-label">Email</label>

                        <div class="col-sm-8">
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-sm-4 control-label">Name</label>

                        <div class="col-sm-8">
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
                            @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                        <label for="phone_number" class="col-sm-4 control-label">Phone Number</label>

                        <div class="col-sm-8">
                            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}">
                            @if ($errors->has('phone_number'))
                                <span class="help-block">{{ $errors->first('phone_number') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                        <label for="address" class="col-sm-4 control-label">Address</label>

                        <div class="col-sm-8">
                            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $user->address) }}">
                            @if ($errors->has('address'))
                                <span class="help-block">{{ $errors->first('address') }}</span>
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
                    <a href="{{ route('users.index') }}" class="btn btn-default">Back</a> <input class="btn btn-primary pull-right" title="Save" type="submit" value="Save">
                </div>
            </form>
        </div>
    </div>
@endsection
