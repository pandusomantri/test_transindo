<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Laporan Jemputan</title>
  <link href="/gambar/logokoperasi.png" rel="shortcut icon" />
    <style type="text/css" media="screen">
        @font-face{
        font-family: "proximacnlt_2";
        font-weight: normal;
        font-style: normal;
        src: url({{ storage_path('fonts/proximacnlt_2.ttf') }}) format('truetype');
        }

        body{
        font-family: "proximacnlta_2";
        }

        @page {
            margin: 0cm 0cm;
        }

        body {
            margin-top: 2.5cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 1cm;
        }

        /** Define the header rules **/
        .header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;
            padding-top: 0.3cm;
            padding-left: 0.3cm;
            padding-right: 0.3cm;
            font-size: 13px;

            /** Extra personal styles **/
            background-color: #C0C0C0;
            color: white;
            text-align: center;
            line-height: 0.2cm;
        }

        /** Define the footer rules **/
        footer {
            position: fixed; 
            bottom: 0cm; 
            left: 0cm; 
            right: 0cm;
            height: 0.5cm;

            /** Extra personal styles **/
            /*background-color: #C0C0C0;*/
            color: white;
            text-align: right;
            line-height: 0.2cm;
            padding-bottom: 0.3cm;
            padding-top: 0.3cm;
            padding-right: 0.3cm;
        }
        main {
        font-size: 13px;
        }

        .breakNow { 
        page-break-inside:avoid; 
        page-break-after: always; 
        }

        .breakNow2 { 
        page-break-inside:avoid; 
        page-break-before: always; 
        }

        .halawal{
        position: fixed;
        top: 0.2cm;
        left: 0.8cm;
        right: 0.8cm;
        height: 0.8cm;
        padding-top: 0.3cm;
        padding-left: 0.3cm;
        padding-right: 0.3cm;
        }

        .haltiap{
        position: fixed;
        top: 0.2cm;
        left: 0.8cm;
        right: 0.8cm;
        height: 0.8cm;
        padding-top: 0.3cm;
        padding-left: 0.3cm;
        padding-right: 0.3cm;
        }
    </style>
</head>
<body>
  <!-- <header>
    
  </header> -->

    <footer>
        <script type="text/php">
        if (isset($pdf)) {
            $x = 730;
            $y = 570;
            $text = "Halaman {PAGE_NUM} dari {PAGE_COUNT}";
            $font = "proximacnlta_2";
            $size = 10;
            $color = array(0, 0, 0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
        </script>
    </footer>

    <main>
    <table width="92%" border="0" class="halawal">
        <tr>
            <td align="center" width="95%"><b>LAPORAN JEMPUTAN KOPEGSAF</b><br><span>Bulan <?php echo bulan_indo($dari); ?> {{ $tahun_dari }} - <?php echo bulan_indo($sampai); ?> {{ $tahun_sampai }}</span></td>
            <td align="center" width="5%"><b>A4</b></td>
        </tr>
        <tr>
            <td colspan="2"><hr></td>
        </tr>
    </table>
  
    <table width="100%" border="1" style="font-size: 12px;">
        <thead>
            <tr>
                <th align="center" height="30" width="2%"> #</th>
                <th align="center" width="5%">Bulan</th>
                <th align="center" width="18%">Nama Pendaftar</th>
                <th align="center" width="5%">Kelas</th>
                <th align="center" width="25%">Alamat</th>
                <th align="center" width="10%">Jalur</th>
                <th align="center" width="10%">Supir</th>
                <th align="center" width="5%">Bayar</th>
                <th align="center" width="10%">Tanggal Bayar</th>
                <th align="center" width="10%">Pembayaran</th>
            </tr>
            <tr>
                <td colspan="10"></td>
            </tr>
        </thead>
        @php
            $i = 1;
            $tunai = 0;
            $transfer =0;
            $total_pembayaran=0;
        @endphp
        @foreach($pendaftar as $data)
            <tr>
                <td align="center" style="padding: 3px;">{{$i++}}.</td>
                <td align="center" style="padding: 3px;"><?php echo bulan_indo($data->pendaftaran_bulan) ?></td>
                <td style="padding: 3px;">{{$data->pendaftaran_nama}}</td>
                <td align="center" style="padding: 3px;">{{$data->pendaftaran_kelas}}</td>
                <td style="padding: 3px;">{{$data->pendaftaran_alamat}}</td>
                <td align="center" style="padding: 3px;">{{$data->pendaftaran_jalur}} [{{ $data->pendaftaran_keterangan }}]</td>
                <td align="center" style="padding: 3px;">{{$data->pendaftaran_supir}}</td>
                <td align="center" style="padding: 3px;">{{$data->pendaftaran_pembayaran}}</td>
                <td align="center" style="padding: 3px;"><?php echo tgl_indo2($data->pendaftaran_tanggal_bayar); ?></td>
                <td align="right" style="padding-right: 3px;">Rp. <?php echo number_format($data->pendaftaran_bayar, 0,",","."); ?></td>
            </tr>
            @php
                if($data->pendaftaran_pembayaran == "Tunai"){
                    $tunai += $data->pendaftaran_bayar; 
                }elseif($data->pendaftaran_pembayaran == "Transfer"){
                    $transfer += $data->pendaftaran_bayar;
                }
                $total_pembayaran += $data->pendaftaran_bayar;
            @endphp
            
        @endforeach
        <tr>
            <td colspan="9" align="right" height="20" style="padding-right: 20px; font-weight:bold;"> Tunai</td>
            <td align="center" style="font-weight: bold;">Rp. <?php echo number_format($tunai, 0,",","."); ?></td>
        </tr>
        <tr>
            <td colspan="9" align="right" height="20" style="padding-right: 20px; font-weight:bold;"> Transfer</td>
            <td align="center" style="font-weight: bold;">Rp. <?php echo number_format($transfer, 0,",","."); ?></td>
        </tr>
        <tr>
            <td colspan="9" align="right" height="20" style="padding-right: 20px; font-weight:bold;"> Total Pembayaran</td>
            <td align="center" style="font-weight: bold;">Rp. <?php echo number_format($total_pembayaran, 0,",","."); ?></td>
        </tr>
    </table>

  
  </main>


</body>
</html>
