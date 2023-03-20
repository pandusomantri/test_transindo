<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Kode Tiket</title>

  <style type="text/css" media="screen">

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

    #watermark {
        position: fixed;
        bottom:   0cm;
        left:     1cm;

        /** Change image dimensions**/
        width:    21cm;
        height:   1cm;

        /** Your watermark should be behind every content**/
        z-index:  -1000;
    }

    
</style>
</head>
<body>


    <footer>
        <script type="text/php">
        if (isset($pdf)) {
            $x = 490;
            $y = 800;
            $text = "Halaman {PAGE_NUM} dari {PAGE_COUNT}";
            $font = null;
            $size = 10;
            $color = array(0.4, 0.4, 0.4);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
        </script> 
    </footer>

<main>
    <div id="watermark">
        Kontak Person: (022) 87787781
    </div>
    <table width="90%" border="0" class="halawal">
        <tr>
            {{-- <td align="left" width="10%" height="50px"><img src="gambar/logobarusize.png" height="50px" width="50px"></td> --}}
            <td align="center" width="100%"><b style="font-size: 12px;">TIKET KONSER VAGETOS</b><br><span style="font-size: 10px;">Jl. Cikutra Baru Raya No.28, Neglasari, Kec. Cibeunying Kaler, Kota Bandung, Jawa Barat 401244</span></td>
        </tr>
        <tr>
            <td colspan="2"><hr></td>
        </tr>
    </table>
    <center>
        <p style="font-size: 14px;"><b>KODE TIKET KONSER</b></p>
    </center>
    
    <table width="100%">
        @foreach($pendaftar as $pendaftar)
        <tr>
            <td width="30%">Nama Pendaftar</td>
            <td width="5%">:</td>
            <td width="65%">{{ $pendaftar->pendaftaran_nama }}</td>
        </tr>
        <tr>
            <td>No. Telp</td>
            <td>:</td>
            <td>{{ $pendaftar->pendaftaran_no_telp }}</td>
        </tr>
        <tr>
            <td>Tiket</td>
            <td>:</td>
            <td>{{ $pendaftar->pendaftaran_jenis_tiket }}</td>
        </tr>
        <tr>
            <td>Jumlah Bayar</td>
            <td>:</td>
            <td>Rp. <?php echo number_format($pendaftar->pendaftaran_jumlah_bayar,0,',','.'); ?></td>
        </tr>
        <tr>
            <td colspan="3" align="center" style="font-size:20px;"><b> Kode ID</b></td>
        </tr>
        <tr>
            <td colspan="3" align="center" style="font-size:20px;"><b> {{ $pendaftar->kode_ID }}</b></td>
        </tr>
        <tr>
            <td colspan="3"><br></td>
        </tr>
        <tr>
            <td style="font-size:10px;">Keterangan</td>
            <td>:</td>
            <td style="text-align: justify; font-size:10px;" >- Harap dicetak untuk diberikan kepada petugas
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td style="text-align: justify;font-size:10px;">- Siapkan uang pas untuk pembayaran nya</td>
        </tr>
        @endforeach
    </table>
</main>


</body>
</html>

