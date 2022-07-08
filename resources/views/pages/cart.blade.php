@extends('layouts.app')

@section('title')
    Cart - Sekolah Vokasi E-COM
@endsection

@section('content')
    <div class="page-content page-cart">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-cart">
            <div class="container">
                <!--Error-->
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <!--Product-->
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-12 table-responsive">
                        <table class="table table-borderless table-cart">
                            <thead>
                                <tr>
                                    <td>Gambar</td>
                                    <td>Barang & Penjual</td>
                                    <td>Harga</td>
                                    <td>Jumlah</td>
                                    <td>Menu</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalPrice = 0 @endphp
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td style="width: 20%">
                                            @if ($cart->product->galleries)
                                                <img src="{{ Storage::url($cart->product->galleries->first()->photos ?? '') }}"
                                                    class="cart-image" alt="" />
                                            @endif

                                        </td>
                                        <td style="width: 25%">
                                            <div class="product-title">{{ $cart->product->name }}</div>
                                            <div class="product-subtitle">By {{ $cart->product->user->store_name }}</div>
                                        </td>
                                        <td style="width: 20%">
                                            <div class="product-title">Rp. {{ number_format($cart->product->price) }}
                                            </div>
                                            <div class="product-subtitle">Rupiah</div>
                                        </td>
                                        <form action="{{ route('cart-update-quantity', $cart->id) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <td style="width: 15%">
                                                <div class="product-title">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" name="quantity"
                                                            id="quantity" value="{{ $cart->quantity }}">
                                                        <div class="input-group-append">
                                                            <label for="quantity" class="input-group-text">Pcs</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width: 20%">
                                                <button type="submit" class="btn btn-success"> Update Jumlah </button>
                                        </form>
                                        <form action="{{ route('cart-delete', $cart->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-remove-cart"> Remove </button>
                                        </form>
                                        </td>
                                    </tr>
                                    @php $totalPrice += $cart->product->price * $cart->quantity @endphp
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <!--Shipping-->
                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                    <div class="col-12">
                        <h2 class="mb-4">Detail Pengiriman</h2>
                    </div>
                </div>
                <form action="{{ route('checkout') }}" id="locations" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" name="total_price" id="total_price" value=" {{ $totalPrice }}">
                    <input type="hidden" name="shipping_price" id="shipping_price" value="">
                    <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_one">Alamat 1</label>
                                <input type="text" class="form-control" name="address_one" id="address_one"
                                    value="Jl. Ir Sutami No.18" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_two">Alamat 2</label>
                                <input type="text" class="form-control" name="address_two" id="address_two"
                                    value="Jl. Ir Sutami No.26" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="provinces_id">Provinsi </label>
                                <select name="provinces_id" id="provinces_id" class="form-control" v-if="provinces"
                                    v-model="provinces_id">
                                    <option v-for="province in provinces" :value="province.id"> @{{ province.name }}
                                    </option>
                                </select>
                                <select v-else class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="regencies_id">Kota </label>
                                <select name="regencies_id" onchange="cekOngkir()" id="regencies_id" class="form-control"
                                    v-if="regencies" v-model="regencies_id">
                                    <option v-for="regency in regencies" :value="regency.id"> @{{ regency.name }}
                                    </option>
                                </select>
                                <select v-else class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="zip_code">Kode POS</label>
                                <input type="text" class="form-control" name="zip_code" id="zip_code"
                                    value=" 17562" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Negara</label>
                                <input type="text" class="form-control" name="country" id="country"
                                    value="Indonesia" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">Nomor Telpon</label>
                                <input type="text" class="form-control" name="phone_number" id="phone_number"
                                    value="+62 81222221212" />
                            </div>
                        </div>
                    </div>
                    <!--Payment Info-->
                    <div class="row" data-aos="fade-up" data-aos-delay="150">
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12">
                            <h2 class="mb-2">Pembayaran</h2>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-4 col-md-3">
                            <div class="product-title" id="totalproduct-text">Rp.{{ number_format($totalPrice ?? 0) }}</div>
                            <div class="product-subtitle">Total Harga Produk</div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="product-title" id="ongkir-text">Rp.0</div>
                            <div class="product-subtitle">Ongkos Kirim</div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="product-title text-success" id="total-text">Rp.
                                {{ number_format($totalPrice ?? 0) }}</div>
                            <div class="product-subtitle">Total Pembayaran</div>
                        </div>
                        <div class="col-8 col-md-3">
                            <button type="submit" id="btn_submit" class="btn btn-info mt-4 px-4 btn-block" disabled>
                                CheckOut
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        var locations = new Vue({
            el: "#locations",
            mounted() {
                AOS.init();
                this.getProvincesData();
            },
            data: {
                provinces: null,
                regencies: null,
                provinces_id: null,
                regencies_id: null,
            },
            methods: {
                getProvincesData() {
                    var self = this;
                    axios.get('{{ route('api-provinces') }}')
                        .then(function(response) {
                            self.provinces = response.data;
                        })
                },

                getRegenciesData() {
                    var self = this;
                    axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
                        .then(function(response) {
                            self.regencies = response.data;
                        })
                },
            },
            watch: {
                provinces_id: function(val, oldVal) {
                    this.regencies_id = null;
                    this.getRegenciesData();
                }
            }

        });
    </script>
    <script>
        function cekOngkir() {
            var total_product = {{ $totalPrice }}; // total harga produk
            var regencies_id = $('#regencies_id').val(); // id kota pembeli

            // mengirimkan data ke route
            $.ajax({
                url: "/ongkir/" + regencies_id,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $('#totalproduct-text').text('Rp. ' + total_product); 
                    $('#ongkir-text').text('Rp. ' + res); // menampilkan harga ongkir
                    $('#total-text').text('Rp. ' + (total_product + res)); // menampilkan total harga
                    $('#total_price').val(total_product + res); // merubah value form total harga
                    $('#shipping_price').val(res); // merubah value form ongkir
                    $('#btn_submit').prop('disabled', false); // mengaktifkan tombol submit
                }
            });
        }
    </script>
@endpush
