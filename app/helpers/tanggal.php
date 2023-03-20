<?php 

      function tgl_indo($tanggal){
        $bulan = array(
          1 => 'Januari',
          'Februari',
          'Maret',
          'April',
          'Mei',
          'Juni',
          'Juli',
          'Agustus',
          'September',
          'Oktober',
          'November',
          'Desember'
        );

        $pecahkan = explode('-', $tanggal);

        return $pecahkan[2].' '.$bulan[(int)$pecahkan[1]].' '.$pecahkan[0];
      }

      function bulan_indo($tanggal){
        $bulan = array(
          1 => 'Januari',
          'Februari',
          'Maret',
          'April',
          'Mei',
          'Juni',
          'Juli',
          'Agustus',
          'September',
          'Oktober',
          'November',
          'Desember'
        );

        $pecahkan = explode('-', $tanggal);

        return $bulan[(int)$pecahkan[1]];
      }

      function tgl_indo2($tanggal){
        $bulan = array(
          1 => 'Jan',
          'Feb',
          'Mar',
          'Apr',
          'Mei',
          'Jun',
          'Jul',
          'Agt',
          'Sept',
          'Okt',
          'Nov',
          'Des'
        );

        $pecahkan = explode('-', $tanggal);

        return $pecahkan[2].' '.$bulan[(int)$pecahkan[1]].' '.$pecahkan[0];
      }

      function tgl_indo_pendek($tanggal){
        $bulan = array(
          1 => 'Jan',
          'Feb',
          'Mar',
          'Apr',
          'Mei',
          'Jun',
          'Jul',
          'Agt',
          'Sept',
          'Okt',
          'Nov',
          'Des'
        );

        $pecahkan = explode('-', $tanggal);

        return $pecahkan[2].' '.$bulan[(int)$pecahkan[1]].' '.$pecahkan[0];
      }

      function tgl_jam($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = '') {
        if (trim ($timestamp) == '')
        {
                $timestamp = time ();
        }
        elseif (!ctype_digit ($timestamp))
        {
            $timestamp = strtotime ($timestamp);
        }
        # remove S (st,nd,rd,th) there are no such things in indonesia :p
        $date_format = preg_replace ("/S/", "", $date_format);
        $pattern = array (
            '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
            '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
            '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
            '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
            '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
            '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
            '/April/','/June/','/July/','/August/','/September/','/October/',
            '/November/','/December/',
        );
        $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
            'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
            'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
            'Jan','Feb','Mar','Apr','Jun','Jul','Ags','Sep',
            'Okt','Nov','Des',
        );
        $date = date ($date_format, $timestamp);
        $date = preg_replace ($pattern, $replace, $date);
        $date = "{$date} {$suffix}";
        return $date;
      }

      function Rp($str)
      {
        $jum = strlen($str);
        $jumtitik = ceil($jum/3);
        $balik = strrev($str);
        
        $awal = 0;
        $akhir = 3;
        for($x=0;$x<$jumtitik;$x++){
          $a[$x] = substr($balik,$awal,$akhir)."."; 
          $awal+=3;
        }
        $hasil = implode($a);
        $hasilakhir = strrev($hasil);
        $hasilakhir = substr($hasilakhir,1,$jum+$jumtitik);
              
        return $hasilakhir."";
      }

      function penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        $temp = "";
        if ($nilai < 12) {
          $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
          $temp = penyebut($nilai - 10). " Belas";
        } else if ($nilai < 100) {
          $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
        } else if ($nilai < 200) {
          $temp = " Seratus" . penyebut($nilai - 100);
        } else if ($nilai < 1000) {
          $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
        } else if ($nilai < 2000) {
          $temp = " Seribu" . penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
          $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
          $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
          $temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
          $temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
        }     
        return $temp;
      }


      function terbilang($nilai) {
        if($nilai<0) {
          $hasil = "minus ". trim(penyebut($nilai));
        } else {
          $hasil = trim(penyebut($nilai));
        }         
        return $hasil;
      }

     ?>