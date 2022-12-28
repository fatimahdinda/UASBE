@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
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
                    <div class="card-header bg-dark">
                        <h3 class="card-title">Agama</h3>
                    </div>
                    <div class="card-body">
                        <td>
                            <button class="btn btn-info mb-3" data-toggle="modal" data-target="#add">Add agama</button>
                        </td>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Nama agama</th>
                                    <th class="text-center" style="width: 300px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($response['data'] as $agama)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $agama['nama_agama'] }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <button class="btn btn-info btn-block" data-toggle="modal"
                                                        data-target="#edit{{ $agama['id'] }}">Edit</button>
                                                </div>
                                                <div class="col">
                                                    <form action="/agama45/{{ $agama['id'] }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-block">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
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

    {{-- add --}}
    <div class="modal fade" id="add">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add agama</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/agama45" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama agama</label>
                            <input type="text" class="form-control" name="nama_agama" value="{{ old('nama_agama') }}"
                                required>
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

    {{-- edit --}}
    @foreach ($response['data'] as $agama)
        <div class="modal fade" id="edit{{ $agama['id'] }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit agama</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/agama45/{{ $agama['id'] }}" method="post">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama agama</label>
                                <input type="text" class="form-control" name="nama_agama"
                                    value="{{ $agama['nama_agama'] }}" required>
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
    @endforeach
@endsection
