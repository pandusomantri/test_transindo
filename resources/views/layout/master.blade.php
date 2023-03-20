
<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="#">
		<title>Admin Tiket Konser</title>
		<meta charset="utf-8" />
		<meta name="description" content="Admin Tiket Konser" />
		<meta name="keywords" content="Admin Tiket Konser" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Admin Tiket Konser" />
		<meta property="og:url" content="https://google.com" />
		<meta property="og:site_name" content="Admin Tiket Konser" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		
		<link rel="canonical" href="https://google.com" />
		
		
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Page Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->

		<!-- DATATABLE -->
		<script type="text/javascript" href="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script type="text/javascript" href="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" href="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>


		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="{{asset('assets/js/custom/apps/inbox/listing.js')}}"></script>

		<script src="{{asset('assets/js/widgets.bundle.js')}}"></script>
		<script src="{{asset('assets/js/custom/widgets.js')}}"></script>
		<script src="{{asset('assets/js/custom/apps/chat/chat.js')}}"></script>
		<script src="{{asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
		<script src="{{asset('assets/js/custom/utilities/modals/create-app.js')}}"></script>
		<script src="{{asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->

		{{-- SELECT2 --}}
		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

		

	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" data-kt-aside-minimize="on" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Aside-->
				<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
					<!--begin::Brand-->
					<div class="aside-logo flex-column-auto" id="kt_aside_logo">
						<!--begin::Logo-->
							<span style="color:white;"> Admin </span>
						<!--end::Logo-->
						<!--begin::Aside toggler-->
						<div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle active" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
							<span class="svg-icon svg-icon-1 rotate-180">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="black" />
									<path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</div>
						<!--end::Aside toggler-->
					</div>
					<!--end::Brand-->
					
					@include('layout.side')
					
				</div>
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" style="" class="header align-items-stretch">
						<!--begin::Container-->
						<div class="container-fluid d-flex align-items-stretch justify-content-between">
							<!--begin::Aside mobile toggle-->
							<div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
								<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
									<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
									<span class="svg-icon svg-icon-1">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
											<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
										</svg>
									</span>
									<!--end::Svg Icon-->
								</div>
							</div>
							<!--end::Aside mobile toggle-->
							<!--begin::Mobile logo-->
							<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
								{{-- <img alt="Logo" src="{{asset('/gambar/logobarusize.png')}}" class="h-30px" /> --}}
							</div>
							<!--end::Mobile logo-->

							@include('layout.navbar')
							
						</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->
					
					<!-- Validasi -->
					@if (count($errors) > 0)
						<div class="alert alert-danger alert-highlighted" role="alert">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					
					@yield('konten')

					@include('layout.footer')
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
		

		{{-- ############################################## --}}
		{{-- bisa include navbar modal --}}
		{{-- ############################################## --}}

		<!--end::Main-->

		{{-- ############################################## --}}
		{{-- bisa include side modal --}}
		{{-- ############################################## --}}

		
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
			<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
				</svg>
			</span>
			<!--end::Svg Icon-->
		</div>
		<!--end::Scrolltop-->


		{{-- ############################################## --}}
		{{-- bisa include filter create modal --}}
		{{-- ############################################## --}}

		
		


		

		<script>
            //message with toastr
            @if(session()->has('success'))
            
                toastr.success('{{ session('success') }}', 'BERHASIL!'); 

            @elseif(session()->has('error'))

                toastr.error('{{ session('error') }}', 'GAGAL!');

             @elseif(session()->has('logout'))

                 toastr.success('{{ session('success') }}', 'Berhasil Logout!');

             @elseif(session()->has('ubaha'))

             	toastr.info('{{ session('info') }}', 'BERHASIL!'); 
                
            @endif
     	</script>


		<script type="text/javascript">
			$(document).ready(function() {
				$('#js-example-basic-single').select2();
			});
			$(document).ready(function() {
				$('#js-example-basic-single-2').select2();
			});
		</script>

		

		<script type="text/javascript">
			$(document).ready(function() {
			    $('#wajib_detail').DataTable({
			    	'info' :false,
			    	"pagingType": "simple",
			    	"pageLength" : 5,
			    	"bSort":false,
                    "lengthMenu": [[5, 20], [5, 20]]

			    });
			} );

			$(document).ready(function() {
			    $('#sukarela_detail').DataTable({
			    	'info' :false,
			    	"pagingType": "simple",
			    	"pageLength" : 5,
			    	"bSort":false,
                    "lengthMenu": [[5, 20], [5, 20]]

			    });
			} );

			$(document).ready(function() {
			    $('#qurban_detail').DataTable({
			    	'info' :false,
			    	"pagingType": "simple",
			    	"pageLength" : 5,
			    	"bSort":false,
                    "lengthMenu": [[5, 20], [5, 20]]

			    });
			} );

			$(document).ready(function() {
			    $('#lebaran_detail').DataTable({
			    	'info' :false,
			    	"pagingType": "simple",
			    	"pageLength" : 5,
			    	"bSort":false,
                    "lengthMenu": [[5, 20], [5, 20]]

			    });
			} );

			$(document).ready(function() {
			    $('#pendidikan_detail').DataTable({
			    	'info' :false,
			    	"pagingType": "simple",
			    	"pageLength" : 5,
			    	"bSort":false,
					"searching": true,
                    "lengthMenu": [[5, 20], [5, 20]]

			    });
			} );

			$(document).ready(function() {
			    $('#id2').DataTable({
			    	'info' :false,
			    	"pagingType": "simple",
			    	"pageLength" : 5,
			    	"bSort":false,
					"searching": false,
                    "lengthMenu": [[5, 20], [5, 20]]

			    });
			} );

			$(document).ready(function() {
				$('#pinjaman').DataTable({
					"pagingType": "simple",
					"pageLength" : 5,
					"bSort":false,
					"lengthMenu": [[5, 50], [5, 50]]
				});
			} );

			$(document).ready(function() {
				$('#detailpinjaman').DataTable({
					"pagingType": "simple",
					"pageLength" : 50,
					"bSort":false,
					"lengthMenu": [[5, 50], [5, 50]]
				});
			} );

			$(document).ready(function() {
				$('#pembelian').DataTable({
					"pagingType": "simple",
					"searching": true,
					"pageLength" : 5,
					"bSort":false,
					"lengthMenu": [[5, 50], [5, 50]]
				});
			} );

			$(document).ready(function() {
				$('#tunai_tertunda').DataTable({
					"pagingType": "simple",
					"searching": true,
					"pageLength" : 5,
					"lengthMenu": [[5, 50], [5, 50]]
				});
			} );

			$(document).ready(function() {
				$('#cari_produk').DataTable({
					"pagingType": "simple",
					"searching": true,
					"pageLength" : 10,
					"lengthMenu": [[10, 20], [10, 20]]
				});
			} );


			$(document).ready(function () {
				// Setup - add a text input to each footer cell
				$('#example tfoot th').each(function () {
					var title = $(this).text();
					$(this).html('<input type="text" class="form-control form-control-sm" style="text-align:center;" placeholder="Cari ' + title + '" />');
				});

				$('#example2 tfoot th').each(function () {
					var title = $(this).text();
					$(this).html('<input type="text" class="form-control form-control-sm" style="text-align:center;" placeholder="Cari ' + title + '" />');
				});
			
				// DataTable
				var table = $('#example').DataTable({
					"pagingType": "simple",
					"pageLength" : 5,
					"bSort":false,
					"lengthMenu": [[5, 50], [5, 50]],
					"info": false,
					initComplete: function () {
						// Apply the search
						this.api()
							.columns()
							.every(function () {
								var that = this;
			
								$('input', this.footer()).on('keyup change clear', function () {
									if (that.search() !== this.value) {
										that.search(this.value).draw();
									}
								});
							});
					},
				});

				var table = $('#example2').DataTable({
					"pagingType": "simple",
					"pageLength" : 5,
					"bSort":false,
					"lengthMenu": [[5, 50], [5, 50]],
					"info": false,
					initComplete: function () {
						// Apply the search
						this.api()
							.columns()
							.every(function () {
								var that = this;
			
								$('input', this.footer()).on('keyup change clear', function () {
									if (that.search() !== this.value) {
										that.search(this.value).draw();
									}
								});
							});
					},
				});
			});

			
			
			
		</script>
	</body>
	<!--end::Body-->
</html>