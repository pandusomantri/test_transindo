<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Laporan Simpanan [{{$tgl_awal}} - {{$tgl_akhir}}]</title>
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
        $x = 900;
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
    
  <table width="100%" border="0" class="halawal">
      <tr>
        <!-- <td align="left" width="30%"><img src="smp_eraport/logokiri.jpg" height="50px" width="180px"></td> -->
        <td align="center" width="100%"><b>LAPORAN SIMPANAN KOPEGSAF</b><br><span>Tanggal <?php echo tgl_indo($tgl_awal); ?> - <?php echo tgl_indo($tgl_akhir); ?></span></td>
        <!-- <td align="right" width="20%"><img src="smp_eraport/logokanan.jpg" height="40px" width="120px"></td> -->
      </tr>
      <tr>
        <td colspan="1"><hr></td>
      </tr>
  </table>
  
  <table width="100%" border="1" style="font-size: 12px;">
    <thead>
    <tr>
      <th align="center" height="30" rowspan="2" width="3%"> #</th>
      <th align="center" rowspan="2" width="14%">Nama Anggota</th>
      <th align="center" colspan="6" width="37%">Simpanan</th>
      <th align="center" colspan="6" width="37%">Pengambilan</th>
      <th align="center" rowspan="2" width="9%">Saldo Simpanan</th>
    </tr>
    <tr>
      <th align="center" style="font-size: 12px;">Pokok</th>

      <th align="center" style="font-size: 12px;">Wajib</th>
      <th align="center" style="font-size: 12px;">Sukarela</th>
      <th align="center" style="font-size: 12px;">Qurban</th>
      <th align="center" style="font-size: 12px;">Lebaran</th>
      <th align="center" style="font-size: 12px;">Pendidikan</th>

      <th align="center" style="font-size: 12px;">Pokok</th>
      <th align="center" style="font-size: 12px;">Wajib</th>
      <th align="center" style="font-size: 12px;">Sukarela</th>
      <th align="center" style="font-size: 12px;">Qurban</th>
      <th align="center" style="font-size: 12px;">Lebaran</th>
      <th align="center" style="font-size: 12px;">Pendidikan</th>
    </tr>
    <tr>
      <td colspan="15"></td>
    </tr>
    </thead>
    <?php $i=1;
      $total_pokok      = 0;
      $total_wajib      = 0;
      $total_sukarela   = 0;
      $total_qurban     = 0;
      $total_lebaran    = 0;
      $total_pendidikan = 0;

      $total_pokok_tarik      = 0;
      $total_wajib_tarik      = 0;
      $total_sukarela_tarik   = 0;
      $total_qurban_tarik     = 0;
      $total_lebaran_tarik    = 0;
      $total_pendidikan_tarik = 0;
    ?>
    @foreach($anggota as $anggota)
    <?php 

        $simpan_pokok = DB::select("select sum(simpanan_besar) as simpanan_besar from sp_simpanan where jenis_simpanan_id='S001' and anggota_nomor='$anggota->anggota_nomor' and simpanan_tanggal between '$tgl_awal' and '$tgl_akhir'");
        $simpan_wajib = DB::select("select sum(simpanan_besar) as simpanan_besar from sp_simpanan where jenis_simpanan_id='S002' and anggota_nomor='$anggota->anggota_nomor' and simpanan_tanggal between '$tgl_awal' and '$tgl_akhir'");
        $simpan_sukarela = DB::select("select sum(simpanan_besar) as simpanan_besar from sp_simpanan where jenis_simpanan_id='S003' and anggota_nomor='$anggota->anggota_nomor' and simpanan_tanggal between '$tgl_awal' and '$tgl_akhir'");
        $simpan_qurban = DB::select("select sum(simpanan_besar) as simpanan_besar from sp_simpanan where jenis_simpanan_id='S004' and anggota_nomor='$anggota->anggota_nomor' and simpanan_tanggal between '$tgl_awal' and '$tgl_akhir'");
        $simpan_lebaran = DB::select("select sum(simpanan_besar) as simpanan_besar from sp_simpanan where jenis_simpanan_id='S005' and anggota_nomor='$anggota->anggota_nomor' and simpanan_tanggal between '$tgl_awal' and '$tgl_akhir'");
        $simpan_pendidikan = DB::select("select sum(simpanan_besar) as simpanan_besar from sp_simpanan where jenis_simpanan_id='S006' and anggota_nomor='$anggota->anggota_nomor' and simpanan_tanggal between '$tgl_awal' and '$tgl_akhir'");

        $tarik_pokok = DB::select("select sum(penarikan_besar) as penarikan_besar from sp_penarikan where jenis_simpanan_id='S001' and anggota_nomor='$anggota->anggota_nomor' and penarikan_tanggal between '$tgl_awal' and '$tgl_akhir'");
        $tarik_wajib = DB::select("select sum(penarikan_besar) as penarikan_besar from sp_penarikan where jenis_simpanan_id='S002' and anggota_nomor='$anggota->anggota_nomor' and penarikan_tanggal between '$tgl_awal' and '$tgl_akhir'");
        $tarik_sukarela = DB::select("select sum(penarikan_besar) as penarikan_besar from sp_penarikan where jenis_simpanan_id='S003' and anggota_nomor='$anggota->anggota_nomor' and penarikan_tanggal between '$tgl_awal' and '$tgl_akhir'");
        $tarik_qurban = DB::select("select sum(penarikan_besar) as penarikan_besar from sp_penarikan where jenis_simpanan_id='S004' and anggota_nomor='$anggota->anggota_nomor' and penarikan_tanggal between '$tgl_awal' and '$tgl_akhir'");
        $tarik_lebaran = DB::select("select sum(penarikan_besar) as penarikan_besar from sp_penarikan where jenis_simpanan_id='S005' and anggota_nomor='$anggota->anggota_nomor' and penarikan_tanggal between '$tgl_awal' and '$tgl_akhir'");
        $tarik_pendidikan = DB::select("select sum(penarikan_besar) as penarikan_besar from sp_penarikan where jenis_simpanan_id='S006' and anggota_nomor='$anggota->anggota_nomor' and penarikan_tanggal between '$tgl_awal' and '$tgl_akhir'");

        foreach ($simpan_pokok as $simpan_pokok) {
          $jum_simpanan_pokok = $simpan_pokok->simpanan_besar;
          foreach ($simpan_wajib as $simpan_wajib) {
            $jum_simpanan_wajib = $simpan_wajib->simpanan_besar;
            foreach ($simpan_sukarela as $simpan_sukarela) {
              $jum_simpanan_sukarela = $simpan_sukarela->simpanan_besar;
              foreach ($simpan_qurban as $simpan_qurban) {
                $jum_simpanan_qurban = $simpan_qurban->simpanan_besar;
                foreach ($simpan_lebaran as $simpan_lebaran) {
                  $jum_simpanan_lebaran = $simpan_lebaran->simpanan_besar;
                  foreach ($simpan_pendidikan as $simpan_pendidikan) {
                    $jum_simpanan_pendidikan = $simpan_pendidikan->simpanan_besar;
                    $jum_simpanan = $jum_simpanan_pokok + $jum_simpanan_wajib + $jum_simpanan_sukarela + $jum_simpanan_qurban + $jum_simpanan_lebaran + $jum_simpanan_pendidikan;
                  }
                }
              }
            }
          }
        }

        foreach ($tarik_pokok as $tarik_pokok) {
          $jum_penarikan_pokok = $tarik_pokok->penarikan_besar;
          foreach ($tarik_wajib as $tarik_wajib) {
            $jum_penarikan_wajib = $tarik_wajib->penarikan_besar;
            foreach ($tarik_sukarela as $tarik_sukarela) {
              $jum_penarikan_sukarela = $tarik_sukarela->penarikan_besar;
              foreach ($tarik_qurban as $tarik_qurban) {
                $jum_penarikan_qurban = $tarik_qurban->penarikan_besar;
                foreach ($tarik_lebaran as $tarik_lebaran) {
                  $jum_penarikan_lebaran = $tarik_lebaran->penarikan_besar;
                  foreach ($tarik_pendidikan as $tarik_pendidikan) {
                    $jum_penarikan_pendidikan = $tarik_pendidikan->penarikan_besar;
                    $jum_penarikan = $jum_penarikan_pokok + $jum_penarikan_wajib + $jum_penarikan_sukarela + $jum_penarikan_qurban + $jum_penarikan_lebaran + $jum_penarikan_pendidikan;
                  }
                }
              }
            }
          }
        }


        $saldo_simpanan = $jum_simpanan - $jum_penarikan;

        $total_pokok      += $jum_simpanan_pokok;
        $total_wajib      += $jum_simpanan_wajib;
        $total_sukarela   += $jum_simpanan_sukarela;
        $total_qurban     += $jum_simpanan_qurban;
        $total_lebaran    += $jum_simpanan_lebaran;
        $total_pendidikan += $jum_simpanan_pendidikan;

        $total_pokok_tarik      += $jum_penarikan_pokok;
        $total_wajib_tarik      += $jum_penarikan_wajib;
        $total_sukarela_tarik   += $jum_penarikan_sukarela;
        $total_qurban_tarik     += $jum_penarikan_qurban;
        $total_lebaran_tarik    += $jum_penarikan_lebaran;
        $total_pendidikan_tarik += $jum_penarikan_pendidikan;


        $total_simpanan   = $total_pokok + $total_wajib + $total_sukarela + $total_qurban + $total_lebaran + $total_pendidikan;
        $total_penarikan  = $total_pokok_tarik + $total_wajib_tarik + $total_sukarela_tarik + $total_qurban_tarik + $total_lebaran_tarik + $total_pendidikan_tarik;
       
        
        $total = $total_simpanan - $total_penarikan;
       ?>

       
    <tr>
      <td align="center">{{$i++}}</td>
      <td style="padding: 3px;">{{$anggota->anggota_nama}}</td>

      <td align="right" style="padding-right: 3px;"><?php echo number_format($jum_simpanan_pokok, 0,",","."); ?></td>
      <td align="right" style="padding-right: 3px;"><?php echo number_format($jum_simpanan_wajib, 0,",","."); ?></td>
      <td align="right" style="padding-right: 3px;"><?php echo number_format($jum_simpanan_sukarela, 0,",","."); ?></td>
      <td align="right" style="padding-right: 3px;"><?php echo number_format($jum_simpanan_qurban, 0,",","."); ?></td>
      <td align="right" style="padding-right: 3px;"><?php echo number_format($jum_simpanan_lebaran, 0,",","."); ?></td>
      <td align="right" style="padding-right: 3px;"><?php echo number_format($jum_simpanan_pendidikan, 0,",","."); ?></td>
      
      <td align="right" style="padding-right: 3px;"><?php echo number_format($jum_penarikan_pokok, 0,",","."); ?></td>
      <td align="right" style="padding-right: 3px;"><?php echo number_format($jum_penarikan_wajib, 0,",","."); ?></td>
      <td align="right" style="padding-right: 3px;"><?php echo number_format($jum_penarikan_sukarela, 0,",","."); ?></td>
      <td align="right" style="padding-right: 3px;"><?php echo number_format($jum_penarikan_qurban, 0,",","."); ?></td>
      <td align="right" style="padding-right: 3px;"><?php echo number_format($jum_penarikan_lebaran, 0,",","."); ?></td>
      <td align="right" style="padding-right: 3px;"><?php echo number_format($jum_penarikan_pendidikan, 0,",","."); ?></td>

      <td align="right" style="padding-right: 3px;"><?php echo number_format($saldo_simpanan, 0,",","."); ?></td>
    </tr>
    @endforeach
    <tr>
      <td colspan="2" align="center" height="20" style="font-weight: bold;">Total</td>
      <td align="right" style="padding-right: 3px; font-weight: bold;"><?php echo number_format($total_pokok, 0,",","."); ?></td>
      <td align="right" style="padding-right: 3px; font-weight: bold;"><?php echo number_format($total_wajib, 0,",","."); ?></td>
      <td align="right" style="padding-right: 3px; font-weight: bold;"><?php echo number_format($total_sukarela, 0,",","."); ?></td>
      <td align="right" style="padding-right: 3px; font-weight: bold;"><?php echo number_format($total_qurban, 0,",","."); ?></td>
      <td align="right" style="padding-right: 3px; font-weight: bold;"><?php echo number_format($total_lebaran, 0,",","."); ?></td>
      <td align="right" style="padding-right: 3px; font-weight: bold;"><?php echo number_format($total_pendidikan, 0,",","."); ?></td>

      <td align="right" style="padding-right: 3px; font-weight: bold;"><?php echo number_format($total_pokok_tarik, 0,",","."); ?></td>
      <td align="right" style="padding-right: 3px; font-weight: bold;"><?php echo number_format($total_wajib_tarik, 0,",","."); ?></td>
      <td align="right" style="padding-right: 3px; font-weight: bold;"><?php echo number_format($total_sukarela_tarik, 0,",","."); ?></td>
      <td align="right" style="padding-right: 3px; font-weight: bold;"><?php echo number_format($total_qurban_tarik, 0,",","."); ?></td>
      <td align="right" style="padding-right: 3px; font-weight: bold;"><?php echo number_format($total_lebaran_tarik, 0,",","."); ?></td>
      <td align="right" style="padding-right: 3px; font-weight: bold;"><?php echo number_format($total_pendidikan_tarik, 0,",","."); ?></td>
      <td align="right" style="padding-right: 3px; font-weight: bold;"><?php echo number_format($total, 0,",","."); ?></td>
    </tr>
  </table>
    
  </main>


</body>
</html>
