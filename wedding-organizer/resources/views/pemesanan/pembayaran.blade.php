@extends('layouts.user_type.auth')

@section('content')

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
                                        Nama Pemesan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-4">
                                        Paket yang dipesan
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Harga Paket
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Pembayaran
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Detail
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pemesanan as $p)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-l font-weight-bold mb-0">{{ $p->nama }}</p>
                                    </td>
                                    <td class="ps-4">
                                        <p class="text-l font-weight-bold mb-0">{{$p->nama_paket}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-l font-weight-bold mb-0">Rp. {{ $p->harga_paket }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-l font-weight-bold mb-0">Rp. {{ $p->pembayaran }}</p>
                                    </td>
                                    <td class="text-center">
                                        <a href="/pembayaran/detailpembayaran/{{$p->id}}" class="btn btn-primary btn-sm" data-bs-toggle="tooltip">
                                            Lihat Detail
                                        </a>
                                    </td>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection