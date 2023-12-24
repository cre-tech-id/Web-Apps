
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
                                
                                <button class="btn btn-primary" id="pay-button">Bayar Sekarang</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
    // Trigger snap popup. : Replace TRANSACTION_TOKEN_HERE with your transaction token
    window.snap.pay('{{$snapToken}}', {
        onSuccess: function(result){
        /* You may add your own implementation here */
        // alert("payment success!"); console.log(result);
        window.location.href = '/invoice/{{$order}}'
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
</script>

@endsection
