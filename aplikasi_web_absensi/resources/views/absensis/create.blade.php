@extends('absensis.layout')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-gradient-primary text-white">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h2 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Add New Absensi</h2>
                    </div>
                    <div class="col-lg-4 text-end">
                        <a class="btn btn-light btn-sm" href="{{ route('absensis.index') }}">
                            <i class="fas fa-arrow-left me-1"></i>Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('absensis.store') }}" method="POST" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                    @csrf

                    <div class="row g-3">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fas fa-user me-2"></i>id_user:</strong>
                                <input type="text" name="id_user" class="form-control mt-2" placeholder="id_user">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fas fa-user-tag me-2"></i>role_user:</strong>
                                <select name="role_user" class="form-select mt-2">
                                    <option value="">Pilih Role User</option>
                                    <option value="mentor">Mentor</option>
                                    <option value="mahasiswa">Mahasiswa</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fas fa-calendar-alt me-2"></i>tanggal_dan_waktu:</strong>
                                <input type="datetime-local" name="tanggal_dan_waktu" class="form-control mt-2"
                                    value="{{ date('Y-m-d\TH:i') }}">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fas fa-camera me-2"></i>foto_absensi:</strong>
                                <input type="file" name="foto_absensi" class="form-control mt-2" accept="image/*"
                                    id="foto_absensi">
                                <div class="form-text mt-1">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Format yang diizinkan: JPG, PNG, GIF. Maksimal 2MB
                                </div>
                                <div id="imagePreview" class="mt-3" style="display: none;">
                                    <img id="preview" src="#" alt="Preview"
                                        style="max-width: 200px; max-height: 200px; border-radius: 10px; border: 2px solid #e9ecef;">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fas fa-info-circle me-2"></i>status:</strong>
                                <input type="text" name="status" class="form-control mt-2" placeholder="status">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fas fa-comment me-2"></i>keterangan:</strong>
                                <input type="text" name="keterangan" class="form-control mt-2" placeholder="keterangan">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fas fa-user-check me-2"></i>created_by:</strong>
                                <input type="text" name="created_by" class="form-control mt-2" placeholder="created_by">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="fas fa-save me-2"></i>Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group strong {
            display: block;
            margin-bottom: 0.5rem;
            color: #495057;
            font-weight: 600;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-select {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #fff;
        }

        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            background-color: #fff;
        }

        .form-text {
            font-size: 0.875rem;
            color: #6c757d;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            background-color: #fff;
        }

        .form-control::placeholder {
            color: #adb5bd;
            opacity: 1;
        }

        .btn {
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 0.75rem 2rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
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

        .alert {
            border-radius: 10px;
            border: none;
            margin-bottom: 1.5rem;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
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

            .btn-lg {
                width: 100%;
            }
        }

        /* Hover effects */
        .form-control:hover,
        .form-select:hover {
            border-color: #ced4da;
        }

        .card {
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }
    </style>

    <script>
        // Preview foto yang diupload
        document.addEventListener('DOMContentLoaded', function() {
            const fotoInput = document.getElementById('foto_absensi');
            const imagePreview = document.getElementById('imagePreview');
            const preview = document.getElementById('preview');

            if (fotoInput) {
                fotoInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            imagePreview.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        imagePreview.style.display = 'none';
                    }
                });
            }
        });
    </script>
@endsection
