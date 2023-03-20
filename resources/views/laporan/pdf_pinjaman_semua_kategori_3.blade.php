<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Laporan Pinjaman [ <?php echo tgl_indo($tgl_akhir); ?> ]</title>
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
  <table width="95%" border="0" class="halawal">
      <tr>
        <td align="center" width="95%"><b>LAPORAN PINJAMAN KOPEGSAF</b><br><span>Sampai dengan tanggal <?php echo tgl_indo($tgl_akhir); ?></span><br> Kategori Mesin Cuci, Kasur, TV, Emas, Lemari Baju</td>
        <td align="center" width="5%"><b>A4</b></td>
      </tr>
      <tr>
        <td colspan="2"><hr></td>
      </tr>
  </table>
  
  <table width="100%" border="1" style="font-size: 12px;">
    <thead>
    <tr>
      <th align="center" height="30" width="5%"> #</th>
      <th align="center" width="15%">Nama Anggota</th>
      <!-- <th align="center" style="font-size: 12px;">Tanggal</th> -->
      <th align="center" style="font-size: 12px;">Mesin Cuci</th>
      <th align="center" style="font-size: 12px;">Kasur</th>
      <th align="center" style="font-size: 12px;">TV</th>
      <th align="center" style="font-size: 12px;">Emas</th>
      <th align="center" style="font-size: 12px;">Lemari Baju</th>


    </tr>
    <tr>
      <td colspan="7"></td>
    </tr>
    </thead>
    <?php 
    $i = 1; 
    $total_sudah_bayar_mesincuci=0;
    $total_sudah_bayar_kasur=0;
    $total_sudah_bayar_tv=0;
    $total_sudah_bayar_emas=0;
    $total_sudah_bayar_lemaribaju=0;


    $total_sisa_pinjaman=0;
    $total_harga_pokok=0;
    ?>
      @foreach ($anggota as $anggota)
      <?php
        $pinjaman_mesincuci = DB::select("SELECT * from sp_pinjaman where anggota_nomor = '$anggota->anggota_nomor' and pinjaman_jasa = 20 and pinjaman_status='Aktif' and pinjaman_tanggal between '$tgl_awal' and '$tgl_akhir'");
        $pinjaman_kasur = DB::select("SELECT * from sp_pinjaman where anggota_nomor = '$anggota->anggota_nomor' and pinjaman_jasa = 22 and pinjaman_status='Aktif' and pinjaman_tanggal between '$tgl_awal' and '$tgl_akhir'");
        $pinjaman_tv = DB::select("SELECT * from sp_pinjaman where anggota_nomor = '$anggota->anggota_nomor' and pinjaman_jasa = 18 and pinjaman_status='Aktif' and pinjaman_tanggal between '$tgl_awal' and '$tgl_akhir'");
        $pinjaman_emas = DB::select("SELECT * from sp_pinjaman where anggota_nomor = '$anggota->anggota_nomor' and pinjaman_jasa = 24 and pinjaman_status='Aktif' and pinjaman_tanggal between '$tgl_awal' and '$tgl_akhir'");
        $pinjaman_lemaribaju = DB::select("SELECT * from sp_pinjaman where anggota_nomor = '$anggota->anggota_nomor' and pinjaman_jasa = 25 and pinjaman_status='Aktif' and pinjaman_tanggal between '$tgl_awal' and '$tgl_akhir'");


        
        //mesin cuci
        $total_mesincuci_anggota =0;
        foreach ($pinjaman_mesincuci as $pinjaman_mesincuci) {
          $belumlunas_mesincuci = DB::select("SELECT SUM(angsuran_total) as total from sp_angsuran WHERE id_pinjaman = '$pinjaman_mesincuci->id_pinjaman' and angsuran_status='Belum Lunas'");
          
          foreach ($belumlunas_mesincuci as $mesincuci) {
            $total_belum_lunas_mesincuci = $mesincuci->total;
          }

          $total_mesincuci_anggota += $total_belum_lunas_mesincuci;
          $total_sudah_bayar_mesincuci += $total_belum_lunas_mesincuci;
        }

        //kasur
        $total_kasur_anggota =0;
        foreach ($pinjaman_kasur as $pinjaman_kasur) {
          $belumlunas_kasur = DB::select("SELECT SUM(angsuran_total) as total from sp_angsuran WHERE id_pinjaman = '$pinjaman_kasur->id_pinjaman' and angsuran_status='Belum Lunas'");
          
          foreach ($belumlunas_kasur as $kasur) {
            $total_belum_lunas_kasur = $kasur->total;
          }

          $total_kasur_anggota += $total_belum_lunas_kasur;
          $total_sudah_bayar_kasur += $total_belum_lunas_kasur;
        }

        //TV
        $total_tv_anggota =0;
        foreach ($pinjaman_tv as $pinjaman_tv) {
          $belumlunas_tv = DB::select("SELECT SUM(angsuran_total) as total from sp_angsuran WHERE id_pinjaman = '$pinjaman_tv->id_pinjaman' and angsuran_status='Belum Lunas'");
          
          foreach ($belumlunas_tv as $tv) {
            $total_belum_lunas_tv = $tv->total;
          }

          $total_tv_anggota += $total_belum_lunas_tv;
          $total_sudah_bayar_tv += $total_belum_lunas_tv;
        }

        //EMAS
        $total_emas_anggota =0;
        foreach ($pinjaman_emas as $pinjaman_emas) {
          $belumlunas_emas = DB::select("SELECT SUM(angsuran_total) as total from sp_angsuran WHERE id_pinjaman = '$pinjaman_emas->id_pinjaman' and angsuran_status='Belum Lunas'");
          
          foreach ($belumlunas_emas as $emas) {
            $total_belum_lunas_emas = $emas->total;
          }

          $total_emas_anggota += $total_belum_lunas_emas;
          $total_sudah_bayar_emas += $total_belum_lunas_emas;
        }

        //Lemari Baju
        $total_lemaribaju_anggota =0;
        foreach ($pinjaman_lemaribaju as $pinjaman_lemaribaju) {
          $belumlunas_lemaribaju = DB::select("SELECT SUM(angsuran_total) as total from sp_angsuran WHERE id_pinjaman = '$pinjaman_lemaribaju->id_pinjaman' and angsuran_status='Belum Lunas'");
          
          foreach ($belumlunas_lemaribaju as $lemaribaju) {
            $total_belum_lunas_lemaribaju = $lemaribaju->total;
          }

          $total_lemaribaju_anggota += $total_belum_lunas_lemaribaju;
          $total_sudah_bayar_lemaribaju += $total_belum_lunas_lemaribaju;
        }

       

        if($total_mesincuci_anggota >1 || $total_kasur_anggota >1 || $total_tv_anggota >1 || $total_emas_anggota >1 || $total_lemaribaju_anggota >1){
      ?>
        
        <tr>
          <td align="center" style="padding: 3px;">{{$i++}}</td>
          <td style="padding: 3px;">{{$anggota->anggota_nama}}</td>
          <td align="right" style="padding-right: 3px;"><?php echo number_format($total_mesincuci_anggota, 0,",","."); ?></td>
          <td align="right" style="padding-right: 3px;"><?php echo number_format($total_kasur_anggota, 0,",","."); ?></td>
          <td align="right" style="padding-right: 3px;"><?php echo number_format($total_tv_anggota, 0,",","."); ?></td>
          <td align="right" style="padding-right: 3px;"><?php echo number_format($total_emas_anggota, 0,",","."); ?></td>
          <td align="right" style="padding-right: 3px;"><?php echo number_format($total_lemaribaju_anggota, 0,",","."); ?></td>

        </tr>

        <?php } ?>
    @endforeach
        <tr>
          <td align="center" height="20" colspan="2"><b>Jumlah</b></td>
          <td align="right" style="padding-right: 3px;"><b><?php echo number_format($total_sudah_bayar_mesincuci, 0,",","."); ?></b></td>
          <td align="right" style="padding-right: 3px;"><b><?php echo number_format($total_sudah_bayar_kasur, 0,",","."); ?></b></td>
          <td align="right" style="padding-right: 3px;"><b><?php echo number_format($total_sudah_bayar_tv, 0,",","."); ?></b></td>
          <td align="right" style="padding-right: 3px;"><b><?php echo number_format($total_sudah_bayar_emas, 0,",","."); ?></b></td>
          <td align="right" style="padding-right: 3px;"><b><?php echo number_format($total_sudah_bayar_lemaribaju, 0,",","."); ?></b></td>


        </tr>
    
  </table>
  <br><br>
  <table width="20%" border="1" style="font-size: 12px;">
    <tr>
      <td height="40" align="center"><b>Total</b></td>
      <td align="center">
        <?php 
          $semua = $total_sudah_bayar_mesincuci + $total_sudah_bayar_kasur + $total_sudah_bayar_tv + $total_sudah_bayar_emas + $total_sudah_bayar_lemaribaju; ?>
          <b>Rp. <?php echo number_format($semua, 0,",","."); ?></b>
      </td>
    </tr>
  </table>
  </main>


</body>
</html>
