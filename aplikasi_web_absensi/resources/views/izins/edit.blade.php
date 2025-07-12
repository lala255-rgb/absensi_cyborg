@extends('izins.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Izin</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('izins.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your
            input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('izins.update', $izin->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>id_kategori_izin:</strong>
                    <input type="text" name="id_kategori_izin" value="{{ $izin->id_kategori_izin }}" class="form-control"
                        placeholder="id_kategori_izin">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>id_user:</strong>
                    <input type="text" name="id_user" value="{{ $izin->id_user }}" class="form-control"
                        placeholder="id_user">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>deskripsi_izin:</strong>
                        <input type="text" name="deskripsi_izin" value="{{ $izin->deskripsi_izin }}" class="form-control"
                            placeholder="deskripsi_izin">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>status:</strong>
                            <input type="text" name="status" value="{{ $izin->status }}" class="form-control"
                                placeholder="status">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>surat_keterangan_sakit:</strong>
                                <input type="text" name="surat_keterangan_sakit"
                                    value="{{ $izin->surat_keterangan_sakit }}" class="form-control"
                                    placeholder="surat_keterangan_sakit">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>created_by:</strong>
                                    <input type="text" name="created_by" value="{{ $izin->created_by }}"
                                        class="form-control" placeholder="created_by">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

    </form>
@endsection
