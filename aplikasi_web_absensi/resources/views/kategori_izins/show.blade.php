@extends('kategori_izins.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show kategori Izin</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('kategori_izins.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>nama_kategori:</strong>
                {{ $kategori_izin->nama_kategori }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>keterangan:</strong>
                {{ $kategori_izin->keterangan }}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>created_by:</strong>
                    {{ $kategori_izin->created_by }}
                </div>
            </div>
        @endsection
