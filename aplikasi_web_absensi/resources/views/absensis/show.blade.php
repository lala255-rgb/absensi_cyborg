@extends('absensis.layout')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-gradient-info text-white">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h2 class="mb-0"><i class="fas fa-eye me-2"></i>Detail Absensi</h2>
                    </div>
                    <div class="col-lg-4 text-end">
                        <a class="btn btn-light btn-sm" href="{{ route('absensis.index') }}">
                            <i class="fas fa-arrow-left me-1"></i>Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="row g-4">
                    <!-- ID User -->
                    <div class="col-md-6">
                        <div class="info-card">
                            <div class="info-label">
                                <i class="fas fa-user text-primary me-2"></i>
                                <strong>ID User:</strong>
                            </div>
                            <div class="info-value">
                                {{ $absensi->id_user }}
                            </div>
                        </div>
                    </div>

                    <!-- Role User -->
                    <div class="col-md-6">
                        <div class="info-card">
                            <div class="info-label">
                                <i class="fas fa-user-tag text-success me-2"></i>
                                <strong>Role User:</strong>
                            </div>
                            <div class="info-value">
                                <span
                                    class="badge bg-{{ $absensi->role_user == 'admin' ? 'danger' : ($absensi->role_user == 'mentor' ? 'warning' : 'info') }} fs-6">
                                    {{ ucfirst($absensi->role_user) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal dan Waktu -->
                    <div class="col-md-6">
                        <div class="info-card">
                            <div class="info-label">
                                <i class="fas fa-calendar-alt text-info me-2"></i>
                                <strong>Tanggal dan Waktu:</strong>
                            </div>
                            <div class="info-value">
                                {{ date('d F Y - H:i', strtotime($absensi->tanggal_dan_waktu)) }} WIB
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <div class="info-card">
                            <div class="info-label">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <strong>Status:</strong>
                            </div>
                            <div class="info-value">
                                <span
                                    class="badge bg-{{ $absensi->status == 'hadir' ? 'success' : ($absensi->status == 'sakit' ? 'warning' : ($absensi->status == 'izin' ? 'info' : 'danger')) }} fs-6">
                                    {{ ucfirst($absensi->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Foto Absensi -->
                    <div class="col-md-12">
                        <div class="info-card">
                            <div class="info-label">
                                <i class="fas fa-camera text-warning me-2"></i>
                                <strong>Foto Absensi:</strong>
                            </div>
                            <div class="info-value">
                                @if ($absensi->foto_absensi)
                                    <div class="photo-container">
                                        <img src="{{ asset('storage/absensi/' . $absensi->foto_absensi) }}"
                                            alt="Foto Absensi" class="img-fluid rounded shadow-sm"
                                            style="max-width: 300px; max-height: 300px; cursor: pointer;"
                                            onclick="openImageModal(this.src)">
                                        <div class="mt-2">
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Klik gambar untuk memperbesar
                                            </small>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-muted">
                                        <i class="fas fa-image me-1"></i>
                                        Tidak ada foto
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div class="col-md-12">
                        <div class="info-card">
                            <div class="info-label">
                                <i class="fas fa-comment text-secondary me-2"></i>
                                <strong>Keterangan:</strong>
                            </div>
                            <div class="info-value">
                                @if ($absensi->keterangan)
                                    <div class="keterangan-box">
                                        {{ $absensi->keterangan }}
                                    </div>
                                @else
                                    <span class="text-muted">
                                        <i class="fas fa-minus me-1"></i>
                                        Tidak ada keterangan
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Created By -->
                    <div class="col-md-6">
                        <div class="info-card">
                            <div class="info-label">
                                <i class="fas fa-user-check text-dark me-2"></i>
                                <strong>Created By:</strong>
                            </div>
                            <div class="info-value">
                                {{ $absensi->created_by }}
                            </div>
                        </div>
                    </div>

                    <!-- Waktu Dibuat -->
                    <div class="col-md-6">
                        <div class="info-card">
                            <div class="info-label">
                                <i class="fas fa-clock text-muted me-2"></i>
                                <strong>Dibuat Pada:</strong>
                            </div>
                            <div class="info-value">
                                {{ $absensi->created_at ? date('d F Y - H:i', strtotime($absensi->created_at)) . ' WIB' : 'Tidak tersedia' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="{{ route('absensis.edit', $absensi->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                            <a href="{{ route('absensis.index') }}" class="btn btn-secondary">
                                <i class="fas fa-list me-1"></i>Lihat Semua
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk memperbesar gambar -->
    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foto Absensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid rounded" alt="Foto Absensi">
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-gradient-info {
            background: linear-gradient(135deg, #36d1dc 0%, #5b86e5 100%);
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
            margin-top: 20px;
        }

        .card-header {
            border-bottom: none;
            padding: 1.5rem;
        }

        .card-body {
            background-color: #f8f9fa;
        }

        .info-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
            height: 100%;
        }

        .info-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .info-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .info-value {
            font-size: 1.1rem;
            color: #212529;
            word-wrap: break-word;
        }

        .keterangan-box {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid #007bff;
            font-style: italic;
        }

        .photo-container {
            text-align: center;
        }

        .badge {
            font-size: 0.9rem !important;
            padding: 0.5rem 1rem;
        }

        .btn {
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1.5rem;
        }

        .btn-light {
            background-color: #fff;
            border: 2px solid #fff;
            color: #495057;
        }

        .btn-light:hover {
            background-color: #f8f9fa;
            border-color: #f8f9fa;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .container-fluid {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .card-header .row {
                text-align: center;
            }

            .card-header .col-lg-4 {
                margin-top: 1rem;
            }

            .info-card {
                margin-bottom: 1rem;
            }
        }

        /* Modal styling */
        .modal-content {
            border-radius: 15px;
        }

        .modal-header {
            background: linear-gradient(135deg, #36d1dc 0%, #5b86e5 100%);
            color: white;
            border-radius: 15px 15px 0 0;
        }

        .modal-header .btn-close {
            filter: invert(1);
        }
    </style>

    <script>
        function openImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            new bootstrap.Modal(document.getElementById('imageModal')).show();
        }
    </script>
@endsection
