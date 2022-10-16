@extends('layouts.backend.index')
@push('styles')
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert -->
    <link href="{{ asset('plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/animate/animate.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Data Vaksin {{ $vaksinisasi->user->name }}</h4>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <form action="{{ route('simpan-verifikasi') }}" id="frm-verifikasi" method="POST">
                        @csrf
                        <input class="form-control" type="hidden" name="id" autocomplete="off"
                            value="{{ $vaksinisasi->id }}">
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Nama Lengkap</label>
                            <div class="col-lg-9 col-xl-8">
                                <input class="form-control" type="text" autocomplete="off"
                                    value="{{ $vaksinisasi->user->name }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Lokasi Vaksin</label>
                            <div class="col-lg-9 col-xl-8">
                                <input class="form-control" type="text" autocomplete="off"
                                    value="@if ($vaksinisasi->lokasi_vaksin_id != null) {{ $vaksinisasi->lokasi_vaksin->nama_tempat }} @else Vaksin di Rumah @endif"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Provinsi</label>
                            <div class="col-lg-9 col-xl-8">
                                <input class="form-control" type="text" autocomplete="off"
                                    value="{{ $vaksinisasi->provinsi->nama_provinsi }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Rumah</label>
                            <div class="col-lg-9 col-xl-8">
                                <input class="form-control" type="text" autocomplete="off"
                                    value="@if ($vaksinisasi->rumah == 1) YA @else TIDAK @endif" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Tanggal Vaksin</label>
                            <div class="col-lg-9 col-xl-8">
                                <input class="form-control" type="text" autocomplete="off"
                                    value="{{ date('d F Y', strtotime($vaksinisasi->tanggal)) }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Jenis Vaksin</label>
                            <div class="col-lg-9 col-xl-8">
                                <input class="form-control" type="text" autocomplete="off"
                                    value="{{ $vaksinisasi->jenis_vaksin->nama }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Gelombang Vaksin</label>
                            <div class="col-lg-9 col-xl-8">
                                <input class="form-control" type="text" autocomplete="off"
                                    value="{{ $vaksinisasi->gelombang_vaksin }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Status</label>
                            <div class="col-lg-9 col-xl-8">
                                <input
                                    class="form-control @if ($vaksinisasi->status == '0') bg-danger @elseif($vaksinisasi->status == '2')bg-success @endif"
                                    autocomplete="off"
                                    value="@if ($vaksinisasi->status == '0') Belum Verifikasi @elseif($vaksinisasi->status == '2')Sudah Verifikasi @endif"
                                    disabled>
                            </div>
                        </div>
                        @if ($vaksinisasi->status == 0)
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Verifikasi</label>
                                <div class="col-lg-9 col-xl-8">
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" type="checkbox" name="status" value="2">
                                        <label for="checkbox3">
                                            Verifikasi
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="form-group row">
                            <div class="col-lg-9 col-xl-8 offset-lg-3">
                                @if ($vaksinisasi->status != 2)
                                    <button type="submit" id="simpan-verifikasi"
                                        class="btn btn-primary btn-sm">Simpan</button>
                                @endif
                                <a href="{{ route('vaksinisasi-booth') }}" class="btn btn-danger btn-sm">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
@endsection
@push('scripts')
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script>
        $(".select2").select2({
            width: '100%'
        });
    </script>
    <!-- Sweet-Alert  -->
    <script src="{{ asset('plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    <script>
        "use strict";
        $(function() {
            $("#simpan-verifikasi").on("click", function(e) {
                e.preventDefault(); //stop dulu supaya tidak langsung ke simpan
                swal.fire({
                    title: 'Apakah anda yakin verifikasi?',
                    text: "Verifikasi",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Simpan',
                    cancelButtonText: 'Batal!',
                    reverseButtons: true
                }).then(function(result) {
                    if (result.value) {
                        $("#frm-verifikasi").submit();
                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === Swal.DismissReason.cancel
                    ) {

                    }
                })
            })
        });
    </script>
    @if (session()->has('edit'))
        <script>
            Swal.fire(
                'Sukses!',
                'Profil berhasil diubah!',
                'success'
            )
        </script>
    @endif
@endpush
