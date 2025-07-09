@extends('absensis.layout')

@section('content')
<div class="container-fluid p-4">
    <!-- Header -->
    <div class="header-section mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fas fa-clipboard-check me-2"></i>
                    Sistem Absensi Siswa
                </h1>
                <p class="page-subtitle">Smart Integrated System Palembang</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('absensis.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Absensi
                </a>
            </div>
        </div>
    </div>

    <!-- Success Alert -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <strong>Berhasil!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Search & Controls -->
    <div class="card search-card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="form-control search-input" id="searchInput" 
                               placeholder="Cari nama siswa atau status...">
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <button class="btn btn-outline-secondary" onclick="location.reload()">
                        <i class="fas fa-sync-alt me-2"></i>Refresh
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card table-card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-table me-2"></i>
                Data Absensi Siswa
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Siswa</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Waktu</th>
                            <th class="text-center">Status</th>
                            <th>Keterangan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($absensi as $item)
                            <tr class="table-row">
                                <td class="text-center">
                                    <span class="badge bg-light text-dark">{{ ++$i }}</span>
                                </td>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">
                                            {{ strtoupper(substr($item->id_user, 0, 2)) }}
                                        </div>
                                        <div>
                                            <strong>{{ $item->id_user }}</strong><br>
                                            <small class="text-muted">ID: {{ $item->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-secondary">{{ $item->role_user }}</span>
                                </td>
                                <td class="text-center">
                                    <i class="fas fa-calendar text-primary me-1"></i>
                                    {{ date('d/m/Y', strtotime($item->tanggal_dan_waktu)) }}
                                </td>
                                <td class="text-center">
                                    <i class="fas fa-clock text-success me-1"></i>
                                    {{ date('H:i', strtotime($item->tanggal_dan_waktu)) }}
                                </td>
                                <td class="text-center">
                                    @switch($item->status)
                                        @case('Hadir')
                                            <span class="badge bg-success">
                                                <i class="fas fa-check me-1"></i>Hadir
                                            </span>
                                            @break
                                        @case('Sakit')
                                            <span class="badge bg-warning">
                                                <i class="fas fa-thermometer-half me-1"></i>Sakit
                                            </span>
                                            @break
                                        @case('Izin')
                                            <span class="badge bg-info">
                                                <i class="fas fa-hand-paper me-1"></i>Izin
                                            </span>
                                            @break
                                        @case('Alfa')
                                            <span class="badge bg-danger">
                                                <i class="fas fa-times me-1"></i>Alfa
                                            </span>
                                            @break
                                        @default
                                            <span class="badge bg-secondary">{{ $item->status }}</span>
                                    @endswitch
                                </td>
                                <td>
                                    <span class="description">{{ $item->keterangan ?? '-' }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <!-- Detail Button -->
                                        <a href="{{ route('absensis.show', $item->id) }}" 
                                           class="btn btn-sm btn-info btn-action" 
                                           title="Lihat Detail"
                                           data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                            <span class="action-text">Detail</span>
                                        </a>
                                        <!-- Edit Button -->
                                        <a href="{{ route('absensis.edit', $item->id) }}" 
                                           class="btn btn-sm btn-warning btn-action" 
                                           title="Edit Data"
                                           data-bs-toggle="tooltip">
                                            <i class="fas fa-edit"></i>
                                            <span class="action-text">Edit</span>
                                        </a>
                                        <!-- Delete Button -->
                                        <form action="{{ route('absensis.destroy', $item->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger btn-action" 
                                                    title="Hapus Data"
                                                    data-bs-toggle="tooltip"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                                <span class="action-text">Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Belum Ada Data Absensi</h5>
                                        <p class="text-muted">Silakan tambahkan data absensi pertama</p>
                                        <a href="{{ route('absensis.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Tambah Absensi
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if ($absensi->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $absensi->links() }}
        </div>
    @endif
</div>

<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .page-title {
        color: #495057;
        font-weight: 600;
        font-size: 1.8rem;
        margin-bottom: 5px;
    }

    .page-subtitle {
        color: #6c757d;
        font-size: 1rem;
        margin-bottom: 0;
    }

    .header-section {
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        border: 1px solid #dee2e6;
    }

    .search-card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .search-container {
        position: relative;
    }

    .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        z-index: 2;
    }

    .search-input {
        padding-left: 40px;
        border-radius: 8px;
        border: 1px solid #ced4da;
        transition: border-color 0.3s;
    }

    .search-input:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
    }

    .table-card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .table-card .card-header {
        background-color: #007bff;
        color: white;
        border-bottom: none;
    }

    .table thead th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
        padding: 1rem 0.75rem;
    }

    .table tbody td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
        border-top: 1px solid #dee2e6;
    }

    .table-row:hover {
        background-color: #f8f9fa;
    }

    .student-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .student-avatar {
        width: 40px;
        height: 40px;
        background-color: #007bff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .description {
        color: #6c757d;
        font-style: italic;
        max-width: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .action-buttons {
        display: flex;
        gap: 5px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-action {
        min-width: 70px;
        padding: 0.375rem 0.5rem;
        border-radius: 5px;
        position: relative;
        transition: all 0.2s;
    }

    .btn-action:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .btn-action i {
        font-size: 0.9rem;
    }

    .action-text {
        font-size: 0.75rem;
        font-weight: 500;
        margin-left: 3px;
    }

    .empty-state {
        padding: 2rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-title {
            font-size: 1.5rem;
        }
        
        .header-section {
            padding: 1rem;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 3px;
        }
        
        .btn-action {
            min-width: 60px;
            font-size: 0.8rem;
        }
        
        .action-text {
            display: none;
        }
        
        .table {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 576px) {
        .action-buttons {
            flex-direction: row;
            gap: 2px;
        }
        
        .btn-action {
            min-width: 35px;
            padding: 0.25rem;
        }
        
        .btn-action i {
            font-size: 0.8rem;
        }
    }
</style>

<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('.table-row');

        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection