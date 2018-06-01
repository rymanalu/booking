@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('header')
    Orders <small>List</small>
@endsection

@section('breadcrumb')
    <li class="active"><a href="#"><i class="fa fa-shopping-cart"></i> Orders</a></li>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Orders</h3>

            <a class="btn btn-primary pull-right" href="{{ route('orders.create') }}"><i class="fa fa-plus fa-fw"></i></a>
        </div>

        <div class="box-body">
            @include('flash::message')

            <table id="orders-table" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Schedule</th>
                    <th>User</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th width="14%">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->schedule->fromOutlet->name.' to '.$order->schedule->toOutlet->name }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ number_format($order->qty, 0, ',', '.') }}</td>
                        <td>{{ number_format($order->total, 0, ',', '.') }}</td>
                        <td>{{ $order->getStatus() }}</td>
                        <td align="center">
                            @if ($order->status == \App\Order::STATUS_UNPAID)
                                <a href="#" class="btn btn-success" data-id="{{ $order->id }}" data-button="pay">
                                    <i class="fa fa-money fa-fw"></i>
                                </a>&nbsp;
                            @endif
                            <a href="#" class="btn btn-danger" data-id="{{ $order->id }}" data-button="delete">
                                <i class="fa fa-trash fa-fw"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="pay-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pay</h4>
                </div>

                <div class="modal-body">
                    <p>Are you sure want to change this order status to paid?</p>
                </div>

                <div class="modal-footer">
                    <form method="post" id="pay">
                        @csrf
                        <a id="delete-modal-cancel" href="#" class="btn btn-default" data-dismiss="modal">Cancel</a>&nbsp;
                        <input class="btn btn-primary" type="submit" value="Continue">
                    </form>
                </div>
            </div>
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
            $('#orders-table').DataTable();

            $('#orders-table').on('click', '[data-button=pay]', function (e) {
                var id = $(this).attr('data-id');
                $('#pay').attr('action', '{{ route('orders.index') }}/' + id + '/pay');
                $('#pay-modal').modal('show');
                e.preventDefault();
            });

            $('#orders-table').on('click', '[data-button=delete]', function (e) {
                var id = $(this).attr('data-id');
                $('#destroy').attr('action', '{{ route('orders.index') }}/' + id);
                $('#delete-modal').modal('show');
                e.preventDefault();
            });
        });
    </script>
@endsection
