@extends('izins.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Sistem Informasi Absensi</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('izins.create') }}"> Create New Izin</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>id_kategori_izin</th>
            <th>id_user</th>
            <th>deskripsi_izin</th>
            <th>status</th>
            <th>Surat_keterangan_Sakit</th>
            <th>created_by</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($izins as $izin)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $izin->id_kategori_izin }}</td>
                <td>{{ $izin->id_user }}</td>
                <td>{{ $izin->deskripsi_izin }}</td>
                <td>{{ $izin->status }}</td>
                <td>{{ $izin->Surat_keterangan_Sakit }}</td>
                <td>{{ $izin->created_by }}</td>
                <td>
                    <form action="{{ route('izins.destroy', $izin->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('izins.show', $izin->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('izins.edit', $izin->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btndanger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $izin->links() !!}
@endsection
