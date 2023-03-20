<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Laporan Pinjaman TPA, Pembiayaan Lunak, dan Rumas Sakit [ <?php echo tgl_indo($tgl_akhir); ?> ]</title>
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
        <td align="center" width="95%"><b>LAPORAN PINJAMAN KOPEGSAF</b><br><span>Sampai dengan tanggal <?php echo tgl_indo($tgl_akhir); ?></span><br>Kategori TPA, Pembiayaan Lunak dan Rumah Sakit</td>
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
      <th align="center" width="25%">Nama Anggota</th>
      <!-- <th align="center" style="font-size: 12px;">Tanggal</th> -->
      <!-- <th align="center" style="font-size: 12px;">Pembiayaan</th> -->
      <th align="center" style="font-size: 12px;">TPA</th>
      <th align="center" style="font-size: 12px;">Pembiayaan Lunak</th>
      <!-- <th align="center" style="font-size: 12px;">Handphone</th> -->
      <!-- <th align="center" style="font-size: 12px;">Laptop</th> -->
      <!-- <th align="center" style="font-size: 12px;">Lemari Es</th> -->
      <!-- <th align="center" style="font-size: 12px;">Mesin Cuci</th> -->
      <!-- <th align="center" style="font-size: 12px;">Kasur</th> -->
      <th align="center" style="font-size: 12px;">Rumah Sakit</th>
    </tr>
    <tr>
      <td colspan="5"></td>
    </tr>
    </thead>
    <?php 
    $i = 1; 
    
    $total_sudah_bayar_tpa=0;
    $total_sudah_bayar_lunak=0;
    $total_sudah_bayar_rs=0;

    $total_sisa_pinjaman=0;
    $total_harga_pokok=0;
    ?>
      @foreach ($anggota as $anggota)
      <?php
        $pinjaman_tpa = DB::select("SELECT * from sp_pinjaman where anggota_nomor = '$anggota->anggota_nomor' and pinjaman_jasa = 0 and pinjaman_status='Aktif' and pinjaman_tanggal between '$tgl_awal' and '$tgl_akhir'");
        $pinjaman_lunak = DB::select("SELECT * from sp_pinjaman where anggota_nomor = '$anggota->anggota_nomor' and pinjaman_jasa = 21 and pinjaman_status='Aktif' and pinjaman_tanggal between '$tgl_awal' and '$tgl_akhir'");
        $pinjaman_rs = DB::select("SELECT * from sp_pinjaman where anggota_nomor = '$anggota->anggota_nomor' and pinjaman_jasa = 23 and pinjaman_status='Aktif' and pinjaman_tanggal between '$tgl_awal' and '$tgl_akhir'");
        

        //TPA
        $total_tpa_anggota =0;
        foreach ($pinjaman_tpa as $pinjaman_tpa) {
          $belumlunas_tpa = DB::select("SELECT SUM(angsuran_total) as total from sp_angsuran WHERE id_pinjaman = '$pinjaman_tpa->id_pinjaman' and angsuran_status='Belum Lunas'");
          
          foreach ($belumlunas_tpa as $tpa) {
            $total_belum_lunas_tpa = $tpa->total;
          }

          $total_tpa_anggota += $total_belum_lunas_tpa;
          $total_sudah_bayar_tpa += $total_belum_lunas_tpa;
        }

        //Pembiayaan Lunak
        $total_lunak_anggota =0;
        foreach ($pinjaman_lunak as $pinjaman_lunak) {
          $belumlunas_lunak = DB::select("SELECT SUM(angsuran_total) as total from sp_angsuran WHERE id_pinjaman = '$pinjaman_lunak->id_pinjaman' and angsuran_status='Belum Lunas'");
          
          foreach ($belumlunas_lunak as $lunak) {
            $total_belum_lunas_lunak = $lunak->total;
          }

          $total_lunak_anggota += $total_belum_lunas_lunak;
          $total_sudah_bayar_lunak += $total_belum_lunas_lunak;
        }       

        //rumah sakit
        $total_rs_anggota =0;
        foreach ($pinjaman_rs as $pinjaman_rs) {
          $belumlunas_rs = DB::select("SELECT SUM(angsuran_total) as total from sp_angsuran WHERE id_pinjaman = '$pinjaman_rs->id_pinjaman' and angsuran_status='Belum Lunas'");
          
          foreach ($belumlunas_rs as $rs) {
            $total_belum_lunas_rs = $rs->total;
          }

          $total_rs_anggota += $total_belum_lunas_rs;
          $total_sudah_bayar_rs += $total_belum_lunas_rs;
        }

        if($total_tpa_anggota >1 || $total_lunak_anggota >1 || $total_rs_anggota >1){
      ?>
        
        <tr>
          <td align="center" style="padding: 3px;">{{$i++}}</td>
          <td style="padding: 3px;">{{$anggota->anggota_nama}}</td>
          <td align="right" style="padding-right: 3px;"><?php echo number_format($total_tpa_anggota, 0,",","."); ?></td>
          <td align="right" style="padding-right: 3px;"><?php echo number_format($total_lunak_anggota, 0,",","."); ?></td>
          <td align="right" style="padding-right: 3px;"><?php echo number_format($total_rs_anggota, 0,",","."); ?></td>

        </tr>
      <?php } ?>
    @endforeach
        <tr>
          <td align="center" height="20" colspan="2"><b>Jumlah</b></td>
          <td align="right" style="padding-right: 3px;"><b><?php echo number_format($total_sudah_bayar_tpa, 0,",","."); ?></b></td>
          <td align="right" style="padding-right: 3px;"><b><?php echo number_format($total_sudah_bayar_lunak, 0,",","."); ?></b></td>
          <td align="right" style="padding-right: 3px;"><b><?php echo number_format($total_sudah_bayar_rs, 0,",","."); ?></b></td>s
        </tr>
    
  </table>
  <br><br>
  <table width="30%" border="1" style="font-size: 12px;">
    <tr>
      <td height="40" align="center"><b>Total</b></td>
      <td align="center">
        <?php 
          $semua = $total_sudah_bayar_tpa + $total_sudah_bayar_lunak + $total_sudah_bayar_rs; ?>
          <b>Rp. <?php echo number_format($semua, 0,",","."); ?></b>
      </td>
    </tr>
  </table>
  </main>


</body>
</html>
