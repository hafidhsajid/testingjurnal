@extends('layouts.app')

@section('title')
    Kategori - Sekolah Vokasi E-COM
@endsection

@section('content')
<div class="page-content page-home" style="margin-top: 80px">
  <section class="store-trend-categories mt-4">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h5>Profile Toko</h5>
        </div>
      </div>
      <div class="row">
      <!--category Gadget-->
      <section
      class="store-breadcrumbs"
      data-aos="fade-down"
      data-aos-delay="100"
      >
        <div class="container">
          <div class="row">
            <div class="col-12">
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="{{ Route('home')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Profil toko</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>
  </section>

  <section class="store-new-products">
    <div class="container">
      <div class="row">
        <div class="col-md-4">      
          <div class="card card-info card-outline">
            <div class="card-body box-profile">
              <!-- Foto belum dipakai 

              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">
              </div>

              -->
              <h3 class="profile-username text-center">{{ $users->store_name }}</h3>
              <p class="text-muted text-center">{{ $users->name }}</p>
              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                <b>Status Toko</b> <a class="float-right"> 
                  @if ($users->store_status == 1)
                    Buka
                  @else
                    Tutup Sementara
                  @endif</a>
                </li>
                <li class="list-group-item">
                <b>Jumlah Produk</b> <a class="float-right">{{ $products_count }}</a>
                </li>
                {{-- <li class="list-group-item">
                <b>Barang Terjual</b> <a class="float-right">{{ $products_}}</a>
                </li> --}}
              </ul>
            </div>
          </div>

          <div class="card card-info card-outline mt-3">
            <div class="card-header">
              <h3 class="card-title">Deskripsi</h3>
            </div>
            
            <div class="card-body">
              <strong><i class="fas fa-book mr-1"></i> Education</strong>
                <p class="text-muted">
                  B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>
                <hr>
                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                <p class="text-muted">Malibu, California</p>
                <hr>
                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                <p class="text-muted">
                <span class="tag tag-danger">UI Design</span>
              <span class="tag tag-success">Coding</span>
              <span class="tag tag-info">Javascript</span>
              <span class="tag tag-warning">PHP</span>
              <span class="tag tag-primary">Node.js</span>
              </p>
              <hr>
              <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
              <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5>Produk</h5>
            </div>
          </div>
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
                          >Produk Terbaru</a
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
                          >Produk Terlaris</a
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
                            <!-- batasProduct-->
                              <div class="container">
                                <div class="row">
                              @php $incrementProduct = 0 @endphp
                              @forelse ($products as $product)
                                <div
                                class="col-12 col-md-3 col-lg-4"
                                data-aos="fade-up"
                                data-aos-delay="{{ $incrementProduct+= 100 }}"
                                >
                                
                                  <a href="{{ route('detail', $product->slug)}}" class="component-products d-block">
                                    <div class="products-thumbnail">
                                      
                                      <div
                                        class="products-image"
                                        style="
                                          @if($product->galleries->count())
                                            background-image: url('{{ Storage::url($product->galleries->first()->photos) }}')
                                          @else
                                            background-color: #eee
                                          @endif" 
                                      >
                                      
                                      </div>
                                    </div>
                                    <div class="products-text">{{ $product->name }}</div>
                                    <div class="products-price">Rp. {{number_format($product->price) }}</div>
                                  </a>
                                </div>
                              @empty
                                <div class="col-12 text-center py-5" data-aos="fade-up"
                                    data-aos-delay="100">
                                  Tidak ada produk
                                </div>
                              @endforelse
                <!-- batas Product-->
                        </div>
                      </div>
                     <div class="row">
                              @php $incrementProduct = 0 @endphp
                              @forelse ($products2 as $product2)
                                <div
                                class="col-12 col-md-3 col-lg-4"
                                data-aos="fade-up"
                                data-aos-delay="{{ $incrementProduct+= 100 }}"
                                >
                                
                                  <a href="{{ route('detail', $product2->slug)}}" class="component-products d-block">
                                    <div class="products-thumbnail">
                                      
                                      <div
                                        class="products-image"
                                        style="
                                          @if($product2->galleries->count())
                                            background-image: url('{{ Storage::url($product2->galleries->first()->photos) }}')
                                          @else
                                            background-color: #eee
                                          @endif" 
                                      >
                                      
                                      </div>
                                    </div>
                                    <div class="products-text">{{ $product2->name }}</div>
                                    <div class="products-price">Rp. {{number_format($product2->price) }}</div>
                                  </a>
                                </div>
                              @empty
                                <div class="col-12 text-center py-5" data-aos="fade-up"
                                    data-aos-delay="100">
                                  Tidak ada produk
                                </div>
                              @endforelse
                <!-- batas Product-->
                        </div>
                      </div>
                    </div>
                  </div>
          </div>
        </div>
      </div>
    </div>

  </section>
</div>
@endsection