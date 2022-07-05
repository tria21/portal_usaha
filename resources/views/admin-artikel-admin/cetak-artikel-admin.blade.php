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
        <title>Cetak Data Artikel Admin</title>
    </head>
    <body>
        <div class="form-group">
            <h3 align="center"><b>Data Artikel Admin</b></h3>
            <table class="static" align="center" rules="all" border="1px" style="width: 95%;">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Gambar</th>
                    <th>Caption Gambar</th>
                    <th>Kategori</th>
                    <th>Isi Artikel</th>
                    <th>Tanggal Terbit</th>
                </tr>
                <?php $no = 1 ?>
                @foreach ($cetakArAdmin as $item)
                <tr>
                    <th>{{ $no++ }}</th>
                    <th>{{$item->judul}}</th>
                    <th width="20%">
                      <img src="{{asset('img/'.$item->gambar)}}" height="10%" alt="" srcset="">
                    </th>
                    <th>{{$item->caption_gambar}}</th>
                    <th>{{$item->kategori}}</th>
                    <th>{!!$item->isi_artikel!!}</th>
                    <th>{{$item->created_at}}</th>
                </tr>
                @endforeach
            </table>
        </div>
        <script type="text/javascript">
            window.print();
        </script>
    </body>
</html>