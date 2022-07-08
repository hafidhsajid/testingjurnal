@extends('layouts.portofolio')

@section('title')
   Update Project Mahasiswa Sekolah Vokasi
@endsection

@section('content')
<div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Project</h2>
                <p class="dashboard-subtitle">
                  Update Data Project
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
                    <form action="{{ route('portofolio-project-update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                      <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Judul</label>
                                <input type="text" class="form-control" name="nama" value="{{ $item->judul }}" />
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Mulai Pengerjaan</label>
                                <input type="date" class="form-control" name="tanggal_mulai" value="{{ $item->tanggal_mulai}}"/>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Status</label>
                                  <select name="status" required id="status" class="form-control">
                                    <option value="{{ $item->status }}" selected>Tidak Berubah ({{ $item->status }})</option>
                                    <option value="proses">Proses</option>
                                    <option value="selesai">Selesai</option>
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Selesai Pengerjaan</label>
                                <input type="date" class="form-control" name="tanggal_selesai" value="{{ $item->tanggal_selesai}}" />
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