@extends('layouts.portofolio')

@section('title')
    Tambah Biodata Mahasiswa Sekolah Vokasi
@endsection

@section('content')
<div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">BIODATA</h2>
                <p class="dashboard-subtitle">
                  Isi Biodata Anda
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
                    <form action="{{ route('portofolio-biodata-store') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="name">Nama</label>
                                <input
                                  type="text"
                                  class="form-control"
                                  name="name"
                                  id="name"
                                  value="{{$user->name}}"
                                />
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>NIM</label>
                                <input type="text" class="form-control" name="nim" value="{{ $user->nim }}" />
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="email">Email</label>
                                <input
                                  type="text"
                                  class="form-control"
                                  name="email"
                                  id="email"
                                  value="{{$user->email}}"
                                />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" value="{{ $user->tempat_lahir }}" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" value="{{ $user->tanggal_lahir}}" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Alamat KTP</label>
                                <input type="text" class="form-control" name="address_one" value="{{ $user->address_one }}" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Alamat Solo</label>
                                <input type="text" class="form-control" name="alamat_solo" value="{{ $user->alamat_solo }}" />
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Prodi</label>
                                <select name="prodis_id" class="form-control">
                                  @foreach ($prodis as $p)
                                      <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Angkatan</label>
                                <input type="number" class="form-control" name="angkatan" value="{{ $user->angkatan}}" />
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Fakultas</label>
                                <input type="text" class="form-control" name="fakultas" value="{{ $user->fakultas }}" />
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" id="editor">{!! $user->deskripsi !!}</textarea>
                              </div>
                            </div>
                           
                            
                          </div>
                          <div class="row">
                            <div class="col">
                              <button
                                type="submit"
                                class="btn btn-info col-md-12"
                              >
                                Simpan
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