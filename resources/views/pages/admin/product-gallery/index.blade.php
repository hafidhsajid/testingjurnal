@extends('layouts.admin')

@section('title')
    Produk Galeri-Sekolah Vokasi E-COM
@endsection

@section('content')

<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Admin Dashboard - Galeri Produk</h2>
            <p class="dashboard-subtitle">Sekolah Vokasi E-Commerce</p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('product-gallery.create')}}" class="btn btn-info mb-3">
                                Tambah Galeri Produk
                            </a>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead class="bg-info">
                                        <tr>
                                            <th>ID</th>
                                            <th>Produk</th>
                                            <th>Foto</th>
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
                { data: 'product.name', name: 'product.name' },
                { data: 'photos', name: 'photos' },
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