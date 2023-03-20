
{{-- Dimulai dari Begin Content --}}

@extends('layout.master')

@section('konten')

<!--begin::Content-->

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">{{ session()->get('anggota_nama') }}</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Tables Widget 11-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Data Pendaftar </span>
                        {{-- <span class="text-muted mt-1 fw-bold fs-7">Over 500 new products</span> --}}
                    </h3>
                    <!--begin::Pagination-->
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-2 position-absolute ms-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-inbox-listing-filter="search" class="form-control form-control-sm form-control-solid mw-100 min-w-150px min-w-md-200px ps-12" placeholder="Cari Kode ID" />
                        </div>
                        <!--end::Search-->
                        
                    </div>
                    <!--end::Pagination-->
                    
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3" id="kt_inbox_listing">
                            <!--begin::Table head-->
                            <thead class="table-dark">
                                <tr class="fw-bolder text-primary">

                                    <th class="ps-4 min-w-30px rounded-start">No.</th>
                                    <th class="min-w-100px" style="text-align: center;">Kode ID</th>
                                    <th class="min-w-100px" style="text-align: center;">Nama Pendaftar</th>
                                    <th class="min-w-100px" style="text-align: center;">No. Telp</th>
                                    <th class="min-w-100px" style="text-align: center;">Jenis Tiket</th>
                                    <th class="min-w-100px" style="text-align: center;">Jumlah Bayar</th>
                                    <th class="min-w-100px" style="text-align: center;">Checkin</th>

                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                <?php $i=1; ?>
                                @foreach($pendaftar as $pendaftar)
                                    <tr>
                                        <td align="center" class="align-middle">{{$i++}}</td>
                                        <td align="left" class="align-middle">{{$pendaftar->kode_ID}}</td>
                                        <td align="left" class="align-middle"><a href="/checkin_id/<?php echo $pendaftar->kode_ID; ?> "> {{$pendaftar->pendaftaran_nama}}</a></td>
                                        <td align="right" class="align-middle">{{$pendaftar->pendaftaran_no_telp}}</td>
                                        <td align="center" class="align-middle">{{$pendaftar->pendaftaran_jenis_tiket}}</td>
                                        <td align="right" class="align-middle"><?php echo "Rp. ".number_format($pendaftar->pendaftaran_jumlah_bayar, 0,",","."); ?></td>
                                        <td align="center">
                                            <?php if($pendaftar->status_checkin == "Belum"){ ?>
                                                <a href="/checkin_update/{{ $pendaftar->kode_ID }}" class="btn btn-sm btn-primary">Belum</a>
                                            <?php }elseif($pendaftar->status_checkin == "Sudah"){ ?>
                                                <b style="color: green;"> Sudah</b>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--begin::Body-->
            </div>
            <!--end::Tables Widget 11-->

            
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>

<!--end::Content-->
@endsection


