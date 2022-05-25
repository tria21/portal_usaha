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
        <title>Cetak Data Akun Masyarakat</title>
    </head>
    <body>
        <div class="form-group">
            <h3 align="center"><b>Data Akun Masyarakat</b></h3>
            <table class="static" align="center" rules="all" border="1px" style="width: 95%;">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                  </tr>
                  <?php $no = 1 ?>
                  @foreach ($cetakAkMasy as $item)
                  <tr>
                    <th>{{ $no++ }}</th>
                    <th>{{$item->name}}</th>
                    <th>{{$item->email}}</th>
                  </tr>
                @endforeach
            </table>
        </div>
        <script type="text/javascript">
            window.print();
        </script>
    </body>
</html>