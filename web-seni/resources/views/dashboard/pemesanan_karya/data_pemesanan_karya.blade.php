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
                    <h3 style="margin-top:15px">Pemesanan Karya</h3>
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
                                    <!-- <a href="{{route('tambahkarya')}}" class="btn btn-primary mb-3">Tambah
                                        Data</a> -->
                                    <table id="table" class="table table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <!-- <th>No</th> -->
                                                <th>Pemesan</th>
                                                <th>Karya</th>
                                                @if(Session::get('role')==1)
                                                <th>Seniman</th>
                                                @endif
                                                <th>Alamat</th>
                                                <th>Tanggal Pemesanan</th>
                                                <th>Pembayaran</th>
                                                <th>Resi</th>
                                                <!-- <th>Aksi</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($p_karya as $a)
                                            <tr>
                                                <!-- <td></td> -->
                                                <td>{{$a->nama_pemesan}}</td>
                                                <td>{{$a->nama_karya}}</td>
                                                @if(Session::get('role')==1)
                                                <td>{{$a->nama_seniman}}</td>
                                                @endif
                                                <td>{{$a->alamat}}</td>
                                                <td>{{$a->tanggal_pemesanan}}</td>
                                                <td>{{$a->pembayaran}}</td>
                                                @if($a->resi == '-')
                                                <td><button class="btn btn-primary btn-sm add_resi"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModal{{$a->id}}"
                                                        value="{{$a->id}}">Tambahkan
                                                        Resi</button></td>
                                                @else
                                                <td>{{$a->resi}}</td>
                                                @endif
                                                <div class="modal fade" id="exampleModal{{$a->id}}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class=" modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Tambah
                                                                    Resi</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" enctype="multipart/form-data"
                                                                    action="{{route('updateresi')}}">
                                                                    @csrf
                                                                    <div class="mb-3" hidden>
                                                                        <label for="exampleInputPassword1"
                                                                            class="form-label">id</label>
                                                                        <input type="text" class="form-control" id="id"
                                                                            name="id" value="{{$a->id}}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="exampleInputPassword1"
                                                                            class="form-label">Resi</label>
                                                                        <input type="text" class="form-control"
                                                                            id="resi" name="resi">
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Kembali</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Tambah</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
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
        <!-- Modal -->
    </div>
    @endsection
