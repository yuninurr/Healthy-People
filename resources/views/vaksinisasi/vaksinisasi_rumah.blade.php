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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">Vaksinisasi</h4>
                            <p class="text-muted mb-0">
                                Daftar Vaksinisasi
                            </p>
                        </div>
                    </div>
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <table id="tbl-vaksinisasi" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis Vaksin</th>
                                <th>Provinsi</th>
                                <th>Tanggal</th>
                                <th>Gelombang Vaksin</th>
                                <th>Rumah</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vaksinisasi as $vaksin)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $vaksin->user->name }}</td>
                                    <td>{{ $vaksin->jenis_vaksin->nama }}</td>
                                    <td>{{ $vaksin->provinsi->nama_provinsi }}</td>
                                    <td>{{ date('d F Y', strtotime($vaksin->tanggal)) }}</td>
                                    <td>
                                        @if ($vaksin->gelombang_vaksin == 1)
                                            <span>Vaksin 1</span>
                                        @elseif($vaksin->gelombang_vaksin == 2)
                                            <span>Vaksin 2</span>
                                        @elseif($vaksin->gelombang_vaksin == 3)
                                            <span>Booster 1</span>
                                        @elseif($vaksin->gelombang_vaksin == 4)
                                            <span>Booster 2</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($vaksin->rumah == 1)
                                            <span class="badge badge-pill badge-info">Iya</span>
                                        @else
                                            <span class="badge badge-pill badge-secondary">Tidak</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($vaksin->status == 0)
                                            <span class="badge badge-pill badge-danger">Dokter belum ada</span>
                                        @elseif($vaksin->status == 1)
                                            <span class="badge badge-pill badge-warning">Dokter sudah ada</span>
                                        @elseif($vaksin->status == 2)
                                            <span class="badge badge-pill badge-success">Verifikasi</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('set-dokter', $vaksin->id) }}">
                                            <i class="las la-pen text-info font-18"></i>
                                        </a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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
            $('#tbl-vaksinisasi').DataTable();
        });
    </script>
    <!-- Sweet-Alert  -->
    <script src="{{ asset('plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    @if (session()->has('edit'))
        <script>
            Swal.fire(
                'Sukses!',
                'Dokter berhasil diset!',
                'success'
            )
        </script>
    @endif
    @if (session()->has('verifikasi'))
        <script>
            Swal.fire(
                'Sukses!',
                'Verifikasi Berhasil!',
                'success'
            )
        </script>
    @endif
@endpush
