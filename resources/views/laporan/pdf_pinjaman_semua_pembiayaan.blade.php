<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <?php foreach ($jasa as $nama) { ?>
  <title>Laporan Pinjaman [ <?php echo $nama->jasa_nama.' - '.tgl_indo($tgl_akhir); ?> ]</title>
  <?php } ?>
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
  <table width="95%" border="0" class="halawal">
      <tr>
        <td align="center" width="95%"><b>LAPORAN PINJAMAN KOPEGSAF</b><br><span>Sampai dengan tanggal <?php echo tgl_indo($tgl_akhir); ?></span><br>{{$jasa->jasa_nama}} ({{$jasa->jasa_persen}}% - {{$jasa->jasa_hitung}})</td>
        <td align="center" width="5%"><b>A4</b></td>
      </tr>
      <tr>
        <td colspan="2"><hr></td>
      </tr>
  </table>
  
  <table width="100%" border="1" style="font-size: 12px;">
    <thead>
    <tr>
      <th align="center" height="30" rowspan="2" width="5%"> #</th>
      <th align="center" rowspan="2" width="15%">Nama Anggota</th>
      <th align="center" rowspan="2" style="font-size: 12px;">Tanggal</th>
      <th align="center" rowspan="2" style="font-size: 12px;">Besar</th>
      <th align="center" colspan="3" style="font-size: 12px;">Angsuran</th>
      <th align="center" rowspan="2" style="font-size: 12px;">Sudah Bayar</th>
      <th align="center" rowspan="2" style="font-size: 12px;">Sisa Pinjaman</th>
      <th align="center" rowspan="2" style="font-size: 12px;">Pokok</th>
    </tr>
    <tr>
      <th align="center" style="font-size: 12px;">Lama</th>
      <th align="center" style="font-size: 12px;">Sisa</th>
      <th align="center" style="font-size: 12px;">Dialihkan</th>
    </tr>
    <tr>
      <td colspan="10"></td>
    </tr>
    </thead>
    <?php 
    $i = 1; 
    $total_sudah_bayar=0;
    $total_sisa_pinjaman=0;
    $total_harga_pokok=0;
    $total_pinjaman=0;
    ?>
      @foreach ($anggota as $anggota)
      <?php
        $pinjaman = DB::select("SELECT id_pinjaman, pinjaman_tanggal, pinjaman_angsuran, pinjaman_total from sp_pinjaman where anggota_nomor = '$anggota->anggota_nomor' and pinjaman_jasa = $jenis_pinjaman and pinjaman_status='Aktif' and pinjaman_tanggal between '$tgl_awal' and '$tgl_akhir'");
        foreach ($pinjaman as $pin) {
          $lunas = DB::select("SELECT SUM(angsuran_total) as total from sp_angsuran WHERE id_pinjaman = '$pin->id_pinjaman' and angsuran_status='Lunas'");
          $belumlunas = DB::select("SELECT SUM(angsuran_total) as total from sp_angsuran WHERE id_pinjaman = '$pin->id_pinjaman' and angsuran_status='Belum Lunas'");

          $pokok = DB::select("SELECT angsuran_pokok from sp_angsuran WHERE id_pinjaman = '$pin->id_pinjaman' and angsuran_status='Belum Lunas' order by angsuran_pokok desc limit 1");

          $angsuran = DB::select("SELECT id_angsuran from sp_angsuran where id_pinjaman = '$pin->id_pinjaman' and angsuran_status='Belum Lunas'");
          $sisa = count($angsuran);

          $dialihkan = DB::select("SELECT id_angsuran from sp_angsuran where id_pinjaman = '$pin->id_pinjaman' and angsuran_status='Dialihkan'");
          $alih = count($dialihkan);

          foreach ($lunas as $lunas) {
            $total_lunas = $lunas->total;
          }
          foreach ($belumlunas as $hit) {
            $total_belum_lunas = $hit->total;
          }
          $total_pokok = 0;
          foreach ($pokok as $pokok) {
            $total_pokok = $pokok->angsuran_pokok;
          }

          
          $total_sisa_pinjaman += $total_belum_lunas;
          $total_harga_pokok += $total_pokok;

          if($sisa > 0){
            $total_sudah_bayar += $total_lunas;
            $besar_pinjaman = $pin->pinjaman_total;
            $total_pinjaman += $besar_pinjaman;
      ?>
        
    <tr>
      <td align="center" style="padding: 3px;">{{$i++}}</td>
      <td style="padding: 3px;">{{$anggota->anggota_nama}}</td>
      <td align="center"> <?php echo tgl_indo_pendek($pin->pinjaman_tanggal) ?></td>
      <td align="right" style="padding-right: 3px;"><?php echo number_format($besar_pinjaman, 0,",","."); ?></td>
      <td align="center" style="padding: 3px;">{{$pin->pinjaman_angsuran}} kali</td>
      <td align="center" style="padding: 3px;">{{$sisa}} kali</td>
      <td align="center" style="padding: 3px;">{{$alih}} kali</td>
      <td align="right" style="padding: 3px;"><?php echo number_format($total_lunas, 0,",","."); ?></td>
      <td align="right" style="padding: 3px;"><?php echo number_format($total_belum_lunas, 0,",","."); ?></td>
      <td align="right" style="padding: 3px;"><?php echo number_format($total_pokok, 0,",","."); ?></td>
    </tr>
    <?php } } ?>
    @endforeach

     ?>
    <tr>
      <td height="15" colspan="3" align="center" style="padding: 3px; font-weight: bold;">Total</td>
      <td align="right" style="padding: 3px; font-weight: bold;"><?php echo number_format($total_pinjaman, 0,",","."); ?></td>
      <td colspan="3"></td>
      <td align="right" style="padding: 3px; font-weight: bold;"><?php echo number_format($total_sudah_bayar, 0,",","."); ?></td>
      <td align="right" style="padding: 3px; font-weight: bold;"><?php echo number_format($total_sisa_pinjaman, 0,",","."); ?></td>
      <td align="right" style="padding: 3px; font-weight: bold;"><?php echo number_format($total_harga_pokok, 0,",","."); ?></td>

    </tr>

    
  </table>
  @endforeach
  </main>


</body>
</html>
