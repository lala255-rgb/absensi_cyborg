@extends('kategori_izins.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Sistem Informasi Absensi</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('kategori_izins.create') }}"> Create New kategori Izin</a>
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
            <th>nama_kategori</th>
            <th>keterangan</th>
            <th>created_by</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($kategori_izins as $kategori_izin)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $kategori_izin->nama_kategori }}</td>
                <td>{{ $kategori_izin->katerangan }}</td>
                <td>{{ $kategori_izin->created_by }}</td>

                <td>
                    <form action="{{ route('kategori_izins.destroy', $kategori_izin->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('kategori_izins.show', $kategori_izin->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('kategori_izins.edit', $kategori_izin->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btndanger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $kategori_izin->links() !!}
@endsection
