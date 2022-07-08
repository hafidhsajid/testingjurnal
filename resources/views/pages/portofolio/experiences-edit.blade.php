@extends('layouts.portofolio')

@section('title')
    Update Pengalaman Kerja Mahasiswa Sekolah Vokasi
@endsection

@section('content')
<div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Riwayat Pengalaman Kerja</h2>
                <p class="dashboard-subtitle">
                  Update Data Pengalaman Kerja
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
                    <form action="{{ route('portofolio-experiences-update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                      <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Nama Perusahaan</label>
                                <input type="text" class="form-control" name="perusahaan" value="{{ $item->perusahaan }}" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Lokasi Perusahaan</label>
                                <input type="text" class="form-control" name="lokasi_perusahaan" value="{{ $item->lokasi_perusahaan }}"/>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" value="{{ $item->jabatan }}" />
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Bidang</label>
                                <input type="text" class="form-control" name="bidang" value="{{ $item->bidang }}" />
                              </div>
                            </div>
                            
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Status</label>
                                <input type="text" class="form-control" name="jabatans_id" value="1" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Waktu Mulai</label>
                                <input type="date" class="form-control" name="waktu_mulai" value="{{ $item->waktu_mulai }}"/>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Waktu Selesai</label>
                                <input type="date" class="form-control" name="waktu_selesai" value="{{ $item->waktu_selesai}}" />
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                  <label>Deksripsi</label>
                                  <textarea name="deskripsi" id="editor"> {!! $item->deskripsi !!} </textarea>
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