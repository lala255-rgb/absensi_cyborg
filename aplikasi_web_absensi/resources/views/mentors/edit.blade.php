@extends('mentors.layout')

@section('content')
    <div class="container-fluid"
        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 30px 0;">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <!-- Back Button -->
                <div class="mb-4">
                    <a href="{{ route('mentors.index') }}" class="btn btn-back">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>

                <!-- Main Card -->
                <div class="card main-card">
                    <div class="card-body p-0">
                        <!-- Header Section -->
                        <div class="header-section">
                            <h1 class="page-title">Edit Mentor</h1>
                            <p class="page-subtitle">Lengkapi form di bawah untuk mengubah data mentor</p>
                            <div class="mt-3">
                                <a href="{{ route('mentors.index') }}" class="btn btn-back-header">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </div>

                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="alert alert-danger mx-4 mt-3" style="border-radius: 15px; border: none;">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.
                                </div>
                                <ul class="mb-0 mt-2 ms-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Form Section -->
                        <div class="form-section">
                            <form action="{{ route('mentors.update', $mentor->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row g-4">
                                    <!-- Nama Lengkap -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-user label-icon"></i>Nama Lengkap
                                            </label>
                                            <input type="text" name="nama" class="form-control modern-input"
                                                value="{{ old('nama', $mentor->nama) }}"
                                                placeholder="Masukkan nama lengkap">
                                        </div>
                                    </div>

                                    <!-- Nomor HP -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-phone label-icon"></i>Nomor HP
                                            </label>
                                            <input type="text" name="nohp" class="form-control modern-input"
                                                value="{{ old('nohp', $mentor->nohp) }}" placeholder="Contoh: 08123456789">
                                        </div>
                                    </div>

                                    <!-- Tanggal dan Waktu -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-calendar-alt label-icon"></i>Tanggal dan Waktu
                                            </label>
                                            <input type="datetime-local" name="tanggal_dan_waktu"
                                                class="form-control modern-input"
                                                value="{{ old('tanggal_dan_waktu', $mentor->tanggal_dan_waktu ? date('Y-m-d\TH:i', strtotime($mentor->tanggal_dan_waktu)) : '') }}">
                                        </div>
                                    </div>

                                    <!-- Jenis Kelamin -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-venus-mars label-icon"></i>Jenis Kelamin
                                            </label>
                                            <select name="jenis_kelamin" class="form-select modern-select">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="Laki-laki"
                                                    {{ old('jenis_kelamin', $mentor->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                                    Laki-laki</option>
                                                <option value="Perempuan"
                                                    {{ old('jenis_kelamin', $mentor->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Alamat -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-map-marker-alt label-icon"></i>Alamat
                                            </label>
                                            <textarea name="alamat" class="form-control modern-textarea" rows="4" placeholder="Masukkan alamat lengkap">{{ old('alamat', $mentor->alamat) }}</textarea>
                                        </div>
                                    </div>

                                    <!-- Foto -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-camera label-icon"></i>Foto
                                            </label>
                                            <input type="text" name="foto" class="form-control modern-input"
                                                value="{{ old('foto', $mentor->foto) }}"
                                                placeholder="URL foto atau path file">
                                            <small class="text-muted mt-1">Atau upload file baru:</small>
                                            <div class="file-input-wrapper mt-2">
                                                <input type="file" name="foto_upload" class="form-control modern-file"
                                                    accept="image/*" id="fileInput">
                                                <label for="fileInput" class="file-input-label">
                                                    <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File Baru
                                                </label>
                                            </div>
                                            @if ($mentor->foto)
                                                <div class="current-file">
                                                    <i class="fas fa-image me-1"></i>
                                                    <small>Foto saat ini: {{ basename($mentor->foto) }}</small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Created By -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-user-edit label-icon"></i>Created By
                                            </label>
                                            <input type="text" name="created_by" class="form-control modern-input"
                                                value="{{ old('created_by', $mentor->created_by) }}"
                                                placeholder="Dibuat oleh">
                                        </div>
                                    </div>

                                    <!-- Keterangan -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-info-circle label-icon"></i>Keterangan
                                            </label>
                                            <textarea name="keterangan" class="form-control modern-textarea" rows="4"
                                                placeholder="Masukkan keterangan tambahan (opsional)">{{ old('keterangan', $mentor->keterangan) }}</textarea>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-12">
                                        <div class="text-center pt-3">
                                            <button type="submit" class="btn btn-submit">
                                                <i class="fas fa-save me-2"></i>Update Mentor
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-card {
            border: none;
            border-radius: 25px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background: white;
        }

        .header-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px;
            text-align: center;
            color: white;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .page-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 0;
            font-weight: 300;
        }

        .form-section {
            padding: 50px;
        }

        .btn-back,
        .btn-back-header {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            text-decoration: none;
        }

        .btn-back:hover,
        .btn-back-header:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            text-decoration: none;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
        }

        .label-icon {
            color: #667eea;
            margin-right: 8px;
            width: 16px;
        }

        .modern-input,
        .modern-select,
        .modern-textarea {
            border: 2px solid #e2e8f0;
            border-radius: 15px;
            padding: 15px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .modern-input:focus,
        .modern-select:focus,
        .modern-textarea:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: white;
            outline: none;
        }

        .modern-input:hover,
        .modern-select:hover,
        .modern-textarea:hover {
            border-color: #cbd5e0;
            background: white;
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .modern-file {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-input-label {
            display: block;
            padding: 15px 20px;
            background: #f8fafc;
            border: 2px dashed #cbd5e0;
            border-radius: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #4a5568;
            font-weight: 500;
        }

        .file-input-label:hover {
            background: #e2e8f0;
            border-color: #667eea;
            color: #667eea;
        }

        .current-file {
            margin-top: 10px;
            padding: 8px 12px;
            background: #e6fffa;
            border-radius: 8px;
            color: #2d3748;
            font-size: 0.9rem;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .alert-danger {
            background: #fed7d7;
            color: #c53030;
            border: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-section {
                padding: 30px 20px;
            }

            .header-section {
                padding: 30px 20px;
            }

            .page-title {
                font-size: 2rem;
            }

            .page-subtitle {
                font-size: 1rem;
            }
        }

        /* Animation */
        .main-card {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom Scrollbar */
        .modern-textarea::-webkit-scrollbar {
            width: 8px;
        }

        .modern-textarea::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .modern-textarea::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 10px;
        }

        .modern-textarea::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }
    </style>
@endsection
