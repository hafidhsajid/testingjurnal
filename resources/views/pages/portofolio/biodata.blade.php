@extends('layouts.dashboard')

@section('title')
    Biodata Mahasiswa Sekolah Vokasi
@endsection

@section('content')
    <div class="section-content section-dashboard-home">
        <div class="container-fluid">
            <h2 class="dashboard-title">BIODATA</h2>
            <p class="dashboard-subtitle">
                
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
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
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Deskripsi</h5>
                                    <p>{!! $user->deskripsi !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection