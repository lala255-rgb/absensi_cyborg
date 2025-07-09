@extends('mentors.layout')

@section('content')
<style>
    .header-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem 0;
        margin: -20px -20px 30px -20px;
        border-radius: 0 0 20px 20px;
    }
    
    .header-content {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .header-icon {
        font-size: 2.5rem;
        margin-right: 1rem;
    }
    
    .header-title {
        margin: 0;
        font-size: 2.2rem;
        font-weight: 600;
    }
    
    .header-subtitle {
        margin: 0;
        font-size: 1.1rem;
        opacity: 0.9;
    }
    
    .top-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        gap: 1rem;
    }
    
    .create-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 12px 24px;
        border-radius: 25px;
        color: white;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: transform 0.2s;
    }
    
    .create-btn:hover {
        transform: translateY(-2px);
        color: white;
        text-decoration: none;
    }
    
    .search-container {
        position: relative;
        max-width: 300px;
        flex: 1;
    }
    
    .search-input {
        width: 100%;
        padding: 12px 20px 12px 45px;
        border: 2px solid #e2e8f0;
        border-radius: 25px;
        font-size: 14px;
        transition: border-color 0.3s;
    }
    
    .search-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    
    .search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
    }
    
    .students-table {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 2rem;
    }
    
    .table {
        margin: 0;
    }
    
    .table thead th {
        background: #f8fafc;
        border: none;
        padding: 1rem;
        font-weight: 600;
        color: #475569;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    
    .table tbody td {
        padding: 1rem;
        border: none;
        border-bottom: 1px solid #e2e8f0;
        vertical-align: middle;
    }
    
    .table tbody tr:hover {
        background-color: #f8fafc;
    }
    
    .student-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
    }
    
    .student-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 16px;
        margin-right: 12px;
    }
    
    .student-info {
        display: flex;
        align-items: center;
    }
    
    .student-name {
        font-weight: 600;
        color: #1e293b;
        margin: 0;
    }
    
    .student-role {
        font-size: 0.85rem;
        color: #64748b;
        margin: 0;
    }
    
    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
        background: #e2e8f0;
        color: #475569;
    }
    
    .location-info, .contact-info, .phone-info {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #475569;
    }
    
    .photo-preview {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        object-fit: cover;
        border: 2px solid #e2e8f0;
    }
    
    .action-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    
    .btn-sm {
        padding: 6px 12px;
        font-size: 0.8rem;
        border-radius: 6px;
        border: none;
        font-weight: 500;
        transition: all 0.2s;
        text-decoration: none;
    }
    
    .btn-info {
        background: #0ea5e9;
        color: white;
    }
    
    .btn-info:hover {
        background: #0284c7;
        transform: translateY(-1px);
        color: white;
        text-decoration: none;
    }
    
    .btn-primary {
        background: #8b5cf6;
        color: white;
    }
    
    .btn-primary:hover {
        background: #7c3aed;
        transform: translateY(-1px);
        color: white;
        text-decoration: none;
    }
    
    .btn-danger {
        background: #ef4444;
        color: white;
    }
    
    .btn-danger:hover {
        background: #dc2626;
        transform: translateY(-1px);
    }
    
    .alert {
        border-radius: 10px;
        border: none;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .alert-success {
        background: #dcfce7;
        color: #166534;
        border-left: 4px solid #16a34a;
    }
    
    .pagination {
        justify-content: center;
        margin-top: 2rem;
    }
    
    .page-link {
        border: none;
        padding: 10px 16px;
        margin: 0 4px;
        border-radius: 8px;
        color: #667eea;
        font-weight: 500;
    }
    
    .page-link:hover {
        background: #667eea;
        color: white;
    }
    
    .page-item.active .page-link {
        background: #667eea;
        color: white;
    }
    
    @media (max-width: 768px) {
        .top-controls {
            flex-direction: column;
            gap: 1rem;
        }
        
        .search-container {
            max-width: 100%;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 4px;
        }
        
        .table-responsive {
            font-size: 0.9rem;
        }
        
        .student-info {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .student-avatar {
            margin-right: 0;
            margin-bottom: 8px;
        }
    }
</style>

<div class="header-section">
    <div class="container">
        <div class="header-content">
            <div class="header-icon">🎓</div>
            <div>
                <h1 class="header-title">Sistem Informasi Absensi Siswa</h1>
                <p class="header-subtitle">Smart Integrated System Palembang</p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="top-controls">
        <a href="{{ route('mentors.create') }}" class="create-btn">
            <span>➕</span>
            Create New Mentor
        </a>
        
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Search students..." id="searchInput">
            <div class="search-icon">🔍</div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="students-table">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>JENIS KELAMIN</th>
                        <th>NOHP</th>
                        <th>TANGGAL DAN WAKTU</th>
                        <th>ALAMAT</th>
                        <th>FOTO</th>
                        <th>KETERANGAN</th>
                        <th>CREATED BY</th>
                        <th width="280px">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mentors as $mentor)
                        <tr>
                            <td>
                                <div class="student-number">{{ ++$i }}</div>
                            </td>
                            <td>
                                <div class="student-info">
                                    <div class="student-avatar">
                                        {{ strtoupper(substr($mentor->nama, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="student-name">{{ $mentor->nama }}</div>
                                        <div class="student-role">Student</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge">{{ $mentor->jenis_kelamin }}</span>
                            </td>
                            <td>
                                <div class="contact-info">
                                    <span>📞</span>
                                    <span>{{ $mentor->nohp }}</span>
                                </div>
                            </td>
                            <td>{{ $mentor->tanggal_dan_waktu }}</td>
                            <td>
                                <div class="location-info">
                                    <span>📍</span>
                                    <span>{{ $mentor->alamat }}</span>
                                </div>
                            </td>
                            <td>
                                @if($mentor->foto)
                                    <img src="{{ asset('storage/' . $mentor->foto) }}" alt="Photo" class="photo-preview">
                                @else
                                    <div class="photo-preview" style="background: #f1f5f9; display: flex; align-items: center; justify-content: center; color: #64748b;">
                                        📷
                                    </div>
                                @endif
                            </td>
                            <td>{{ $mentor->keterangan }}</td>
                            <td>{{ $mentor->created_by }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('mentors.show', $mentor->id) }}" class="btn btn-info btn-sm">Show</a>
                                    <a href="{{ route('mentors.edit', $mentor->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('mentors.destroy', $mentor->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {!! $mentors->links() !!}
    </div>
</div>

<script>
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('tbody tr');
    
    tableRows.forEach(row => {
        const studentName = row.querySelector('.student-name').textContent.toLowerCase();
        const studentInfo = row.textContent.toLowerCase();
        
        if (studentInfo.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>
@endsection