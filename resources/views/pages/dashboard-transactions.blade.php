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
                <h2 class="dashboard-title">Transaction</h2>
                <p class="dashboard-subtitle">Look what you have made today!</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-12 mt-2">
                    <ul
                      class="nav nav-pills mb-3"
                      id="pills-tab"
                      role="tablist"
                    >
                      <li class="nav-item" role="presentation">
                        <a
                          class="nav-link active"
                          id="pills-home-tab"
                          data-toggle="pill"
                          href="#pills-home"
                          role="tab"
                          aria-controls="pills-home"
                          aria-selected="true"
                          >Buy Products</a
                        >
                      </li>
                      <li class="nav-item" role="presentation">
                        <a
                          class="nav-link"
                          id="pills-profile-tab"
                          data-toggle="pill"
                          href="#pills-profile"
                          role="tab"
                          aria-controls="pills-profile"
                          aria-selected="false"
                          >Sell Product</a
                        >
                      </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                      <div
                        class="tab-pane fade show active"
                        id="pills-home"
                        role="tabpanel"
                        aria-labelledby="pills-home-tab"
                      >
                        <!-- view list barang  -->
                        @foreach ($buyTransactions as $b_transaction)
                          <a
                            class="card card-list d-block"
                            href="{{ route('dashboard-transaction-details', $b_transaction->id)}}"
                          >
                            <div class="card-body">
                              <div class="row">
                                <div class="col-md-1">
                                  <img
                                    src="{{ Storage::url($b_transaction->product->galleries->first()->photos ?? '')}}"
                                    class="w-50"
                                    alt=""
                                  />
                                </div>
                                <div class="col-md-4">{{ $b_transaction->product->name }}</div>
                                <div class="col-md-3">{{ $b_transaction->product->user->store_name }}</div>
                                <div class="col-md-3">{{ $b_transaction->created_at }}</div>
                                <div class="col-md-1 d-none d-md-block">
                                  <img
                                    src="/images/dashboard-arrow-right.svg"
                                    alt=""
                                  />
                                </div>
                              </div>
                            </div>
                          </a>
                        @endforeach

                        

                      </div>
                      <div
                        class="tab-pane fade"
                        id="pills-profile"
                        role="tabpanel"
                        aria-labelledby="pills-profile-tab"
                      >
                        @foreach ($sellTransactions as $s_transaction)
                          <a
                            class="card card-list d-block"
                            href="{{ route('dashboard-transaction-details', $s_transaction->id)}}"
                          >
                            <div class="card-body">
                              <div class="row">
                                <div class="col-md-1">
                                  <img
                                    src="{{ Storage::url($s_transaction->product->galleries->first()->photos ?? '')}}"
                                    class="w-50"
                                    alt=""
                                  />
                                </div>
                                <div class="col-md-4">{{ $s_transaction->product->name }}</div>
                                <div class="col-md-3">{{ $s_transaction->transaction->user->name }}</div>
                                <div class="col-md-3">{{ $s_transaction->created_at }}</div>
                                <div class="col-md-1 d-none d-md-block">
                                  <img
                                    src="/images/dashboard-arrow-right.svg"
                                    alt=""
                                  />
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