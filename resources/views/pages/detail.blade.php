@extends('layouts.app')

@section('title')
    Detail - Sekolah Vokasi E-COM
@endsection

@section('content')
    <div class="page-content page-details">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Product Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-gallery mb-3" id="gallery">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8" data-aos="zoom-in">
                        <transition name="slide-fade" mode="out-in">
                            <img :src="photos[activePhoto].url" :key="photos[activePhoto].id" class="w-100 main-image"
                                alt="" />
                        </transition>
                    </div>
                    <div class="col-lg-2">
                        <div class="row">
                            <div class="col-3 col-lg-12 mt-2 mt-lg-0" v-for="(photo, index) in photos"
                                :key="photo.id" data-aos="zoom-in" data-aos-delay="100">
                                <a href="#" @click="changeActive(index)">
                                    <img :src="photo.url" class="w-100 thumbnail-image"
                                        :class="{ active: index == activePhoto }" alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="store-details-container" data-aos="fade-out">
            <section class="store-heading">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <h1>{{ $product->name }}</h1>
                            <div class="owner">By
                                <a href="{{ route('profile', $product->user->id) }}">{{ $product->user->store_name }}</a>

                            </div>
                            <div class="price">Rp. {{ number_format($product->price) }}</div>
                        </div>
                        <div class="col-lg-2" data-aos="zoom-in">
                            @auth
                                <!-- Memeriksa apakah stok produk lebih dari 0 -->
                                @if ($product->stock >0)
                                <!-- Jika stok lebih dari 0, maka akan muncul button add to cart -->
                                <form action="{{ route('detail-add', $product->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <button type="submit" class="btn btn-success px-4 text-white btn-block mb-3">
                                        Add to Cart
                                    </button>
                                </form>
                                @else
                                <!-- Jika stok kosong, maka akan muncul stok habis -->
                                <a href="#" class="btn btn-danger disabled px-4 text-white btn-block mb-3">
                                    Stok Habis
                                </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-success px-4 text-white btn-block mb-3">
                                    Sign In untuk membeli
                                </a>
                            @endauth
                            <!-- Menampilkan pesan error jika ada -->
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            <section class="store-description">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <p>
                                {!! $product->description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="store-review">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8 mb-3 mt-3">
                            <h5>Customer Review (3)</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <ul class="list-unstyled">
                                <li class="media">
                                    <img src="/images/icons-testimonial-1.png" class="mr-3 rounded-circle" alt="" />
                                    <div class="media-body">
                                        <h5 class="mt-2 mb-1">Fulan</h5>
                                        Hello guys, aku beli kursi ini bagus banget pas duduk
                                        rasanya sampe mau meninggal. mantap banget susah rusak
                                        dinjek dibakar juga ga rusak
                                    </div>
                                </li>
                                <li class="media">
                                    <img src="/images/icons-testimonial-2.png" class="mr-3 rounded-circle" alt="" />
                                    <div class="media-body">
                                        <h5 class="mt-2 mb-1">akhirusalam</h5>
                                        Hello guys, aku beli kursi ini bagus banget pas duduk
                                        rasanya sampe mau meninggal.
                                    </div>
                                </li>
                                <li class="media">
                                    <img src="/images/icons-testimonial-3.png" class="mr-3 rounded-circle" alt="" />
                                    <div class="media-body">
                                        <h5 class="mt-2 mb-1">Uwowuwuwuw</h5>
                                        Hello guys, aku beli kursi ini bagus banget pas duduk
                                        rasanya sampe mau meninggal.
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var gallery = new Vue({
            el: "#gallery",
            mounted() {
                AOS.init();
            },
            data: {
                activePhoto: 0,
                photos: [
                    @foreach ($product->galleries as $gallery)
                        {
                            id: {{ $gallery->id }},
                            url: "{{ Storage::url($gallery->photos) }}",
                        },
                    @endforeach
                ],
            },
            methods: {
                changeActive(id) {
                    this.activePhoto = id;
                },
            },
        });
    </script>
@endpush
