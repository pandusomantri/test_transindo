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
        <td align="center" width="95%"><b>LAPORAN PINJAMAN KOPEGSAF</b><br><span>Sampai dengan tanggal <?php echo tgl_indo($tgl_akhir); ?></span><br> Kategori Pembiayaan, Kendaraan, Handphone, Laptop, Lemari Es</td>
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
      <th align="center" style="font-size: 12px;">Pembiayaan</th>
      <th align="center" style="font-size: 12px;">Kendaraan</th>
      <th align="center" style="font-size: 12px;">Handphone</th>
      <th align="center" style="font-size: 12px;">Laptop</th>
      <th align="center" style="font-size: 12px;">Lemari Es</th>


    </tr>
    <tr>
      <td colspan="7"></td>
    </tr>
    </thead>
    <?php 
    $i = 1; 
    $total_sudah_bayar_pembiayaan=0;
    $total_sudah_bayar_kendaraan=0;
    $total_sudah_bayar_handphone=0;
    $total_sudah_bayar_laptop=0;
    $total_sudah_bayar_lemaries=0;


    $total_sisa_pinjaman=0;
    $total_harga_pokok=0;
    ?>
      @foreach ($anggota as $anggota)
      <?php
        $pinjaman_pembiayaan = DB::select("SELECT * from sp_pinjaman where anggota_nomor = '$anggota->anggota_nomor' and pinjaman_jasa = 3 and pinjaman_status='Aktif' and pinjaman_tanggal between '$tgl_awal' and '$tgl_akhir'");
        $pinjaman_kendaraan = DB::select("SELECT * from sp_pinjaman where anggota_nomor = '$anggota->anggota_nomor' and pinjaman_jasa = 1 and pinjaman_status='Aktif' and pinjaman_tanggal between '$tgl_awal' and '$tgl_akhir'");
        $pinjaman_handphone = DB::select("SELECT * from sp_pinjaman where anggota_nomor = '$anggota->anggota_nomor' and pinjaman_jasa = 16 and pinjaman_status='Aktif' and pinjaman_tanggal between '$tgl_awal' and '$tgl_akhir'");
        $pinjaman_laptop = DB::select("SELECT * from sp_pinjaman where anggota_nomor = '$anggota->anggota_nomor' and pinjaman_jasa = 17 and pinjaman_status='Aktif' and pinjaman_tanggal between '$tgl_awal' and '$tgl_akhir'");
        $pinjaman_lemaries = DB::select("SELECT * from sp_pinjaman where anggota_nomor = '$anggota->anggota_nomor' and pinjaman_jasa = 19 and pinjaman_status='Aktif' and pinjaman_tanggal between '$tgl_awal' and '$tgl_akhir'");


        //Pembiayaan
        $total_pembiayaan_anggota =0;
        foreach ($pinjaman_pembiayaan as $pinjaman_pembiayaan) {
          $belumlunas_pembiayaan = DB::select("SELECT SUM(angsuran_total) as total from sp_angsuran WHERE id_pinjaman = '$pinjaman_pembiayaan->id_pinjaman' and angsuran_status='Belum Lunas'");
          
          foreach ($belumlunas_pembiayaan as $pembiayaan) {
            $total_belum_lunas_pembiayaan = $pembiayaan->total;
          }

          $total_pembiayaan_anggota += $total_belum_lunas_pembiayaan;
          $total_sudah_bayar_pembiayaan += $total_belum_lunas_pembiayaan;
        }

        //kendaraan
        $total_kendaraan_anggota =0;
        foreach ($pinjaman_kendaraan as $pinjaman_kendaraan) {
          $belumlunas_kendaraan = DB::select("SELECT SUM(angsuran_total) as total from sp_angsuran WHERE id_pinjaman = '$pinjaman_kendaraan->id_pinjaman' and angsuran_status='Belum Lunas'");
          
          foreach ($belumlunas_kendaraan as $kendaraan) {
            $total_belum_lunas_kendaraan = $kendaraan->total;
          }

          $total_kendaraan_anggota += $total_belum_lunas_kendaraan;
          $total_sudah_bayar_kendaraan += $total_belum_lunas_kendaraan;
        }

        //handphone
        $total_hp_anggota =0;
        foreach ($pinjaman_handphone as $pinjaman_handphone) {
          $belumlunas_hp = DB::select("SELECT SUM(angsuran_total) as total from sp_angsuran WHERE id_pinjaman = '$pinjaman_handphone->id_pinjaman' and angsuran_status='Belum Lunas'");
          
          foreach ($belumlunas_hp as $hp) {
            $total_belum_lunas_hp = $hp->total;
          }

          $total_hp_anggota += $total_belum_lunas_hp;
          $total_sudah_bayar_handphone += $total_belum_lunas_hp;
        }

        //laptop
        $total_laptop_anggota =0;
        foreach ($pinjaman_laptop as $pinjaman_laptop) {
          $belumlunas_laptop = DB::select("SELECT SUM(angsuran_total) as total from sp_angsuran WHERE id_pinjaman = '$pinjaman_laptop->id_pinjaman' and angsuran_status='Belum Lunas'");
          
          foreach ($belumlunas_laptop as $laptop) {
            $total_belum_lunas_laptop = $laptop->total;
          }

          $total_laptop_anggota += $total_belum_lunas_laptop;
          $total_sudah_bayar_laptop += $total_belum_lunas_laptop;
        }

        //lemari es
        $total_lemaries_anggota =0;
        foreach ($pinjaman_lemaries as $pinjaman_lemaries) {
          $belumlunas_lemaries = DB::select("SELECT SUM(angsuran_total) as total from sp_angsuran WHERE id_pinjaman = '$pinjaman_lemaries->id_pinjaman' and angsuran_status='Belum Lunas'");
          
          foreach ($belumlunas_lemaries as $lemaries) {
            $total_belum_lunas_lemaries = $lemaries->total;
          }

          $total_lemaries_anggota += $total_belum_lunas_lemaries;
          $total_sudah_bayar_lemaries += $total_belum_lunas_lemaries;
        }

               

        if($total_pembiayaan_anggota >1 || $total_kendaraan_anggota >1 || $total_hp_anggota >1 || $total_laptop_anggota >1 || $total_lemaries_anggota >1){
      ?>
        
        <tr>
          <td align="center" style="padding: 3px;">{{$i++}}</td>
          <td style="padding: 3px;">{{$anggota->anggota_nama}}</td>
          <td align="right" style="padding-right: 3px;"><?php echo number_format($total_pembiayaan_anggota, 0,",","."); ?></td>
          <td align="right" style="padding-right: 3px;"><?php echo number_format($total_kendaraan_anggota, 0,",","."); ?></td>
          <td align="right" style="padding-right: 3px;"><?php echo number_format($total_hp_anggota, 0,",","."); ?></td>
          <td align="right" style="padding-right: 3px;"><?php echo number_format($total_laptop_anggota, 0,",","."); ?></td>
          <td align="right" style="padding-right: 3px;"><?php echo number_format($total_lemaries_anggota, 0,",","."); ?></td>

        </tr>

        <?php } ?>
    @endforeach
        <tr>
          <td align="center" height="20" colspan="2"><b>Jumlah</b></td>
          <td align="right" style="padding-right: 3px;"><b><?php echo number_format($total_sudah_bayar_pembiayaan, 0,",","."); ?></b></td>
          <td align="right" style="padding-right: 3px;"><b><?php echo number_format($total_sudah_bayar_kendaraan, 0,",","."); ?></b></td>
          <td align="right" style="padding-right: 3px;"><b><?php echo number_format($total_sudah_bayar_handphone, 0,",","."); ?></b></td>
          <td align="right" style="padding-right: 3px;"><b><?php echo number_format($total_sudah_bayar_laptop, 0,",","."); ?></b></td>
          <td align="right" style="padding-right: 3px;"><b><?php echo number_format($total_sudah_bayar_lemaries, 0,",","."); ?></b></td>

        </tr>
    
  </table>
  <br><br>
  <table width="20%" border="1" style="font-size: 12px;">
    <tr>
      <td height="40" align="center"><b>Total</b></td>
      <td align="center">
        <?php 
          $semua = $total_sudah_bayar_pembiayaan + $total_sudah_bayar_kendaraan + $total_sudah_bayar_handphone + $total_sudah_bayar_laptop + $total_sudah_bayar_lemaries; ?>
          <b>Rp. <?php echo number_format($semua, 0,",","."); ?></b>
      </td>
    </tr>
  </table>
  </main>


</body>
</html>
