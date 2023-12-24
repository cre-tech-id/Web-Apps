@extends('layouts.admin')

@section('title', 'Tagihan')

@section('content')
<div class="container-fluid mb-3">
  <div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>Fitur Tagihan Air:</strong>
    <ol>
      <li>Data tagihan <strong>otomatis dibuat</strong> apabila Admin sudah memasukkan data penggunaan</li>
      <li>Status tagihan otomatis berubah menjadi <strong>LUNAS</strong> apabila pembayaran sukses</li>
    </ol>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <h3 class="mb-4">Tagihan Air</h3>
  <div class="card">
    <div class="card-body table-responsive">
      <table class="table table-striped table-bordered w-100"  id="bills">
      <thead>
        <tr>
          <th>ID</th>
          <th>ID Penggunaan</th>
          <th>Bulan</th>
          <th>Tahun</th>
          <th>Jumlah</th>
          <th>Status</th>
        </tr>
      </thead>
    </table>
    </div>
  </div>
</div>
@endsection

@push('addon-script')
  <script>
    $('#bills').DataTable({
        responsive: true,
        serverSide: true,
        ajax: "",
        columns: [
            {data: 'id'},
            {data: 'id_penggunaan'},
            {data: 'bulan'},
            {data: 'tahun'},
            {data: 'jumlah_kwh'},
            {data: 'status',
              render: function(data, type, row){
                return `<span class='badge badge-pill 
                        badge-${(data == 'BELUM LUNAS') ? 'danger' : 'success'}'>${data}</span>`;
            }}
        ]
    });
  </script>
@endpush