@extends('layouts.admin')

@section('title')
    Dashboard-Sekolah Vokasi E-COM
@endsection

@section('content')

@if (session('error'))
     <div class="alert alert-danger">
         {{ session('error') }}
     </div>
  @endif

<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Admin Dashboard - User</h2>
            <p class="dashboard-subtitle">Sekolah Vokasi E-Commerce</p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('user-baru.create')}}" class="btn btn-info mb-3">
                                Tambah User
                            </a>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead class="bg-info">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Roles</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                @foreach($users as $user)
                  <tr>
                    <th scope="row" class="text-center">{{$loop->iteration}}</th>
                    <td scope="row" class="text-center" hidden>{{$user->id}}</td>
                    <td scope="row" class="text-center">{{$user->name}}</td>
                    <td scope="row" class="text-center">{{$user->email}}</td>
                    <td scope="row" class="text-center">{{$user->roles}}</td>
                    <td scope="row" class="text-center">
                          @if($user->is_active == 0)
                            <a href="{{route ('update-status-baru', ['id' => $user->id, 'status_code' => 1]) }}" class="btn btn-danger mb-3" >Tidak Aktif<i class="fas fa-ban"></i></a>
                          @else
                            <a href="{{route ('update-status-baru', ['id' => $user->id, 'status_code' => 0]) }}" class="btn btn-success m-3" >Aktif<i class="fas fa-check"></i></a>
                          @endif
                    </td>
                    <td scope="row" class="text-center">
                      <a href="{{ route('user-baru.edit', $user->id) }}" class="btn btn-primary" >Edit<i class="fas fa-pencil-alt"></i></a>


                      <form action="{{ route('user-baru.destroy', $user->id) }}" method="POST">
                          @method('Delete')
                          @csrf
                                        <button type="submit" class="btn btn-danger">
                                            Hapus
                                        </button>
                                    </form>
                      {{-- <a href={{ route('user-baru.destroy', $user->id) }} class="btn btn-danger" user-id="{{$user->id}}" user-num="{{$loop->iteration}}"><i class="fas fa-trash-alt"></i></a> --}}
                      
                    </td>
                  </tr>
                  @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<script>
    $('.delete').click(function(){

        var id = $(this).attr('user-id')
        var user_num = $(this).attr('user-num')

        Swal.fire({
          title: "Apakah anda yakin?",
          text: "Hapus data user "+user_num+"??",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location = "/user-baru/"+id+"/delete";  
            Swal.fire(
              'Berhasil!',
              'Data berhasil dihapus ',
              'success'
            )
          }
        })
    });
</script>