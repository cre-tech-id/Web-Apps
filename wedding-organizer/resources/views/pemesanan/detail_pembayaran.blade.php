@extends('layouts.user_type.auth')

@section('content')
<style>
    .frame_img {
        width: 350px;
        height: 400px;
        position: relative;
        overflow: hidden;
        cursor: zoom-in;
    }

    .img_bukti {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-repeat: no-repeat;
        background-position: center;
        background-size: 100%;
        transition: transform 0.5s ease-out;
    }
</style>

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Data Pembayaran</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-4">
                                        Nominal
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-4 text-center">
                                        Tanggal Bayar
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-4 text-center">
                                        Bukti
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pembayaran as $p)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-l font-weight-bold mb-0">{{ $p->nominal }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-l font-weight-bold mb-0">{{$p->created_at}}</p>
                                    </td>
                                    <td class="text-center">
                                    <center><div class="frame_img" data-scale="1.6">
                                        <a class="dslc-lightbox-image img_bukti" href="" style="background-image:url('../../storage/upload/bukti/{{$p->bukti}}')">
                                        </a>
                                    </div>
                                    </center>
                                    </td>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-left:2em">
        <a class="btn btn-primary" href="/pembayaran">Kembali</a>
    </div>
</div>
@endsection