@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('header')
    Outlet <small>List</small>
@endsection

@section('breadcrumb')
    <li class="active"><a href="#"><i class="fa fa-building"></i> Outlet</a></li>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Outlet</h3>

            <a class="btn btn-primary pull-right" href="{{ route('outlet.create') }}"><i class="fa fa-plus fa-fw"></i></a>
        </div>

        <div class="box-body">
            @include('flash::message')

            <table id="outlet-table" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th width="14%">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($outlets as $outlet)
                    <tr>
                        <td>{{ $outlet->name }}</td>
                        <td>{{ $outlet->address }}</td>
                        <td align="center">
                            <a href="{{ route('outlet.edit', ['outlet' => $outlet->id]) }}" class="btn btn-warning">
                                <i class="fa fa-pencil-square-o fa-fw"></i>
                            </a>&nbsp;
                            <a href="#" class="btn btn-danger" data-id="{{ $outlet->id }}" data-button="delete">
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
            $('#outlet-table').DataTable();

            $('#outlet-table').on('click', '[data-button=delete]', function (e) {
                var id = $(this).attr('data-id');
                $('#destroy').attr('action', '{{ route('outlet.index') }}/' + id);
                $('#delete-modal').modal('show');
                e.preventDefault();
            });
        });
    </script>
@endsection
