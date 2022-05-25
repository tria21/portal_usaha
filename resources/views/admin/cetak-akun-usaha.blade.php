<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <style>
            table.static{
                position: relative;
                border: 1px solid #543535;
            }
        </style>
        <title>Cetak Data Akun Pemilik Usaha</title>
    </head>
    <body>
        <div class="form-group">
            <h3 align="center"><b>Data Akun Pemilik Usaha</b></h3>
            <table class="static" align="center" rules="all" border="1px" style="width: 95%;">
                <tr>
                    <th>No</th>
                    <th>Nama Pemilik</th>
                    {{-- <th>Foto</th> --}}
                    <th>Email</th>
                    <th>Nama Usaha</th>
                    <th>Jenis Usaha</th>
                    <th>Alamat</th>
                  </tr>
                  <?php $no = 1 ?>
                  @foreach ($cetakAkUsaha as $item)
                  <tr>
                    <th>{{$no++}}</th>
                    <th>{{$item->name}}</th>
                    {{-- <th width="20%">
                        <img src="{{asset('img/'.$item->image)}}" height="10%" width="80%" alt="" srcset="">
                    </th> --}}
                    <th>{{$item->email}}</th>
                    <th>{{$item->nama_usaha}}</th>
                    <th>{{$item->jenis_usaha}}</th>
                    <th>{{$item->alamat_usaha}}</th>
                  </tr>
                @endforeach
            </table>
        </div>
        <script type="text/javascript">
            window.print();
        </script>
    </body>
</html>