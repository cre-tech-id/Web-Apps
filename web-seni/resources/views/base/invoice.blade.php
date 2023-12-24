<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>kesenian</title>
</head>
<body>
    <div class="container">
        <h1>
            Invoice
        </h1>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <form action="{{route('bayar')}}" method="POST" enctype="multipart/form-data">
                @csrf
              <h5 class="card-title">Detail Pesanan</h5>
              <table>
                @foreach($karya as $k)
                <tr>
                    <td>Pemesan</td>
                    <td> : {{$k->pemesan_id}}</td>
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td> : {{$k->jumlah}}</td>
                </tr>
                <tr>
                    <td>Total Harga</td>
                    <td> : {{$k->total_harga}}</td>
                </tr>
                <tr>
                    <td>Pembayaran</td>
                    <td> : Berhasil!</td>
                </tr>
              </table>
              <input type="text" name="id" id="id" value="{{$k->id_pesanan_karya}}" >
              <input type="text" name="pembayaran" id="pembayaran" value="Sudah bayar" >
              <button type="submit" class="btn btn-success">Selesai</button>
              @endforeach
            </form>
        </div>
          </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</html>
