<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../">
		<title>Pendaftaran</title>
		<meta charset="utf-8" />
		<meta name="description" content="Pendaftaran" />
		<meta name="keywords" content="Pendaftaran" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Pendaftaran" />
		<meta property="og:url" content="https://google.com/" />
		<meta property="og:site_name" content="Google" />
		<link rel="canonical" href="https://google.com/" />
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14.png">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					
					<!--begin::Wrapper-->
					<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						<!--begin::Form-->
						<form class="form w-100" method="post" action="/pendaftaran">
							{{ csrf_field() }}
							<!--begin::Heading-->
							<div class="text-center mb-10">
								<!--begin::Title-->
								<h1 class="text-dark mb-3">Pendaftaran</h1>
								<!--end::Title-->
								<!--begin::Link-->
								{{-- <div class="text-gray-400 fw-bold fs-4">New Here?
								<a href="../../demo1/dist/authentication/layouts/basic/sign-up.html" class="link-primary fw-bolder">Create an Account</a></div> --}}
								<!--end::Link-->
							</div>
							<!--begin::Heading-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
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
                                    <tr>
										<td colspan="3" ><hr></td>
									</tr>
                                    <tr>
										<td colspan="3" align="center">
                                            <a href="/pendaftaran_cetak/{{ $pendaftar->kode_ID }}" class="btn btn-primary btn-sm" target="_blank">Cetak</a>
                                        </td>
									</tr>
									@endforeach
								</table>
							</div>
							<!--end::Input group-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="assets/js/custom/authentication/sign-in/general.js"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>