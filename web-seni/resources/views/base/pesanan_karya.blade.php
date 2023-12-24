
@extends('layout.base.base')

@section('content')
<script type="text/javascript" src="{{config('midtrans.snap_url')}}" data-client-key="{{config('midtrans.client_key')}}"></script>
<div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12 align-self-center">
                        <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s"
                            data-wow-delay="1s">
                            <div class="row">
                                <div class="flash-data" data-flashdata="{{ session('success') }}"></div>
                                @foreach($karya as $k)
                                <div class="card mb-5">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$k->nama_karya}}</h5>
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th>Jumlah Pesanan</th>
                                                    <td>{{$k->jumlah}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat Tujuan</th>
                                                    <td>{{$k->alamat}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Pesanan</th>
                                                    <td>{{$k->tanggal_pemesanan}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Pesanan</th>
                                                    <td>{{$k->jumlah}} x Rp.{{$k->harga}} = Rp.{{$k->total_pesanan}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Pembayaran</th>
                                                    <td>{{$k->pembayaran}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Resi</th>
                                                    @if($k->resi == '-')
                                                    <td>Belum ada resi</td>
                                                    @else
                                                    <td>{{$k->resi}}</td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                        <a href="#" class="btn btn-primary">Pesanan diterima</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                            <!-- <img src="assets/images/slider-dec.png" alt=""> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
    // Trigger snap popup. : Replace TRANSACTION_TOKEN_HERE with your transaction token
    window.snap.pay('', {
        onSuccess: function(result){
        /* You may add your own implementation here */
        // alert("payment success!"); console.log(result);
        window.location.href = '/invoice/$k->id'
        },
        onPending: function(result){
        /* You may add your own implementation here */
        alert("wating your payment!"); console.log(result);
        },
        onError: function(result){
        /* You may add your own implementation here */
        alert("payment failed!"); console.log(result);
        },
        onClose: function(){
        /* You may add your own implementation here */
        alert('you closed the popup without finishing the payment');
        }
    })
    });
</script> -->
@endsection
