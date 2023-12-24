@extends('layout.dashboard.dashboard')
@section('content')
<div class="layout-page">
    <!-- Navbar -->
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                    <h3 style="margin-top:15px">Pemesanan Kesenian</h3>
                </div>
            </div>
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar">
                            @foreach($users as $s)
                            <img src="/storage/upload/profile/{{$s->foto}}" alt class="w-px-40 h-auto rounded-circle" />
                            @endforeach
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            @foreach($users as $s)
                                            <img src="/storage/upload/profile/{{$s->foto}}" alt
                                                class="w-px-40 h-auto rounded-circle" />
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block">{{Session::get('nama')}}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{route('profile')}}">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                        </li>
                        <li>
                        <li>
                            @foreach($users as $s)
                            <a class="dropdown-item" href="/editprofile/{{ $s->id }}">
                                @endforeach
                                <i class="bx bx-cog me-2"></i>
                                <span class="align-middle">Edit Profile</span>
                            </a>
                        </li>
                </li>

                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a class="dropdown-item" href="{{route('logout')}}">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                    </a>
                </li>
            </ul>
            </li>
            </ul>
        </div>
    </nav>
    <!-- / Navbar -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col">
                                <div class="card-body">
                                    <!-- <a href="" class="btn btn-primary mb-3">Tambah
                                        Data</a> -->
                                    <table id="table" class="table table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <!-- <th>No</th> -->
                                                <th>Pemesan</th>
                                                <th>Kesenian</th>
                                                @if(Session::get('role')==1)
                                                <th>Seniman</th>
                                                @endif
                                                <th>Lokasi</th>
                                                <th>Tanggal Booking</th>
                                                <th>Status</th>
                                                <th>Pembayaran</th>
                                                <!-- <th>Aksi</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($p_kesenian as $a)
                                            <tr>
                                                <!-- <td></td> -->
                                                <td>{{$a->nama_pemesan}}</td>
                                                <td>{{$a->nama_kesenian}}</td>
                                                @if(Session::get('role')==1)
                                                <td>{{$a->nama_penyedia}}</td>
                                                @endif
                                                <td>{{$a->lokasi}}</td>
                                                <td>{{$a->tanggal_book}}</td>
                                                <td>
                                                    @if(Session::get('role') == '2')
                                                    @if($a->status == '-')
                                                    <a href="/dashboard/pesankesenian/terima/{{$a->id}}"
                                                        class="btn btn-success btn-sm" data-bs-toggle="tooltip">
                                                        Terima
                                                    </a>
                                                    <a href="/dashboard/pesankesenian/tolak/{{$a->id}}" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="tooltip">
                                                        Tolak
                                                    </a>
                                                    @elseif($a->status == 'Diterima')
                                                    <button type="button" disabled
                                                        class="btn btn-outline-success btn-sm">Diterima</button>
                                                    @elseif($a->status == 'Ditolak')
                                                    <button type="button" disabled
                                                        class="btn btn-outline-danger btn-sm">Ditolak</button>
                                                    @endif
                                                    @else
                                                    @if($a->status == '-')
                                                    <button type="button" disabled
                                                        class="btn btn-outline-info btn-sm">Belum
                                                        dikonfirmasi</button>
                                                    @elseif($a->status == 'Diterima')
                                                    <button type="button" disabled
                                                        class="btn btn-outline-success btn-sm">Diterima</button>
                                                    @else
                                                    <button type="button" disabled
                                                        class="btn btn-outline-danger btn-sm">Ditolak</button>
                                                    @endif
                                                    @endif
                                                </td>
                                                <td>
                                                @if(Session::get('role')==1)
                                                @if($a->pembayaran=='-')
                                                Belum dibayar
                                                @else
                                                {{ $a->pembayaran }}
                                                @endif
                                                @elseif(Session::get('role')==2)
                                                <form method="POST" action="/dashboard/kesenian/updatepembayaranseni/{{$a->id}}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <select class="form-control dropdown" name="pembayaran"
                                                        id="choices-button" placeholder="Departure"
                                                        onchange='if(this.value != 0) { this.form.submit(); }'>
                                                        @if($a->pembayaran == '-')
                                                        <option value="" selected="">Belum dibayar</option>
                                                        @else
                                                        <option value="" selected="">{{ $a->pembayaran }}</option>
                                                        @endif
                                                        <option value="DP">DP</option>
                                                        <option value="Lunas">Lunas</option>
                                                    </select>
                                                </form>
                                                @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tfoot>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
