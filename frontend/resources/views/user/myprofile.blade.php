@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card card-primary card-outline">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="/img/{{ Auth::user()->foto }}"
                                alt="User profile picture" style="width: 200px; height: 200px">
                        </div>

                        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                        <p class="text-muted text-center">{{ Auth::user()->email }}</p>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#password">Change
                            passwrod</a>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#image">Change
                            image</a>
                        @if (Auth::user()->detail_data == null)
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#detail">Add
                                detail</a>
                        @else
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#updatedetail">Update
                                detail</a>
                        @endif
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">My profile</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong>Name</strong>
                        <p class="text-muted">
                            {{ Auth::user()->name }}
                        </p>
                        <hr>
                        <strong>Email</strong>
                        <p class="text-muted">
                            {{ Auth::user()->email }}
                        </p>
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Detail</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if (Auth::user()->detail_data != null)
                            <strong>Agama</strong>
                            <p class="text-muted">
                                {{ Auth::user()->detail_data->agama->nama_agama }}
                            </p>
                            <hr>
                            <strong>Alamat</strong>
                            <p class="text-muted">
                                {{ Auth::user()->detail_data->alamat }}
                            </p>
                            <hr>
                            <strong>Tempat lahir</strong>
                            <p class="text-muted">
                                {{ Auth::user()->detail_data->tempat_lahir }}
                            </p>
                            <hr>
                            <strong>Tanggal lahir</strong>
                            <p class="text-muted">
                                {{ Auth::user()->detail_data->tanggal_lahir }}
                            </p>
                            <hr>
                            <strong>Umur</strong>
                            <p class="text-muted">
                                {{ Auth::user()->detail_data->umur }}
                            </p>
                            <hr>
                            <strong>Foto ktp</strong>
                            <p class="text-muted text-center">
                                <img src="/img/{{ Auth::user()->detail_data->foto_ktp }}" alt="error"
                                    style="width: 300px; height: 200px" class="rounded">
                            </p>
                        @else
                            Details have not been added.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="image">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit image</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/myprofile45/edit/image/{{ Auth::user()->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="foto" required>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="password">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit agama</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/myprofile45/edit/password/{{ Auth::user()->id }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">New password</label>
                            <input type="text" class="form-control" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detail">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add detail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/detaildata45" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Agama</label>
                            <select class="form-control" name="id_agama">
                                <option selected disabled>Open this select menu</option>
                                @foreach ($agamas as $agama)
                                    <option value="{{ $agama['id'] }}">{{ $agama['nama_agama'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tempat lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" required
                                value="{{ old('tempat_lahir') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" required
                                value="{{ old('tanggal_lahir') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Umur</label>
                            <input type="number" class="form-control" name="umur" required
                                value="{{ old('umur') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto ktp</label>
                            <input type="file" name="foto_ktp" required>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (Auth::user()->detail_data != null)
        <div class="modal fade" id="updatedetail">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update detail</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/detaildata45/{{ Auth::user()->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="alamat" required
                                    value="{{ Auth::user()->detail_data->alamat }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Agama</label>
                                <select class="form-control" name="id_agama">
                                    <option selected value="{{ Auth::user()->detail_data->agama->id }}">
                                        {{ Auth::user()->detail_data->agama->nama_agama }}</option>
                                    @foreach ($agamas as $agama)
                                        <option value="{{ $agama['id'] }}">{{ $agama['nama_agama'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tempat lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" required
                                    value="{{ Auth::user()->detail_data->tempat_lahir }}"
                                    value="{{ old('tempat_lahir') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" required
                                    value="{{ Auth::user()->detail_data->tanggal_lahir }}"
                                    value="{{ old('tanggal_lahir') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Umur</label>
                                <input type="number" class="form-control" name="umur" required
                                    value="{{ Auth::user()->detail_data->umur }}" value="{{ old('umur') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto ktp</label>
                                <input type="file" name="foto_ktp" required
                                    value="{{ Auth::user()->detail_data->foto_ktp }}">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
