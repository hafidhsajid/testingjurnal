@extends('layouts.dashboard')

@section('title')
    Pengajuan Pengembalian Dana Sekolah Vokasi E-COM
@endsection

@section('content')
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Seller Dashboard - Pengembalian Uang</h2>
            <p class="dashboard-subtitle">Sekolah Vokasi E-Commerce</p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                          <a href="{{ route('dashboard-refund-create')}}" class="btn btn-primary mb-3">
                            + Tambah Pengajuan 
                          </a>
                          <div class="table-responsive">
                                <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Kode Transaksi</th>
                                            <th>Nama Akun </th>
                                            <th>Total Pengembalian</th>
                                            <th>Pemilik Rekening</th>
                                            <th>Nomor Rekening</th>
                                            <th>Bank</th>
                                            <th>Status</th>
                                            <th>Tanggal Pengajuan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
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
                { data: 'transaction_details_id', name: 'transaction_details_id' },
                { data: 'user.name', name: 'user.name' },
                { data: 'total', name: 'total' },
                { data: 'nama', name: 'nama' },
                { data: 'rekening', name: 'rekening' },
                { data: 'bank', name: 'bank' },
                { data: 'status', name: 'status'},
                { data: 'created_at', name: 'created_at' },
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