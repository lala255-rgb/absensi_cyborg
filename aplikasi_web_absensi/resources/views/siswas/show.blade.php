@extends('siswas.layout')

@section('content')
    <style>
        /* Custom styles untuk show siswa */
        .siswa-show-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 30px 0;
        }

        .show-header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .show-header h2 {
            color: white;
            font-size: 2.2rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .graduation-icon {
            width: 35px;
            height: 35px;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .back-btn-custom {
            background: rgba(255, 255, 255, 0.2) !important;
            color: white !important;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
            border-radius: 25px !important;
            padding: 10px 25px !important;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .back-btn-custom:hover {
            background: rgba(255, 255, 255, 0.3) !important;
            color: white !important;
            transform: translateY(-2px);
        }

        .show-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .info-group {
            margin-bottom: 25px;
            padding: 20px;
            background: #f8fafc;
            border-radius: 12px;
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
        }

        .info-group:hover {
            background: #f1f5f9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .info-group strong {
            display: block;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 8px;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 1.1rem;
            color: #2d3748;
            font-weight: 500;
            line-height: 1.5;
        }

        .row {
            margin-bottom: 15px;
        }

        .col-xs-12 {
            padding: 0 10px;
        }

        @media (max-width: 768px) {
            .show-header h2 {
                font-size: 1.8rem;
            }

            .show-card {
                padding: 25px;
            }

            .info-group {
                padding: 15px;
            }
        }
    </style>

    <div class="siswa-show-container">
        <div class="container">
            <div class="show-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>
                        <span class="graduation-icon">👤</span>
                        Show Siswa
                    </h2>
                    <a class="back-btn-custom" href="{{ route('siswas.index') }}">
                        ← Back
                    </a>
                </div>
            </div>

            <div class="show-card">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="info-group">
                            <strong>Nama:</strong>
                            <div class="info-value">{{ $siswa->nama }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="info-group">
                            <strong>Jenis Kelamin:</strong>
                            <div class="info-value">{{ $siswa->jenis_kelamin }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="info-group">
                            <strong>Asal Kampus:</strong>
                            <div class="info-value">{{ $siswa->asal_kampus }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="info-group">
                            <strong>Jurusan:</strong>
                            <div class="info-value">{{ $siswa->jurusan }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="info-group">
                            <strong>Semester:</strong>
                            <div class="info-value">{{ $siswa->semester }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="info-group">
                            <strong>Alamat:</strong>
                            <div class="info-value">{{ $siswa->alamat }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="info-group">
                            <strong>No HP:</strong>
                            <div class="info-value">{{ $siswa->nohp }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="info-group">
                            <strong>No HP Orang Tua:</strong>
                            <div class="info-value">{{ $siswa->nohp_orangtua }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="info-value">
                            @if ($siswa->foto)
                                <img src="{{ asset('uploads/fotos/' . $siswa->foto) }}" alt="Foto Siswa" width="150"
                                    height="150" style="border-radius: 12px; object-fit: cover;">
                            @else
                                <span class="text-muted">Belum ada foto</span>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="info-group">
                            <strong>Keterangan:</strong>
                            <div class="info-value">{{ $siswa->keterangan }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="info-group">
                            <strong>Created By:</strong>
                            <div class="info-value">{{ $siswa->created_by }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
