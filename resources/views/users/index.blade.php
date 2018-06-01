@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('header')
    Users <small>List</small>
@endsection

@section('breadcrumb')
    <li class="active"><a href="#"><i class="fa fa-users"></i> Users</a></li>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Users</h3>

            <a class="btn btn-primary pull-right" href="{{ route('users.create') }}"><i class="fa fa-plus fa-fw"></i></a>
        </div>

        <div class="box-body">
            @include('flash::message')

            <table id="users-table" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th width="14%">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->address }}</td>
                        <td align="center">
                            <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-warning">
                                <i class="fa fa-pencil-square-o fa-fw"></i>
                            </a>&nbsp;
                            <a href="#" class="btn btn-danger" data-id="{{ $user->id }}" data-button="delete">
                                <i class="fa fa-trash fa-fw"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="delete-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>

                <div class="modal-body">
                    <p>Are you sure want to delete this data?</p>
                </div>

                <div class="modal-footer">
                    <form method="post" id="destroy">
                        @csrf
                        @method('delete')
                        <a id="delete-modal-cancel" href="#" class="btn btn-default" data-dismiss="modal">Cancel</a>&nbsp;
                        <input class="btn btn-primary" type="submit" value="Continue">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#users-table').DataTable();

            $('#users-table').on('click', '[data-button=delete]', function (e) {
                var id = $(this).attr('data-id');
                $('#destroy').attr('action', '{{ route('users.index') }}/' + id);
                $('#delete-modal').modal('show');
                e.preventDefault();
            });
        });
    </script>
@endsection
