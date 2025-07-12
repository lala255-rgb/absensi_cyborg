@extends('izins.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Izin</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('izins.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>id_kategori_izin:</strong>
                {{ $izin->id_kategori_izin }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>id_user:</strong>
                {{ $izin->id_user }}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>deskripsi_izin:</strong>
                    {{ $izin->deskripsi_izin }}
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>status:</strong>
                        {{ $izin->status }}
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>surat_keterangan_sakit:</strong>
                            {{ $izin->surat_keterangan_sakit }}
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>created_by:</strong>
                                {{ $izin->created_by }}
                            </div>
                        </div>
                    </div>
                @endsection
