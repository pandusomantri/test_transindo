<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Laporan Saber</title>
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
            <td align="center" width="95%"><b>LAPORAN SABER KOPEGSAF</b><br><span>Bulan <?php echo bulan_indo($dari); ?> {{ $tahun_dari }} - <?php echo bulan_indo($sampai); ?> {{ $tahun_sampai }}</span></td>
            <td align="center" width="5%"><b>A4</b></td>
        </tr>
        <tr>
            <td colspan="2"><hr></td>
        </tr>
    </table>
  
    <table width="100%" border="1" style="font-size: 12px;">
        <thead>
            <tr>
                <th align="center" height="20" colspan="3"> <b>Pengeluaran</b></th>
            </tr>
            <tr>
                <th align="center" width="5%" style="padding: 3px;"> #</th>
                <th align="center" width="45%">Bulan</th>
                <th align="center" width="50%">Jumlah Pengeluaran</th>
            </tr>
        </thead>
        @php
            $i = 1;
            $tot_pengeluaran =0;
            $total=0;
        @endphp
        @foreach($pengeluaran as $data)
            @php
                $tot_pengeluaran += $data->total_pengeluaran
            @endphp
            <tr>
                <td align="center" style="padding: 3px;">{{$i++}}.</td>
                <td align="center" style="padding: 3px;">
                    {{ $data->bulan }} {{ $data->tahun }}
                </td>
                <td align="center" style="padding: 3px;"><?php echo number_format($data->total_pengeluaran,0,',','.'); ?></td>
            </tr>
        @endforeach
        <tr>
            <td align="center" style="padding: 3px;" colspan="3"><b> Total Pengeluaran : Rp. <?php echo number_format($tot_pengeluaran,0,',','.'); ?></b></td>
        </tr>
    </table>
    <br>
    <table width="100%" border="1" style="font-size: 12px;">
        <thead>
            <tr>
                <th align="center" height="20" colspan="3"> <b>Pemasukan</b></th>
            </tr>
            <tr>
                <th align="center" style="padding: 3px;"> #</th>
                <th align="center" width="45%">Bulan</th>
                <th align="center" width="50%">Jumlah Pemasukan</th>

            </tr>
        </thead>
        @php
            $i = 1;
            $tot_pemasukan=0;
        @endphp
        @foreach($pendaftar as $p)
            @php
                $tot_pemasukan += $p->jumlah_bayar
            @endphp
            <tr>
                <td align="center" style="padding: 3px;">{{$i++}}.</td>
                <td align="center" style="padding: 3px;">
                    {{ $p->bulan_pendaftar }} {{ $p->tahun_pendaftar }}
                </td>
                <td align="center" style="padding: 3px;"><?php echo number_format($p->jumlah_bayar,0,',','.'); ?></td>
            </tr> 
        @endforeach
        <tr>
            <td align="center" style="padding: 3px;" colspan="3"><b> Total Pemasukan : Rp. <?php echo number_format($tot_pemasukan,0,',','.'); ?></b></td>
        </tr>
        @php
            $total = $tot_pemasukan - $tot_pengeluaran;
        @endphp
        <tr>
            <td align="center" style="padding: 3px;" colspan="3"><b> Total (Pemasukan - Pengeluaran) : Rp. <?php echo number_format($total,0,',','.'); ?></b></td>
        </tr>
    </table>

  
  </main>


</body>
</html>
