@extends('layouts.admin')

@section('title')
    Dashboard-Sekolah Vokasi E-COM
@endsection

@section('content')
<div class="container-fluid">
    <div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
  >
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">Admin Dashboard</h2>
        <p class="dashboard-subtitle">Sekolah Vokasi E-Commerce</p>
      </div>
      <div class="dashboard-content">
        <div class="row">
          <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
              <div class="card-body">
                <div class="dashboard-card-title">Pelanggan</div>
                <div class="dashboard-card-subtitle">{{ $customer }}</div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
              <div class="card-body">
                <div class="dashboard-card-title">Pendapatan</div>
                <div class="dashboard-card-subtitle">Rp. {{ number_format($revenue)  }}</div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
              <div class="card-body">
                <div class="dashboard-card-title">Transaksi</div>
                <div class="dashboard-card-subtitle">{{ $transaction }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
@endsection