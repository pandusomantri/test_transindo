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
            <td align="center" width="95%"><b>LAPORAN JEMPUTAN KOPEGSAF</b><br><span>Bulan <?php echo bulan_indo($bulan); ?> {{ $tahun }}</span></td>
            <td align="center" width="5%"><b>A4</b></td>
        </tr>
        <tr>
            <td colspan="2"><hr></td>
        </tr>
    </table>
    @foreach($supir as $data)
    <table width="100%" border="1" style="font-size: 12px;">
        <thead>
            <tr>
                <th align="center" colspan="6" height="20">Supir [ {{ $data->pendaftaran_supir }} ]</th>
            </tr>
            <tr>
                <th align="center" width="5%" style="padding: 5px;"> #</th>
                <th align="center" width="35%">Nama Siswa</th>
                <th align="center" width="15%">Kelas</th>
                <th align="center" width="15%">Status Bayar</th>
                <th align="center" width="15%">Tanggal Bayar</th>
                <th align="center" width="15%">Tarif</th>

            </tr>
        </thead>
        @php
            $i = 1;
            $jumlah_bayar = 0;
            $persen = 0;
            $total =0;
            $jumlah_potongan=0;
            $pendaftar = DB::select("SELECT pendaftaran_nama, pendaftaran_kelas, pendaftaran_bayar, pendaftaran_supir, pendaftaran_tanggal_bayar, pendaftaran_pembayaran FROM jemput_pendaftaran WHERE pendaftaran_status='Aktif' AND substr(pendaftaran_bulan, 6, 7) = MONTH('$bulan') AND pendaftaran_supir='$data->pendaftaran_supir'");
        @endphp
        @foreach($pendaftar as $pendaftar)
            <tr>
                <td align="center" style="padding: 3px;">{{$i++}}.</td>
                <td style="padding: 3px;">{{ $pendaftar->pendaftaran_nama }}</td>
                <td align="center" style="padding: 3px;">{{ $pendaftar->pendaftaran_kelas }}</td>
                <td align="center" style="padding: 3px;">{{ $pendaftar->pendaftaran_pembayaran }}</td>
                <td align="center" style="padding: 3px;"><?php echo tgl_indo2($pendaftar->pendaftaran_tanggal_bayar); ?></td>
                <td align="center" style="padding: 3px;">Rp. <?php echo number_format($pendaftar->pendaftaran_bayar, 0,",","."); ?></td>
                
            </tr>
            @php
                $jumlah_bayar += $pendaftar->pendaftaran_bayar;
                $persen = ($jumlah_bayar * 6)/100;
                $total = $jumlah_bayar - $persen - 200000;

                $potongan = DB::select("SELECT supir_potongan FROM jemput_supir WHERE supir_nama = '$pendaftar->pendaftaran_supir' AND substr(supir_bulan, 6, 7) = MONTH('$bulan')");
                foreach($potongan as $potongan){
                    $jumlah_potongan = $potongan->supir_potongan;
                }
            @endphp
        @endforeach
        <tr>
            <td colspan="5" style="padding: 5px;" align="right">Jumlah pembayaran</td>
            <td align="center">Rp. <?php echo number_format($jumlah_bayar, 0,",","."); ?></td>
        </tr>
        <tr>
            <td colspan="5" style="padding: 5px;" align="right">Potongan 6%</td>
            <td align="center">Rp. <?php echo number_format($persen, 0,",","."); ?></td>
        </tr>
        <tr>
            <td colspan="5" style="padding: 5px;" align="right">Potongan koperasi</td>
            <td align="center">Rp. <?php echo number_format($jumlah_potongan, 0,",","."); ?></td>
        </tr>
        <tr>
            <td colspan="5" style="padding: 5px;" align="right">Take home pay</td>
            <td align="center">Rp. <?php echo number_format($total, 0,",","."); ?></td>
        </tr>
    </table>
    <br>
    @endforeach


  
  </main>


</body>
</html>
