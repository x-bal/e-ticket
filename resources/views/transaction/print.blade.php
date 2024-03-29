<!DOCTYPE html>
<html>

<head>
    <title>Print QR</title>
    <style>
        @media print {
            .row {
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    @if($tipe == 'individual')
    @foreach($tickets as $ticket)
    <div class="row">
        <div style="max-width:80mm !important;  margin: 0 auto 0 auto; vertical-align: top; border-style: solid;border-width: 1px;">
            <div style="widht:80mm; margin-left: 15px; margin-top:10px;margin-bottom:0px">
                <div style="float: left;">
                    <img src="{{ asset('/images/heha.png') }}" width="80" width="80" alt="The Logo" class="brand-image" style="opacity: .8">
                </div>
                <div style="float: right; margin-right:5px">
                    <p style="font-size: 8.5pt;text-transform: uppercase; margin: 1px 1px 1px 1px;">TICKETING HSV</p>
                    <p style="font-size: 8.5pt; margin-top:1px;margin-bottom: 5px;">Tanggal {{ Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y H:i:s') }} </p>
                    <p style="font-size: 8.5pt;margin: 1px 1px 5px 1px;"> </p>
                </div>
            </div>

            <div style="widht:80mm; font-size:8pt; padding:2mm 0 2mm 0; margin-top: 60px; margin-bottom: 0px; ">
                <hr style="border-style: dashed;">
                <p style="font-size:8.5pt;font-weight:bold;margin-left:30px;margin-bottom:0px">Struk Pembelian</p>
                <p style="font-size:8.5pt;margin-left:30px;margin-top:5px;margin-bottom:0px">Pengunjung {{ $ticket->tipe == 'group' ? $ticket->amount . ' X ' . number_format($ticket->ticket->harga, 0, ',', '.') . ' : ' : $ticket->amount }} Rp. {{ number_format($ticket->ticket->harga*$ticket->amount, 0 , ',', '.') }}</p>
                <p style="font-size:8.5pt;margin-left:30px;margin-top:5px;margin-bottom:0px">Discount : Rp. {{ number_format($ticket->discount ?? 0, 0, ',' ,'.') }}</p>
                <br>
                <p style="font-size:8.5pt;margin-top:5px;margin-left:30px;margin-bottom:0px">Metode Pembayaran : {{ $ticket->metode }}</p>
                <p style="font-size:8.5pt;margin-top:5px;margin-left:30px;margin-bottom:0px">Total : Rp. {{ number_format($ticket->harga_ticket - $ticket->discount, 0, ',', '.') }}</p>
                <p style="font-size:8.5pt;margin-left:30px;margin-top:5px;margin-bottom:0px">Diterima : Rp. {{ number_format($ticket->cash, 0, ',', '.') }}</p>
                <p style="font-size:8.5pt;margin-left:30px;margin-top:5px">Kembali : Rp. {{ number_format($ticket->kembalian, 0, ',', '.') }}</p>
                <p style="font-size:8.5pt;text-align: center;margin-top:5px">*** Terima Kasih ***</p>
                <hr style="border-style: dashed;">
                <p style="font-size:6.5pt;text-align: center;margin-top:5px">TICKETING HSV " Tiket berlaku satu kali masuk "</p>
                <hr style="border-style: dashed;">
                <p style="text-align: center;margin-top:15px;margin-bottom:15px">
                    {!! QrCode::size(100)->generate($ticket->ticket_code) !!} <br><br>
                    <span>{{ $ticket->ticket_code }}</span>
                </p>
                <hr style="border-style: dashed;">
                <p style="font-size:6.5pt;text-align: center;margin-top:5px;margin-bottom:0px">TICKETING HSV " Barcode hanya buat buka gate "</p>
            </div>
            {{--
            <div style="text-align: center; margin-top:50px">
                <p>Struk Pembelian</p>
                <p style="font-size: 8.5pt">{!! QrCode::size(80)->generate($ticket->ticket_code) !!}</p>
            </div> --}}
        </div>

    </div>
    @endforeach
    @else
    @for($i=0; $i<=$print;$i++) @foreach($tickets as $ticket) <div class="row">
        <div style="max-width:80mm !important;  margin: 0 auto 0 auto; vertical-align: top; border-style: solid;border-width: 1px;">
            <div style="widht:80mm; margin-left: 15px; margin-top:10px;margin-bottom:0px">
                <div style="float: left;">
                    <img src="{{ asset('/images/heha.png') }}" width="80" width="80" alt="The Logo" class="brand-image" style="opacity: .8">
                </div>
                <div style="float: right; margin-right:5px">
                    <p style="font-size: 8.5pt;text-transform: uppercase; margin: 1px 1px 1px 1px;">TICKETING HSV</p>
                    <p style="font-size: 8.5pt; margin-top:1px;margin-bottom: 5px;">Tanggal {{ Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y H:i:s') }} </p>
                    <p style="font-size: 8.5pt;margin: 1px 1px 5px 1px;"> </p>
                </div>
            </div>

            <div style="widht:80mm; font-size:8pt; padding:2mm 0 2mm 0; margin-top: 60px; margin-bottom: 0px; ">
                <hr style="border-style: dashed;">
                <p style="font-size:8.5pt;font-weight:bold;margin-left:30px;margin-bottom:0px">Struk Pembelian</p>
                <p style="font-size:8.5pt;margin-left:30px;margin-top:5px;margin-bottom:0px">Pengunjung {{ $ticket->tipe == 'group' ? $ticket->amount . ' X ' . number_format($ticket->ticket->harga, 0, ',', '.') . ' : ' : $ticket->amount }} Rp. {{ number_format($ticket->ticket->harga*$ticket->amount, 0 , ',', '.') }}</p>
                <p style="font-size:8.5pt;margin-left:30px;margin-top:5px;margin-bottom:0px">Discount : Rp. {{ number_format($ticket->discount ?? 0, 0, ',' ,'.') }}</p>
                <br>
                <p style="font-size:8.5pt;margin-top:5px;margin-left:30px;margin-bottom:0px">Metode Pembayaran : {{ $ticket->metode }}</p>
                <p style="font-size:8.5pt;margin-top:5px;margin-left:30px;margin-bottom:0px">Total : Rp. {{ number_format($ticket->harga_ticket - $ticket->discount, 0, ',', '.') }}</p>
                <p style="font-size:8.5pt;margin-left:30px;margin-top:5px;margin-bottom:0px">Diterima : Rp. {{ number_format($ticket->cash, 0, ',', '.') }}</p>
                <p style="font-size:8.5pt;margin-left:30px;margin-top:5px">Kembali : Rp. {{ number_format($ticket->kembalian, 0, ',', '.') }}</p>
                <p style="font-size:8.5pt;text-align: center;margin-top:5px">*** Terima Kasih ***</p>
                <hr style="border-style: dashed;">
                <p style="font-size:6.5pt;text-align: center;margin-top:5px">TICKETING HSV " Tiket berlaku satu kali masuk "</p>
                <hr style="border-style: dashed;">
                <p style="text-align: center;margin-top:15px;margin-bottom:15px">
                    {!! QrCode::size(100)->generate($ticket->ticket_code) !!} <br><br>
                    <span>{{ $ticket->ticket_code }}</span>
                </p>
                <hr style="border-style: dashed;">
                <p style="font-size:6.5pt;text-align: center;margin-top:5px;margin-bottom:0px">TICKETING HSV " Barcode hanya buat buka gate "</p>
            </div>
            {{--
            <div style="text-align: center; margin-top:50px">
                <p>Struk Pembelian</p>
                <p style="font-size: 8.5pt">{!! QrCode::size(80)->generate($ticket->ticket_code) !!}</p>
            </div> --}}
        </div>

        </div>
        @endforeach
        @endfor
        @endif

        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function() {
                window.print()
            })
        </script>
</body>

</html>