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
                            <h4 class="card-title">Informasi Pribadi</h4>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <form action="{{ route('simpan-profile') }}" id="frm-profil" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Nama Lengkap</label>
                            <div class="col-lg-9 col-xl-8">
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    type="text" autocomplete="off" value="{{ $user->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <span class="form-text text-muted font-12">Isilah nama sesuai dengan nama di KTP
                                    anda!</span>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">NIK</label>
                            <div class="col-lg-9 col-xl-8">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                class="las la-user"></i></span></div>
                                    <input type="text" name="nik"
                                        class="form-control @error('nik') is-invalid @enderror" value="{{ $user->nik }}"
                                        maxlength="16" aria-describedby="basic-addon1">
                                    @error('nik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-lg-9 col-xl-8">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                class="las la-calendar"></i></span></div>
                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                        name="tanggal_lahir" value="{{ date('Y-m-d', strtotime($user->tanggal_lahir)) }}">
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Provinsi</label>
                            <div class="col-lg-9 col-xl-8">
                                <select
                                    class="select2 form-control mb-3 custom-select @error('provinsi') is-invalid @enderror"
                                    name="provinsi" style="width: 100%; height:36px;">
                                    <option value="">Pilih...</option>
                                    @foreach ($provinsi as $prov)
                                        @if (old('provinsi') == $prov->id || $user->provinsi_id == $prov->id)
                                            <option value="{{ $prov->id }}" selected>{{ $prov->nama_provinsi }}
                                            </option>
                                        @else
                                            <option value="{{ $prov->id }}">{{ $prov->nama_provinsi }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('provinsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">No Telepon</label>
                            <div class="col-lg-9 col-xl-8">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                class="las la-phone"></i></span></div>
                                    <input type="text" name="no_telp"
                                        class="form-control @error('no_telp') is-invalid @enderror"
                                        value="{{ $user->no_telp }}" aria-describedby="basic-addon1">
                                    @error('no_telp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Alamat Lengkap</label>
                            <div class="col-lg-9 col-xl-8">
                                <div class="input-group">
                                    <div class="input-group-prepend"></div>
                                    <textarea class="form-control @error('alamat_lengkap') is-invalid @enderror" name="alamat_lengkap" autocomplete="off"
                                        rows="3">{{ $user->alamat_lengkap }}</textarea>
                                    @error('alamat_lengkap')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Email</label>
                            <div class="col-lg-9 col-xl-8">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                class="las la-at"></i></span></div>
                                    <input type="text" class="form-control" value="{{ $user->email }}"
                                        aria-describedby="basic-addon1" disabled=disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-9 col-xl-8 offset-lg-3">
                                <button type="submit" id="simpan-profil" class="btn btn-primary btn-sm">Simpan</button>
                                <button type="button" class="btn btn-danger btn-sm">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end col-->
        {{-- <div class="col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ubah Password</h4>
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Password Sekarang</label>
                        <div class="col-lg-9 col-xl-8">
                            <input class="form-control" type="password" placeholder="Password">
                            <a href="#" class="text-primary font-12">Forgot password ?</a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Password Baru</label>
                        <div class="col-lg-9 col-xl-8">
                            <input class="form-control" type="password" placeholder="Password Baru">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Konfirmasi Password</label>
                        <div class="col-lg-9 col-xl-8">
                            <input class="form-control" type="password" placeholder="Konfirmasi Password">
                            <span class="form-text text-muted font-12">Jangan pernah bagikan password anda!</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-9 col-xl-8 offset-lg-3">
                            <button type="submit" class="btn btn-primary btn-sm">Ubah Password</button>
                            <button type="button" class="btn btn-danger btn-sm">Batal</button>
                        </div>
                    </div>
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div> <!-- end col --> --}}

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
            $("#simpan-profil").on("click", function(e) {
                e.preventDefault(); //stop dulu supaya tidak langsung ke simpan
                swal.fire({
                    title: 'Apakah anda yakin menyimpan?',
                    text: "Simpan data profil",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Simpan',
                    cancelButtonText: 'Batal!',
                    reverseButtons: true
                }).then(function(result) {
                    if (result.value) {
                        $("#frm-profil").submit();
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
