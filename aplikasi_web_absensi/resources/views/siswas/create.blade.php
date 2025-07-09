@extends('siswas.layout') 
   
@section('content')

<style>
    /* Custom styles untuk form siswa */
    .siswa-form-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 30px 0;
    }
    
    .form-header {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .form-header h2 {
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
    
    .form-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-group strong {
        display: block;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }
    
    .form-control {
        padding: 15px 20px !important;
        border: 2px solid #e2e8f0 !important;
        border-radius: 12px !important;
        font-size: 1rem !important;
        transition: all 0.3s ease !important;
        background: #f8fafc !important;
        width: 100% !important;
    }
    
    .form-control:focus {
        outline: none !important;
        border-color: #667eea !important;
        background: white !important;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1) !important;
    }
    
    .form-control::placeholder {
        color: #a0aec0;
        text-transform: capitalize;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        border: none !important;
        border-radius: 12px !important;
        padding: 15px 40px !important;
        font-size: 1.1rem !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3) !important;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4) !important;
    }
    
    .alert-danger {
        background: #fed7d7 !important;
        border: 1px solid #feb2b2 !important;
        color: #c53030 !important;
        border-radius: 12px !important;
        padding: 20px !important;
        margin-bottom: 25px !important;
    }
    
    .alert-danger strong {
        color: #c53030 !important;
    }
    
    .submit-section {
        text-align: center;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid #e2e8f0;
    }
    
    .row {
        margin-bottom: 15px;
    }
    
    @media (max-width: 768px) {
        .form-header h2 {
            font-size: 1.8rem;
        }
        
        .form-card {
            padding: 25px;
        }
    }
</style>

<div class="siswa-form-container">
    <div class="container">
        <div class="form-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2>
                    <span class="graduation-icon">🎓</span>
                    Add New Siswa
                </h2>
                <a class="back-btn-custom" href="{{ route('siswas.index') }}">
                    ← Back
                </a>
            </div>
        </div>

        <div class="form-card">
            @if ($errors->any()) 
                <div class="alert alert-danger"> 
                    <strong>Whoops!</strong> There were some problems with your input.<br><br> 
                    <ul> 
                        @foreach ($errors->all() as $error) 
                            <li>{{ $error }}</li> 
                        @endforeach 
                    </ul> 
                </div> 
            @endif 
                
            <form action="{{ route('siswas.store') }}" method="POST" enctype="multipart/form-data"> 
                @csrf 
            
                <div class="row"> 
                    <div class="col-xs-12 col-sm-12 col-md-12"> 
                        <div class="form-group"> 
                            <strong>Nama:</strong> 
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap"> 
                        </div> 
                    </div> 
                </div>
                
                <div class="row"> 
                    <div class="col-xs-12 col-sm-12 col-md-12"> 
                        <div class="form-group"> 
                            <strong>Jenis Kelamin:</strong> 
                            <select name="jenis_kelamin" class="form-control">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div> 
                    </div> 
                </div>
                
                <div class="row"> 
                    <div class="col-xs-12 col-sm-12 col-md-12"> 
                        <div class="form-group"> 
                            <strong>Asal Kampus:</strong> 
                            <input type="text" name="asal_kampus" class="form-control" placeholder="Masukkan asal kampus"> 
                        </div> 
                    </div> 
                </div>
                
                <div class="row"> 
                    <div class="col-xs-12 col-sm-12 col-md-12"> 
                        <div class="form-group"> 
                            <strong>Jurusan:</strong> 
                            <input type="text" name="jurusan" class="form-control" placeholder="Masukkan jurusan"> 
                        </div> 
                    </div> 
                </div>
                
                <div class="row"> 
                    <div class="col-xs-12 col-sm-12 col-md-12"> 
                        <div class="form-group"> 
                            <strong>Semester:</strong> 
                            <select name="semester" class="form-control">
                                <option value="">Pilih Semester</option>
                                <option value="1">Semester 1</option>
                                <option value="2">Semester 2</option>
                                <option value="3">Semester 3</option>
                                <option value="4">Semester 4</option>
                                <option value="5">Semester 5</option>
                                <option value="6">Semester 6</option>
                                <option value="7">Semester 7</option>
                                <option value="8">Semester 8</option>
                            </select>
                        </div> 
                    </div> 
                </div>
                
                <div class="row"> 
                    <div class="col-xs-12 col-sm-12 col-md-12"> 
                        <div class="form-group"> 
                            <strong>Alamat:</strong> 
                            <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                        </div> 
                    </div> 
                </div>
                
                <div class="row"> 
                    <div class="col-xs-12 col-sm-12 col-md-12"> 
                        <div class="form-group"> 
                            <strong>No HP:</strong> 
                            <input type="text" name="nohp" class="form-control" placeholder="Masukkan nomor HP"> 
                        </div> 
                    </div> 
                </div>
                
                <div class="row"> 
                    <div class="col-xs-12 col-sm-12 col-md-12"> 
                        <div class="form-group"> 
                            <strong>No HP Orang Tua:</strong> 
                            <input type="text" name="nohp_orangtua" class="form-control" placeholder="Masukkan nomor HP orang tua"> 
                        </div> 
                    </div> 
                </div>
                
                <div class="row"> 
                    <div class="col-xs-12 col-sm-12 col-md-12"> 
                        <div class="form-group"> 
                            <strong>Foto:</strong> 
                            <input type="file" name="foto" class="form-control" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, GIF (Max: 2MB) - Opsional</small>
                        </div> 
                    </div> 
                </div>
                
                <div class="row"> 
                    <div class="col-xs-12 col-sm-12 col-md-12"> 
                        <div class="form-group"> 
                            <strong>Keterangan:</strong> 
                            <textarea name="keterangan" class="form-control" rows="3" placeholder="Keterangan tambahan (opsional)"></textarea>
                        </div> 
                    </div> 
                </div>
                
                <div class="submit-section">
                    <button type="submit" class="btn btn-primary">Submit</button> 
                </div>
            </form>
        </div>
    </div>
</div>

@endsection