@extends('layouts.dashboard')

@section('title')
    Dashboard-Sekolah Vokasi E-COM
@endsection

@section('content')
          <div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Pengalaman Kerja</h2>
                <p class="dashboard-subtitle">Riwayat Kerja</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-12 mt-2">
                    
                    <div class="tab-content" id="pills-tabContent">
                      <div
                        class="tab-pane fade show active"
                        id="pills-home"
                        role="tabpanel"
                        aria-labelledby="pills-home-tab"
                      >
                        <!-- view list barang  -->
                        @foreach ($experiences as $p)
                          <a
                            class="card card-list d-block"
                            href="{{ route('portofolio-experiences-edit', $p->id)}}"
                          >
                          <div class="card text-white bg-info mb-3">
                            <div class="card-header">  </div>
                            <div class="card-body">
                              <div class="row">
                                <div class="col-md-2">{{ $p->perusahaan}}</div>
                                <div class="col-md-2">{{ $p->jabatan }}</div>
                                <div class="col-md-2">{{ $p->status }}</div>
                                <div class="col-md-2">{{ $p->bidang}}</div>
                                <div class="col-md-2">{{ $p->lokasi_perusahaan}}</div>
                                
                                <div class="col-md-1 d-none d-md-block">
                                  <img
                                    src="/images/dashboard-arrow-right.svg"
                                    alt=""
                                  />
                                </div>
                              </div>
                            </div>
                          </div>
                          </a>
                        @endforeach

                        

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection