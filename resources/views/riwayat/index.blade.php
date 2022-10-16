@extends('layouts.backend.index')

@push('styles')
    <!-- DataTables -->
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert -->
    <link href="{{ asset('plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/animate/animate.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Riwayat</h4>
                    <p class="text-muted mb-0">
                        Riwayat vaksin anda
                    </p>
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0" id="tbl-riwayat">
                            <thead>
                                <tr>
                                    <th>Jenis Vaksin</th>
                                    <th>Vaksin ke</th>
                                    <th>Alamat Vaksin</th>
                                    <th>Tanggal Vaksin</th>
                                    <th>No Antrian</th>
                                    <th>Status</th>
                                    <th class="text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vaksinisasi as $vaksin)
                                    <tr>
                                        <td>{{ $vaksin->jenis_vaksin->nama }}</td>
                                        <td>{{ $vaksin->gelombang_vaksin }}</td>
                                        <td>
                                            @if ($vaksin->lokasi_vaksin_id == null)
                                                Di Rumah
                                            @else
                                                {{ $vaksin->lokasi_vaksin->nama_tempat . ' , ' . $vaksin->lokasi_vaksin->alamat_lengkap }}
                                            @endif
                                        </td>
                                        <td>{{ date('d F Y', strtotime($vaksin->tanggal)) }}</td>
                                        <td>
                                            @if ($vaksin->rumah == 1)
                                                -
                                            @else
                                                {{ $vaksin->no_antrian }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($vaksin->status == 0)
                                                <span class="badge badge-pill badge-warning">Menunggu</span>
                                            @elseif($vaksin->status == 1)
                                                <span class="badge badge-pill badge-info">Dokter sudah ada</span>
                                            @elseif($vaksin->status == 2)
                                                <span class="badge badge-pill badge-success">Verifikasi</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <a href="#" data-toggle="modal"
                                                data-target="#exampleModal{{ $vaksin->id }}"><i
                                                    class="fas fa-eye"></i></a>
                                            <div class="modal fade" id="exampleModal{{ $vaksin->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalWarning1" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div
                                                            class="modal-header @if ($vaksin->status == 0) bg-warning @elseif ($vaksin->status == 1) bg-info @elseif($vaksin->status == 2) bg-success @endif">
                                                            <h6 class="modal-title m-0 text-white"
                                                                id="exampleModalWarning1">
                                                                Detail</h6>
                                                            <button type="button" class="close " data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true"><i
                                                                        class="la la-times text-white"></i></span>
                                                            </button>
                                                        </div>
                                                        <!--end modal-header-->
                                                        <div class="modal-body">
                                                            <div class="media mb-3 text-left">

                                                                <div
                                                                    class="media-body align-self-center text-truncate ml-3">
                                                                    <h4 class="m-0 font-weight-semibold text-dark font-16">
                                                                        Tiket
                                                                        Vaksin</h4>
                                                                    <p class="mb-0 font-13"><span class="text-dark">Nama :
                                                                        </span>{{ $vaksin->user->name }}</p>
                                                                </div>
                                                                <!--end media-body-->
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table
                                                                    class="table table-bordered mb-0 table-centered text-left">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>Jadwal</th>
                                                                            <td>{{ date('d F Y', strtotime($vaksin->tanggal)) }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Jenis</th>
                                                                            <td>{{ $vaksin->jenis_vaksin->nama }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Alamat</th>
                                                                            <td>
                                                                                @if ($vaksin->lokasi_vaksin_id == null)
                                                                                    Di Rumah
                                                                                @else
                                                                                    {{ $vaksin->lokasi_vaksin->nama_tempat . ', ' . $vaksin->lokasi_vaksin->alamat_lengkap }}
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Jam Vaksin</th>
                                                                            <td>
                                                                                @if ($vaksin->lokasi_vaksin_id == null)
                                                                                    Di Rumah
                                                                                @else
                                                                                    {{ $vaksin->lokasi_vaksin->waktu_mulai . ' - ' . $vaksin->lokasi_vaksin->waktu_akhir }}
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <!--end /table-->
                                                            </div>
                                                            <!--end /tableresponsive-->
                                                            <hr class="hr-dashed">
                                                            <div class="row my-3">
                                                                <div class="col text-center">
                                                                    <strong>Nomor Antrian</strong>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col text-center">
                                                                    <strong class="display-2">
                                                                        @if ($vaksin->no_antrian != null)
                                                                            {{ $vaksin->no_antrian }}
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </strong>
                                                                </div>
                                                            </div>
                                                            <hr class="hr-dashed">
                                                            @if ($vaksin->rumah == 1)
                                                                <p class=" text-center mt-4 mb-1"> <span
                                                                        class="font-weight-bold text-danger">Diharapkan</span><br>
                                                                    untuk menunggu dokter di rumah anda!</p>
                                                            @else
                                                                <p class=" text-center mt-4 mb-1"> <span
                                                                        class="font-weight-bold text-danger">Diwajibkan</span><br>
                                                                    untuk membawa fotokopi KTP atau Kartu Keluarga anda!</p>
                                                            @endif
                                                        </div>
                                                        <!--end modal-body-->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                        <!--end modal-footer-->
                                                    </div>
                                                    <!--end modal-content-->
                                                </div>
                                                <!--end modal-dialog-->
                                            </div>
                                            <!--end modal-->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--end /table-->
                    </div>
                    <!--end /tableresponsive-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div> <!-- end col -->

    </div> <!-- end row -->
@endsection
@push('scripts')
    <!-- Required datatable js -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/pages/jquery.datatable.init.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#tbl-riwayat').DataTable();
        });
    </script>
    <!-- Sweet-Alert  -->
    <script src="{{ asset('plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    @if (session()->has('daftar'))
        <script>
            Swal.fire(
                'Sukses!',
                'Pendaftaran vaksin berhasil!',
                'success'
            )
        </script>
    @endif
    @if (session()->has('terdaftar'))
        <script>
            Swal.fire(
                'Anda sudah mendaftar!',
                'Pendaftaran anda sedang diproses!',
                'error'
            )
        </script>
    @endif
@endpush
