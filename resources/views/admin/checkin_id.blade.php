
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
            @if ($message = Session::get('ubah'))
				<div class="alert alert-success" role="alert" style="background-color: #41b314; color: white;">
					<span class="badge badge-pill" style="background-color: white; color: #41b314;">Ubah data</span>
					<strong>{{ $message }}</strong>
				</div>
			@endif
            
            
            @foreach($pendaftar as $pendaftar)
            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">Akun {{$pendaftar->pendaftaran_nama}}</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form class="form" action="/checkin_ubah" id="kt_modal_new_address_form" method="post">
                        {{ csrf_field() }}
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Kode ID</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <input type="text" class="form-control form-control-solid"  name="id" value="{{$pendaftar->kode_ID}}" readonly style="text-align: center;"  />
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <input type="text" class="form-control" placeholder="Nama Pendaftar" name="nama_pendaftar" value="{{$pendaftar->pendaftaran_nama}}" style="text-align: center;" required="" autocomplete="off"/>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Jenis Tiket/Nomor WA</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <select name="jenis_tiket" class="form-control" required>
                                                <option value="VVIP" <?php if($pendaftar->pendaftaran_jenis_tiket == "VVIP") { echo "selected"; } ?> style="text-align-last: center;">VVIP</option>
                                                <option value="VIP A" <?php if($pendaftar->pendaftaran_jenis_tiket == "VIP A") { echo "selected"; } ?> style="text-align-last: center;">VIP A</option>
                                                <option value="VIP B" <?php if($pendaftar->pendaftaran_jenis_tiket == "VIP B") { echo "selected"; } ?> style="text-align-last: center;">VIP B</option>
                                                <option value="LEFPOS 1" <?php if($pendaftar->pendaftaran_jenis_tiket == "LEFPOS 1") { echo "selected"; } ?> style="text-align-last: center;">LEFPOS 1</option>
                                                <option value="LEFPOS 2" <?php if($pendaftar->pendaftaran_jenis_tiket == "LEFPOS 2") { echo "selected"; } ?> style="text-align-last: center;">LEFPOS 2</option>
                                                <option value="RIGPOS 1" <?php if($pendaftar->pendaftaran_jenis_tiket == "RIGPOS 1") { echo "selected"; } ?> style="text-align-last: center;">RIGPOS 1</option>
                                                <option value="RIGPOS 2" <?php if($pendaftar->pendaftaran_jenis_tiket == "RIGPOS 2") { echo "selected"; } ?> style="text-align-last: center;">RIGPOS 2</option>
                                            </select>
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <input type="number" class="form-control" placeholder="Nomor Telepon" name="no_telp" value="{{$pendaftar->pendaftaran_no_telp}}" style="text-align: center;"/>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Jumlah Bayar/Status Checkin</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <input type="number" class="form-control" placeholder="Jumlah Bayar" name="jumlah_bayar" value="{{$pendaftar->pendaftaran_jumlah_bayar}}" style="text-align: center;" required="" autocomplete="off"/>
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <select name="status_checkin" class="form-control" required>
                                                <option value="Belum" <?php if($pendaftar->status_checkin == "Belum") { echo "selected"; } ?> style="text-align-last: center;">Belum</option>
                                                <option value="Sudah" <?php if($pendaftar->status_checkin == "Sudah") { echo "selected"; } ?> style="text-align-last: center;">Sudah</option>
                                            </select>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            
                            
                            
                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <a href="/checkin" class="btn btn-sm btn-dark">Kembali</a>
                            <a href="/checkin_hapus/{{ $pendaftar->kode_ID }}" class="btn btn-sm btn-danger">Hapus</a>
                            <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Basic info-->
            @endforeach

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>






<!--end::Content-->
@endsection


