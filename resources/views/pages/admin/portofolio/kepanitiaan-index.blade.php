@extends('layouts.admin')

@section('title')
    Daftar Kepanitiaan 
@endsection

@section('content')

<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Mahasiswa Dashboard -Portofolio</h2>
            <p class="dashboard-subtitle">Sekolah Vokasi</p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('portofolio-kepanitiaan-create')}}" class="btn btn-info mb-3">
                                Tambah Riwayat Kepanitiaan
                            </a>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead class="bg-info">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Acara</th>
                                            <th>Penyelenggara</th>
                                            <th>Nama Jabatan</th>
                                            <th>Divisi</th>
                                            <th>Waktu Mulai</th>
                                            <th>Waktu Selesai</th>
                                            <th>Lokasi</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script>
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'user.name', name: 'user.name' },
                { data: 'nama_acara', name: 'nama_acara' },
                { data: 'penyelenggara', name: 'penyelenggara' },
                { data: 'nama_jabatan', name: 'nama_jabatan' },
                { data: 'divisi', name: 'divisi' },
                { data: 'waktu_mulai', name: 'waktu_mulai' },
                { data: 'waktu_selesai', name: 'waktu_selesai' },
                { data: 'lokasi', name: 'lokasi' },
                { data: 'deskripsi', name: 'deskripsi' },
                { 
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable:false,
                    widht: '15%',
                },
            ]
        })
    </script>
@endpush