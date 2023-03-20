<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Laporan Berita Acara</title>
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
        $y = 580;
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
    @php
        $tanggal = $tgl_awal;
        $day = date('D', strtotime($tanggal));
        $dayList = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu'
        );
    @endphp 
    <table width="95%" border="0" class="halawal">
        <tr>
            <td align="center" width="95%"><b>LAPORAN BERITA ACARA<br>SERAH TERIMA KAS OPERASIONAL KOPEGSAF</b></td>
            <td align="right" width="5%"><b>LEGAL</b></td>
        </tr>
        <tr>
            <td colspan="2"><hr></td>
        </tr>
    </table>
    <div style=" font-weight:bold;">
        <table border="0" width="100%">
            <tr>
                <td colspan="3">Saldo awal kas </td>
                <td align="right"><?php echo $dayList[$day]; ?>, <?php echo tgl_indo($tanggal);?></td>
            </tr>
            <tr>
                <td width="10%">Kasir pusat</td>
                <td width="1%">:</td>
                <td width="15%" align="right">
                    @foreach($saldo_kasir_pusat as $saldo_kasir)
                        <?php
                            $saldo_awal_kasir = $saldo_kasir->kas_nominal;
                            echo number_format($saldo_awal_kasir,0,',','.'); 
                        ?>
                    @endforeach
                </td>
                <td width="74%"></td>
                
            </tr>
            <tr>
                <td>BSI</td>
                <td>:</td>
                <td align="right">
                    @foreach($saldo_bsi as $saldo_bsi)
                        <?php
                            $saldo_awal_bsi = $saldo_bsi->kas_nominal;
                            echo number_format($saldo_awal_bsi,0,',','.'); 
                        ?>
                    @endforeach
                </td>
            </tr>
        </table> 
    </div>
    <div style="padding: 5px;">
        <b>Pemasukan </b>
        <hr>
    </div>
    <table width="100%" border="1" style="font-size: 12px;">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="25%">Nama Anggota</th>
                <th width="40%">Keterangan</th>
                <th width="15%">Pembayaran</th>
                <th width="15%">Jumlah</th>
            </tr>
        </thead>
        <?php 
            $i=1;
            $j=0;
            $total_pemasukan_tunai = 0;
            $total_pemasukan_transfer = 0;
            $total=0;
        ?>
        <tbody>
            @foreach($pemasukan_tunai as $pemasukan_tunai)
                @php
                    $anggota = DB::select("SELECT anggota_nama FROM anggota WHERE anggota_nomor='$pemasukan_tunai->pemasukan_anggota'"); 
                @endphp
                <tr >
                    <td align="center">{{ $i++; }}.</td>
                    <td style="padding: 3px;">
                        <b>[{{$pemasukan_tunai->pemasukan_anggota}}]</b>
                        @foreach($anggota as $anggota)
                            {{$anggota->anggota_nama}}
                        @endforeach
                    </td>
                    <td style="padding-left: 5px;">{{$pemasukan_tunai->pemasukan_keterangan}}</td>
                    <td style="padding-left: 5px;">{{$pemasukan_tunai->pemasukan_jenis}}</td>
                    <td align="right" style="padding-right: 5px;">
                        <?php echo number_format($pemasukan_tunai->pemasukan_nominal,0,',','.'); ?>
                    </td>
                </tr>
                @php
                    $total_pemasukan_tunai += $pemasukan_tunai->pemasukan_nominal;
                @endphp
            @endforeach
            <tr>
                <td align="center">{{ $i++; }}.</td>
                <td style="padding: 3px;">
                    <b>[Toko]</b>
                </td>
                <td style="padding-left: 5px;">Setoran Toko</td>
                <td style="padding-left: 5px;">Tunai</td>
                <td align="right" style="padding-right: 5px;">
                    @foreach($tunai as $tunai)
                        <?php 
                            $tunai = $tunai->tunai_total;
                            foreach($tunai_kupon as $tunai_kupon){
                                $tunai_kupon = $tunai_kupon->tunai_kupon_total;
                            }
                            $total_toko = ($tunai - $tunai_kupon);
                            echo number_format($total_toko,0,',','.');
                            $total_pemasukan_tunai = $total_pemasukan_tunai + $total_toko;
                               
                        ?>
                    @endforeach
                </td>
            </tr>
            @foreach($pemasukan_transfer as $pemasukan_transfer)
                @php
                    $anggota = DB::select("SELECT anggota_nama FROM anggota WHERE anggota_nomor='$pemasukan_transfer->pemasukan_anggota'"); 
                @endphp
                <tr >
                    <td align="center">{{ $i++; }}.</td>
                    <td style="padding: 3px;">
                        <b>[{{$pemasukan_transfer->pemasukan_anggota}}]</b>
                        @foreach($anggota as $anggota)
                            {{$anggota->anggota_nama}}
                        @endforeach
                    </td>
                    <td style="padding-left: 5px;">{{$pemasukan_transfer->pemasukan_keterangan}}</td>
                    <td style="padding-left: 5px;">{{$pemasukan_transfer->pemasukan_jenis}}</td>
                    <td align="right" style="padding-right: 5px;">
                        <?php echo number_format($pemasukan_transfer->pemasukan_nominal,0,',','.'); ?>
                    </td>
                </tr>
                @php
                    $total_pemasukan_transfer += $pemasukan_transfer->pemasukan_nominal;
                    $total = $total_pemasukan_tunai + $total_pemasukan_transfer;
                    $j=$i-1;
                @endphp
            @endforeach
            
            <tr>
                <td colspan="4" align="center" style="padding: 3px;"><b>Total Tunai</b></td>
                <td align="center"><b>Rp. <?php echo number_format($total_pemasukan_tunai,0,',','.'); ?></b></td>
            </tr>
            <tr>
                <td colspan="4" align="center" style="padding: 3px;"><b>Total Transfer</b></td>
                <td align="center"><b>Rp. <?php echo number_format($total_pemasukan_transfer,0,',','.'); ?></b></td>
            </tr>
            <tr>
                <td colspan="4" align="center" style="padding: 3px;"><b>Total</b></td>
                <td align="center"><b>Rp. <?php echo number_format($total,0,',','.'); ?></b></td>
            </tr>
        </tbody>
    </table>

    <br>
    <div style="padding: 5px;">
        <b>Pengeluaran </b>
        <hr>
    </div>
    <table width="100%" border="1" style="font-size: 12px;">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="65%">Keterangan</th>
                <th width="15%">Pembayaran</th>
                <th width="15%">Jumlah</th>
            </tr>
        </thead>
        <?php 
            $i=1;
            $q=0;
            $total_pengeluaran_tunai = 0;
            $total_pengeluaran_transfer = 0;
            $total=0;
        ?>
        <tbody>
            @foreach($pengeluaran as $pengeluaran)
                <tr >
                    <td align="center" style="padding: 3px;">{{ $i++; }}.</td>
                    <td style="padding-left: 5px;">{{$pengeluaran->pengeluaran_keterangan}}</td>
                    <td style="padding-left: 5px;">{{$pengeluaran->pengeluaran_jenis}}</td>
                    <td align="right" style="padding-right: 5px;">
                        <?php echo number_format($pengeluaran->pengeluaran_nominal,0,',','.'); ?>
                    </td>
                </tr>
                @php
                    if($pengeluaran->pengeluaran_jenis == "Tunai"){
                        $total_pengeluaran_tunai += $pengeluaran->pengeluaran_nominal;
                    }else{
                        $total_pengeluaran_transfer += $pengeluaran->pengeluaran_nominal;
                    }
                    $total = $total_pengeluaran_tunai + $total_pengeluaran_transfer;
                    $q=$i-1;
                @endphp
            @endforeach
            <tr>
                <td colspan="3" align="center" style="padding: 3px;"><b>Total Tunai</b></td>
                <td align="center"><b>Rp. <?php echo number_format($total_pengeluaran_tunai,0,',','.'); ?></b></td>
            </tr>
            <tr>
                <td colspan="3" align="center" style="padding: 3px;"><b>Total Transfer</b></td>
                <td align="center"><b>Rp. <?php echo number_format($total_pengeluaran_transfer,0,',','.'); ?></b></td>
            </tr>
            <tr>
                <td colspan="3" align="center" style="padding: 3px;"><b>Total</b></td>
                <td align="center"><b>Rp. <?php echo number_format($total,0,',','.'); ?></b></td>
            </tr>
        </tbody>
    </table>

    <br>
    <div style="padding: 5px;">
        <b>Penyimpanan/Pengambilan </b>
        <hr>
    </div>
    <table width="100%" border="1" style="font-size: 12px;">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="15%">Kas</th>
                <th width="15%">Dari Kas</th>
                <th width="15%">Tujuan Kas</th>
                <th width="40%">Keterangan</th>
                <th width="15%">Jumlah</th>
            </tr>
        </thead>
        <?php 
            $i=1;
            $p=0;
            $total=0;
        ?>
        <tbody>
            @foreach($penyimpanan as $penyimpanan)
                <tr >
                    <td align="center" style="padding: 3px;">{{ $i++; }}.</td>
                    <td style="padding-left: 5px;">{{$penyimpanan->kas_jenis}}</td>
                    <td style="padding-left: 5px;">{{$penyimpanan->kas_dari}}</td>
                    <td style="padding-left: 5px;">{{$penyimpanan->kas_tujuan}}</td>
                    <td style="padding-left: 5px;">{{$penyimpanan->kas_keterangan}}</td>
                    <td align="right" style="padding-right: 5px;">
                        <?php echo number_format($penyimpanan->kas_nominal,0,',','.'); ?>
                    </td>
                </tr>
            @endforeach
            @foreach($pengambilan as $pengambilan)
                <tr >
                    <td align="center" style="padding: 3px;">{{ $i++; }}.</td>
                    <td style="padding-left: 5px;">{{$pengambilan->kas_jenis}}</td>
                    <td style="padding-left: 5px;">{{$pengambilan->kas_dari}}</td>
                    <td style="padding-left: 5px;">{{$pengambilan->kas_tujuan}}</td>
                    <td style="padding-left: 5px;">{{$pengambilan->kas_keterangan}}</td>
                    <td align="right" style="padding-right: 5px;">
                        <?php echo number_format($pengambilan->kas_nominal,0,',','.'); ?>
                    </td>
                </tr>
                @php
                    $p=$i-1;
                @endphp
            @endforeach
        </tbody>
    </table>

    <br>
    <table width="100%" border="1" style="font-size: 10px;">
        <thead>
            <tr>
                <th width="85%" style="padding: 5px;">Saldo Akhir Kas Kasir Pusat = (Pemasukan - Pengeluaran) + (Saldo Awal + Pengambilan ke Kas Kasir Pusat)</th>
                <th width="15%">
                    @php
                        $saldo_akhir_kasir =0;
                        $saldo_akhir_kasir = ($total_pemasukan_tunai - $total_pengeluaran_tunai) +($saldo_awal_kasir + $jum_yys_ke_kasir);
                        echo number_format($saldo_akhir_kasir,0,',','.');
                    @endphp
                </th>
            </tr>
            <tr>
                <th width="85%" style="padding: 5px;">Saldo Akhir Kas BSI = (Pemasukan - Pengeluaran - Pengambilan dari Kas BSI) + (Saldo Awal + Pengambilan ke Kas BSI)</th>
                <th width="15%">
                    @php
                        $saldo_akhir_bsi =0;
                        $saldo_akhir_bsi = ($total_pemasukan_transfer - $total_pengeluaran_transfer - $jum_bsi_ambil) +($saldo_awal_bsi + $jum_yys_ke_bsi);
                        echo number_format($saldo_akhir_bsi,0,',','.');
                    @endphp
                </th>
            </tr>
        </thead>
    </table>
    @php
        $jum_baris = $j+$q+$p;
        if($jum_baris == 25){
    @endphp
    <br>
    <div style="padding: 5px;" class="breakNow2">
        <b>Jurnal KAS </b>
        <hr>
    </div>
    <table width="100%" border="1" style="font-size: 12px;">
        <thead>
            <tr>
                <th width="25%" >Kas BSI</th>
                <th width="25%">Kas Kasir Pusat</th>
                <th width="25%">Kas di Yayasan</th>
                <th width="25%">Total Saldo</th>
            </tr>
        </thead>
        <?php 
            $tot_yys =0;
            $tot_saldo =0;
            $tot_yys = $jum_yys_simpan - $jum_yys_ambil;
        ?>
        <tbody>
            
            <tr >
                <td align="center" style="padding: 5px;">Rp. <?php echo number_format($saldo_akhir_bsi,0,',','.'); ?></td>
                <td align="center" style="padding: 5px;">Rp. <?php echo number_format($saldo_akhir_kasir,0,',','.'); ?></td>
                <td align="center" style="padding: 5px;">Rp. <?php echo number_format($tot_yys,0,',','.'); ?></td>
                @php
                    $tot_saldo = $saldo_akhir_bsi + $saldo_akhir_kasir +$tot_yys;
                @endphp
                <td align="center" style="padding: 5px;">Rp. <?php echo number_format($tot_saldo,0,',','.'); ?></td>
                
            </tr>
        </tbody>
    </table>
    @php
        }else{
    @endphp
    <br>
    <div style="padding: 5px;">
        <b>Jurnal KAS </b>
        <hr>
    </div>
    <table width="100%" border="1" style="font-size: 12px;">
        <thead>
            <tr>
                <th width="25%" >Kas BSI</th>
                <th width="25%">Kas Kasir Pusat</th>
                <th width="25%">Kas di Yayasan</th>
                <th width="25%">Total Saldo</th>
            </tr>
        </thead>
        <?php 
            $tot_yys =0;
            $tot_saldo =0;
            $tot_yys = $jum_yys_simpan - $jum_yys_ambil;
        ?>
        <tbody>
            
            <tr >
                <td align="center" style="padding: 5px;">Rp. <?php echo number_format($saldo_akhir_bsi,0,',','.'); ?></td>
                <td align="center" style="padding: 5px;">Rp. <?php echo number_format($saldo_akhir_kasir,0,',','.'); ?></td>
                <td align="center" style="padding: 5px;">Rp. <?php echo number_format($tot_yys,0,',','.'); ?></td>
                @php
                    $tot_saldo = $saldo_akhir_bsi + $saldo_akhir_kasir +$tot_yys;
                @endphp
                <td align="center" style="padding: 5px;">Rp. <?php echo number_format($tot_saldo,0,',','.'); ?></td>
                
            </tr>
        </tbody>
    </table>
    @php
        }
    @endphp
    @php
        $jum_baris = $j+$q+$p;
        if($jum_baris == 20 || $jum_baris == 21 || $jum_baris == 22){
    @endphp
    <br>
    <table width="100%" border="0" style="font-size: 12px;" class="breakNow2">
        <thead>
            <tr>
                <th width="25%" >Kasir Pusat</th>
                <th width="25%">Mengetahui <br>Ketua KOPEGSAF</th>
                <th width="25%">Bendahara</th>
                <th><?php echo $jum_baris;?></th>
            </tr>
        </thead>
        <tbody>
            
            <tr >
                <td style="height: 50px;"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td align="center">(Rina Mardiana)</td>
                <td align="center">(Anton Darmanto)</td>
                <td align="center">(Meri Hemawati)</td>
            </tr>
        </tbody>
    </table>
    @php
        }else{
    @endphp
    <br>
    <table width="100%" border="0" style="font-size: 12px;">
        <thead>
            <tr>
                <th width="25%" >Kasir Pusat</th>
                <th width="25%">Mengetahui <br>Ketua KOPEGSAF</th>
                <th width="25%">Bendahara</th>
            </tr>
        </thead>
        <tbody>
            
            <tr >
                <td style="height: 50px;"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td align="center">(Rina Mardiana)</td>
                <td align="center">(Anton Darmanto)</td>
                <td align="center">(Meri Hemawati)</td>
            </tr>
        </tbody>
    </table>
    @php
        }
    @endphp
  </main>


</body>
</html>
