@extends('layouts.dashboard')

@section('title')
    Tambah Produk-Sekolah Vokasi E-COM
@endsection

@section('content')
<div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Tambah Produk Baru</h2>
                <p class="dashboard-subtitle">
                  tambah produk yang ingin dijual!
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
                    <form action="{{ route('dashboard-product-store')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" class="form-control" name="name" />
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Harga Produk</label>
                                <input type="number" class="form-control" name="price" />
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Stok Produk</label>
                                <input type="number" class="form-control" name="stock" />
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Kategori</label>
                                <select name="categories_id" class="form-control">
                                  @foreach ($categories as $category)
                                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                                  @endforeach
                              </select>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Deskripsi Produk</label>
                                <textarea name="description" id="editor"></textarea>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Gambar Thumbnail</label>
                                <input type="file" name="photo" class="form-control" />
                                <p class="text-muted">
                                </p>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col">
                              <button
                                type="submit"
                                class="btn btn-success col-md-12"
                              >
                                Simpan Produk
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector("#editor"))
        .then((editor) => {
            console.log(editor);
        })
        .catch((error) => {
            console.error(error);
        });
</script>
<script>
    ckeditor.replace("editor");
</script>
@endpush
