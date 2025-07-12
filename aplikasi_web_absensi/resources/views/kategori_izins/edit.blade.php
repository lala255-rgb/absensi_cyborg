@extends('kategori_izins.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit kategoriIzin</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('kategori_izins.index') }}"> Back</a>
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
    <form action="{{ route('katgeori_izins.update', $kategori_izin->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>nama_kategori:</strong>
                    <input type="text" name="nama_kategori" value="{{ $kategori_izin->nama_kategori }}"
                        class="form-control" placeholder="nama_kategori">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>keterangan:</strong>
                    <input type="text" name="keterangan" value="{{ $kategori_izin->keterangan }}" class="form-control"
                        placeholder="keterangan">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>created_by:</strong>
                        <input type="text" name="created_by" value="{{ $izin->created_by }}" class="form-control"
                            placeholder="created_by">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

    </form>
@endsection
