<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Laporan Pinjaman [{{$tgl_awal}} - {{$tgl_akhir}}]</title>
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
  @foreach($jasa as $jasa)
  <table width="100%" border="0" class="halawal">
      <tr>
        <td align="center" width="100%"><b>LAPORAN PINJAMAN KOPEGSAF</b><br>{{$jasa->jasa_nama}} ({{$jasa->jasa_persen}}% - {{$jasa->jasa_hitung}})<br><span>Tanggal <?php echo tgl_indo($tgl_awal); ?> - <?php echo tgl_indo($tgl_akhir); ?></span></td>
      </tr>
      <tr>
        <td colspan="1"><hr></td>
      </tr>
  </table>
  
  <table width="100%" border="1" style="font-size: 12px;">
    <thead>
    <tr>
      <th align="center" height="30" rowspan="2" width="5%"> #</th>
      <th align="center" rowspan="2" width="25%">Nama Anggota</th>
      <th align="center" rowspan="2" style="font-size: 12px;">Tanggal</th>
      <th align="center" rowspan="2" style="font-size: 12px;">Besar</th>
      <th align="center" colspan="3" style="font-size: 12px;">Angsuran</th>
      <th align="center" rowspan="2" style="font-size: 12px;">Sudah Bayar</th>
      <th align="center" rowspan="2" style="font-size: 12px;">Sisa Pinjaman</th>
    </tr>
    <tr>
      <th align="center" style="font-size: 12px;">Lama</th>
      <th align="center" style="font-size: 12px;">Sisa</th>
      <th align="center" style="font-size: 12px;">Dialihkan</th>
    </tr>
    <tr>
      <td colspan="9"></td>
    </tr>
    </thead>
    <?php 
    $i = 1; 
    $total_sudah_bayar=0;
    $total_sisa_pinjaman=0;
    ?>
      @foreach ($anggota as $anggota)
      <?php
        $pinjaman = DB::select("select * from sp_pinjaman where anggota_nomor = '$anggota->anggota_nomor' and pinjaman_jasa = $jenis_pinjaman and pinjaman_tanggal between '$tgl_awal' and '$tgl_akhir'");
        foreach ($pinjaman as $pin) {
          $lunas = DB::select("select SUM(angsuran_total) as total from sp_angsuran WHERE id_pinjaman = '$pin->id_pinjaman' and angsuran_status='Lunas'");
          $belumlunas = DB::select("select SUM(angsuran_total) as total from sp_angsuran WHERE id_pinjaman = '$pin->id_pinjaman' and angsuran_status='Belum Lunas'");
          $pokok = DB::select("select angsuran_pokok from sp_angsuran WHERE id_pinjaman = '$pin->id_pinjaman' and angsuran_status='Belum Lunas' order by angsuran_pokok desc limit 1");

          $angsuran = DB::select("select id_angsuran from sp_angsuran where id_pinjaman = '$pin->id_pinjaman' and angsuran_status='Belum Lunas'");
          $sisa = count($angsuran);

          $dialihkan = DB::select("select id_angsuran from sp_angsuran where id_pinjaman = '$pin->id_pinjaman' and angsuran_status='Dialihkan'");
          $alih = count($dialihkan);

          foreach ($lunas as $lunas) {
            $total_lunas = $lunas->total;
          }
          foreach ($belumlunas as $hit) {
            $total_belum_lunas = $hit->total;
          }

          $total_sudah_bayar += $total_lunas;
          $total_sisa_pinjaman += $total_belum_lunas;
      ?>
        
    <tr>
      <td align="center" style="padding: 3px;">{{$i++}}</td>
      <td style="padding: 3px;">{{$anggota->anggota_nama}}</td>
      <td align="center"> <?php echo tgl_indo2($pin->pinjaman_tanggal) ?></td>
      <td align="right" style="padding-right: 3px;"><?php echo number_format($pin->pinjaman_total, 0,",","."); ?></td>
      <td align="center" style="padding: 3px;">{{$pin->pinjaman_angsuran}} kali</td>
      <td align="center" style="padding: 3px;">{{$sisa}} kali</td>
      <td align="center" style="padding: 3px;">{{$alih}} kali</td>
      <td align="right" style="padding: 3px;"><?php echo number_format($total_lunas, 0,",","."); ?></td>
      <td align="right" style="padding: 3px;"><?php echo number_format($total_belum_lunas, 0,",","."); ?></td>
    </tr>
    <?php } ?>
    @endforeach

    <?php 
      $pinjaman_total = DB::select("select sum(pinjaman_total) as pinjaman_total from sp_pinjaman where pinjaman_jasa = $jenis_pinjaman and pinjaman_tanggal between '$tgl_awal' and '$tgl_akhir'");

      foreach ($pinjaman_total as $pinjaman_total) {
        $total_besar = $pinjaman_total->pinjaman_total;
      }

     ?>
    <tr>
      <td height="15" colspan="3" align="center" style="padding: 3px; font-weight: bold;">Total</td>
      <td align="right" style="padding: 3px; font-weight: bold;"><?php echo number_format($total_besar, 0,",","."); ?></td>
      <td colspan="3"></td>
      <td align="right" style="padding: 3px; font-weight: bold;"><?php echo number_format($total_sudah_bayar, 0,",","."); ?></td>
      <td align="right" style="padding: 3px; font-weight: bold;"><?php echo number_format($total_sisa_pinjaman, 0,",","."); ?></td>

    </tr>

    
  </table>
  @endforeach
  </main>


</body>
</html>
