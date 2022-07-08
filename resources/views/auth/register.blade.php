@extends('layouts.auth')

@section('content')

<div class="page-content page-auth" id="register">
    <div class="section-store-auth" data-aos="fade-up">
      <div class="container">
        <div class="row align-items-center row-login justify-content-center">
          <div class="col-lg-5">
            <h2>
              Belanja hasil karya Mahasiswa, <br />
              menjadi lebih mudah. Daftarkan segera
            </h2>
              <form method="POST" action="{{ route('register') }}" class="mt-3">
                @csrf
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input id="name" type="text"
                  v-model="name" 
                  class="form-control @error('name') is-invalid @enderror" 
                  name="name" 
                  value="{{ old('name') }}" 
                  required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
              </div>

              <div class="form-group">
                <label>E-mail</label>
                <input id="email" type="email"
                  v-model="email" 
                  @change="checkForEmailAvailability()"
                  class="form-control @error('email') is-invalid @enderror"
                  :class="{ 'is-invalid' : this.email_unavailable }" 
                  name="email" 
                  value="{{ old('email') }}" 
                  required autocomplete="email">
                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
              </div>

              <div class="form-group">
                <label>Password</label>
                <input id="password" type="password" 
                  class="form-control @error('password') is-invalid @enderror" 
                  name="password" required 
                  autocomplete="new-password">
                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
              </div>

              <div class="form-group">
                <label>Konfirmasi Password</label>
                <input id="password-confirm" 
                  type="password" 
                  class="form-control @error('password_confirmation') is-invalid @enderror" 
                  name="password_confirmation" required 
                  autocomplete="new-password">
                      @error('password_confirmation')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
              </div>
              
              <div class="form-group">
                <label>Toko</label>
                <p class="text-muted">
                  Apakah anda juga ingin membuka Toko dan memulai berjualan?
                </p>
                <div
                  class="custom-control custom-radio custom-control-inline"
                >
                  <input
                    type="radio"
                    class="custom-control-input"
                    name="is_store_open"
                    id="openStoreTrue"
                    v-model="is_store_open"
                    :value="true"
                  />
                  <label for="openStoreTrue" class="custom-control-label">
                    Iya, Boleh
                  </label>
                </div>
                <div
                  class="custom-control custom-radio custom-control-inline"
                >
                  <input
                    type="radio"
                    class="custom-control-input"
                    name="is_store_open"
                    id="openStoreFalse"
                    v-model="is_store_open"
                    :value="false"
                  />
                  <label for="openStoreFalse" class="custom-control-label">
                    Tidak, hanya membeli
                  </label>
                </div>
              </div>
              <div class="form-group" v-if="is_store_open">
                <label>Nama Toko</label>
                <input type="text"
                    v-model="store_name"
                    id="store_name"
                    class="form-control @error('store_name') is-invalid @enderror"
                    name="store_name"
                    required
                    autocomplete
                    autofocus >
                      @error('store_name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
              </div>
              <div class="form-group" v-if="is_store_open">
                <label>Kategori</label>
                <select type="category" class="form-control" name="categories_id">
                  <option value="" disabled>Select category</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
              <button type="submit" 
                class="btn btn-success btn-block mt-4"
                :disabled="this.email_unavailable"
              >
                Daftar Sekarang
              </button>
              <a href="{{route('login')}}" class="btn btn-signup btn-block mt-4"
                >Sign In Kembali
              </a>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>


@push('addon-script')
</script>
<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/vue-toasted"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
  Vue.use(Toasted);

  var register = new Vue({
    el: "#register",
    mounted() {
      AOS.init();
      /*  */
    },
    methods: {
      checkForEmailAvailability: function() {
        var self = this;
        axios.get('{{ route('api-register-check') }}', {
          params: {
            email: this.email
          }
        })
          .then(function (response) {
            if(response.data == 'Available') {
              self.$toasted.show(
                "Email tersedia untuk digunakan :)",
                {
                  position: "top-center",
                  className: "rounded",
                  duration: 1000,
                }
              );
                self.email_unavailable = false;

            } else {
              self.$toasted.error(
                "Maaf, email sudah terdaftar. Gunakan email lain untuk mendaftar!!",
                {
                  position: "top-center",
                  className: "rounded",
                  duration: 1000,
                }
              );
                self.email_unavailable = true;  

            }

            // handle success
            console.log(response);
          });
      }
    },
    data() {
      return {
        name: "Exca Muchlis Andita",
        email: "exca@test.test",
        is_store_open: true,
        store_name: "",
        email_unavailable: false,
      }
    },
  });
</script>
@endpush
@endsection
