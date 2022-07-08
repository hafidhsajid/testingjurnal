@extends('layouts.dashboard')

@section('title')
    Tambah Pengajuan Penarikan-Sekolah Vokasi E-COM
@endsection

@section('content')
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Admin Dashboard - Transaksi</h2>
            <p class="dashboard-subtitle">Edit Transaksi</p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('withdraw.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Kode Transaksi</label>
                                            <input type="text" name="name" class="form-control" value="{{ $item->transaction_details_id}}" required disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Total Penarikan </label>
                                            <input type="number" name="total_withdraw" class="form-control" value="{{ $item->total_withdraw }}" required disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nomor Rekening</label>
                                            <input type="text" name="rekening" class="form-control" value="{{ $item->rekening }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Bank Tujuan</label>
                                            <select name="status" class="form-control">
                                                <option value="{{ $item->bank }}" selected>{{ $item->bank }}</option>
                                                    <option value="" disabled>--------------------</option>
                                                    <option value="BRI">BRI</option>
                                                    <option value="MANDIRI">MANDIRI</option>
                                                    <option value="BNI">BNI</option>
                                                    <option value="BTN">BTN</option>
                                                    <option value="BCA">BCA</option>
                                                    <option value="BSI">BSI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Status Penarikan</label>
                                            <select name="status" class="form-control">
                                                <option value="{{ $item->status }}" selected>{{ $item->status }}</option>
                                                    <option value="" disabled>--------------------</option>
                                                    <option value="PENDING">PENDING</option>
                                                    <option value="PROCESS">PROCESS</option>
                                                    <option value="SUCCESS">SUCCESS</option>
                                                    <option value="CANCELLED">CANCELLED</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-5">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
