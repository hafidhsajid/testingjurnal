@extends('layouts.app')

@section('title')
    Kategori - Sekolah Vokasi E-COM
@endsection

@section('content')
<div class="page-content page-home" style="margin-top: 80px">
  
  <section class="store-new-products">
    <div class="container-fluid" data-aos="fade-up">
        <div class="row">
            <div class="col-md-8 offset-md-2 mb-3">
              <h2 class="text-center display-4">PRODUK</h2>
              <form action="simple-results.html">
                <div class="input-group">
                  <input type="search" class="form-control form-control-lg" placeholder="Cari Produk Pilihanmu">
                    <div class="input-group-append">
                    <button type="submit" class="btn btn-lg btn-info">
                    Search
                    </button>
                    </div>
                </div>
              </form>
            </div>
        </div>
        
      <div class="row">
      <!-- batas new Product-->
        @php $incrementProduct = 0 @endphp
          @forelse ($products as $product )
            <div
            class="col-4 col-md-4 col-lg-2 mt-3"
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
                      @endif
                    "
                  ></div>
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
      <!-- batas new Product-->
      </div>
    </div>
  </section>
</div>
@endsection