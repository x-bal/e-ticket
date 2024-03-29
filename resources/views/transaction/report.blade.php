@extends('layouts.master', ['title' => $title, 'breadcrumbs' => $breadcrumbs])

@push('style')
<link href="{{ asset('/') }}plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="{{ asset('/') }}plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">{{ $title }}</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>

    <div class="panel-body">

        <form action="" method="get" class="row mb-3">
            <div class="col-md-3">
                <label for="from">From</label>
                <input type="date" name="from" id="from" class="form-control" value="{{ request('from') ?? Carbon\Carbon::now()->format('Y-m-d') }}">
            </div>

            <div class="col-md-3">
                <label for="to">To</label>
                <input type="date" name="to" id="to" class="form-control" value="{{ request('to') ?? Carbon\Carbon::now()->format('Y-m-d') }}">
            </div>

            <div class="col-md-6 mt-1">
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                <a href="{{ route('transactions.export') }}" class="btn btn-success mt-3">Export</a>
            </div>
        </form>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th colspan="5">Report Transaction Tanggal {{ Carbon\Carbon::parse($from)->format('d/m/Y') }} - {{ request('to') ? Carbon\Carbon::parse($to)->subDay(1)->format('d/m/Y') : Carbon\Carbon::parse($to)->format('d/m/Y') }}</th>
                </tr>
                <tr>
                    <th>Jenis Ticket</th>
                    <th class="text-center">Jumlah</th>
                    <th>Harga Ticket</th>
                    <th>Total Harga Ticket</th>
                    <th>Rincian Discount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->name }}</td>
                    <td class="text-center">{{ App\Models\Transaction::whereBetween('created_at', [$from, $to])->where('ticket_id', $ticket->id)->sum('amount') }}</td>
                    <td>{{ number_format($ticket->harga,0, ',', '.') }}</td>
                    <td>{{ number_format(App\Models\Transaction::whereBetween('created_at', [$from, $to])->where('ticket_id', $ticket->id)->sum('harga_ticket'),0, ',', '.') }}</td>
                    <td>{{ number_format(App\Models\Transaction::whereBetween('created_at', [$from, $to])->where('ticket_id', $ticket->id)->sum('discount'), 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr>
                    <th>Total Amount :</th>
                    <th colspan="4" class="text-end">{{ number_format(App\Models\Transaction::whereBetween('created_at', [$from, $to])->sum('harga_ticket'),0, ',', '.') }}</th>
                </tr>
                <tr>
                    <td colspan="5"></td>
                </tr>
                <tr>
                    <th>Jenis Pembayaran</th>
                    <td class="text-center">Tunai :</td>
                    <th colspan="3" class="text-end">{{ number_format(App\Models\Transaction::whereBetween('created_at', [$from, $to])->where('metode', 'cash')->sum('harga_ticket'),0, ',', '.') }}</th>
                </tr>
                <tr>
                    <th></th>
                    <td class="text-center">Debit :</td>
                    <th colspan="3" class="text-end">{{ number_format(App\Models\Transaction::whereBetween('created_at', [$from, $to])->where('metode', 'debit')->sum('harga_ticket'),0, ',', '.') }}</th>
                </tr>
                <tr>
                    <th></th>
                    <td class="text-center">Other :</td>
                    <th colspan="3" class="text-end">{{ number_format(App\Models\Transaction::whereBetween('created_at', [$from, $to])->where('metode', 'lain-lain')->sum('harga_ticket'),0, ',', '.') }}</th>
                </tr>
                <tr>
                    <td colspan="5"></td>
                </tr>
                <tr>
                    <th>Total Discount :</th>
                    <th colspan="4" class="text-end">{{ number_format(App\Models\Transaction::whereBetween('created_at', [$from, $to])->sum('discount'),0, ',', '.') }}</th>
                </tr>
                <tr>
                    <td colspan="5"></td>
                </tr>
                <tr>
                    <th>Grand Total :</th>
                    <th colspan="4" class="text-end">{{ number_format(App\Models\Transaction::whereBetween('created_at', [$from, $to])->sum('harga_ticket'),0, ',', '.') }}</th>
                </tr>
                <tr>
                    <th>Grand Total Penerimaan Tunai :</th>
                    <th colspan="4" class="text-end">{{ number_format(App\Models\Transaction::whereBetween('created_at', [$from, $to])->where('metode', 'cash')->sum('harga_ticket'),0, ',', '.') }}</th>
                </tr>
            </tbody>
        </table>
    </div>
    @endsection

    @push('script')
    <script src="{{ asset('/') }}plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}plugins/sweetalert/dist/sweetalert.min.js"></script>
    @endpush