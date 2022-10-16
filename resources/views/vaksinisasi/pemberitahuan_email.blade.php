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
                                <th>Email</th>
                                {{-- <th>Provinsi</th> --}}
                                <th>Vaksin Terakhir</th>
                                <th>Tanggal Email Terkirim</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    {{-- <td>{{ $user->provinsi->nama_provinsi }}</td> --}}
                                    @if ($user->vaksin_terakhir == null)
                                        <td>Vaksin belum dilakukan</td>
                                    @else
                                        <td>{{ date('d-m-Y', strtotime($user->vaksin_terakhir)) }}</td>
                                    @endif
                                    @if ($user->email_terkirim == null)
                                        <td>Belum pernah melakukan pengiriman email</td>
                                    @else
                                        <td>{{ date('d/m/Y', strtotime($user->email_terkirim)) }}</td>
                                    @endif
                                    <td><a href="{{ route('kirim-email', $user->id) }}">
                                            <i class="las la-paper-plane text-info font-18"></i>
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
    @if (session()->has('terkirim'))
        <script>
            Swal.fire(
                'Sukses!',
                'Email Berhasi Terkirim!',
                'success'
            )
        </script>
    @endif
@endpush
