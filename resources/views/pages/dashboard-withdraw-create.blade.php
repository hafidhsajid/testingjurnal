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
            <h2 class="dashboard-title">Seller Dashboard - Pengajuan Penarikan</h2>
            <p class="dashboard-subtitle">Tambah Pengajuan Penarikan</p>
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
                            <form action="{{ route('dashboard-withdraw-store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label>Kode Transaksi</label>
                                        <select name="transaction_details_id" class="form-control" required>
                                            @foreach ($sellTransactions as $transaction)
                                              <option value="{{ $transaction->code }}">{{ $transaction->code }}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama Pengaju</label>
                                            <input type="text" name="name" class="form-control" required>
                                            <p class="text-muted">
                                              Nama harus sesuai dengan nama pemilik Rekening
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="form-group">
                                          <label>Total Penarikan</label>
                                          <input type="number" name="total_withdraw" class="form-control" required>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label>Bank</label>
                                          <select name="bank" class="form-control">
                                                <option value="" disabled>Pilih Bank</option>
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
                                          <label>Nomor Rekening</label>
                                          <input type="text" name="rekening" class="form-control" required>
                                      </div>
                                    </div>
                                    <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="status" value="PENDING">
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
