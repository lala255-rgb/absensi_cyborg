@extends('mentors.layout')

@section('content')
<style>
    .form-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 20px 0;
    }
    
    .form-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        padding: 40px;
        margin: 20px auto;
        max-width: 800px;
        position: relative;
        overflow: hidden;
    }
    
    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #f5576c);
    }
    
    .form-title {
        color: #333;
        font-size: 2.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 10px;
        background: linear-gradient(45deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .form-subtitle {
        text-align: center;
        color: #666;
        margin-bottom: 40px;
        font-size: 1.1rem;
    }
    
    .form-group {
        margin-bottom: 25px;
        position: relative;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
        font-size: 1rem;
    }
    
    .form-control {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid #e1e5e9;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background: white;
        transform: translateY(-2px);
    }
    
    .form-control:hover {
        border-color: #667eea;
        background: white;
    }
    
    .btn-submit {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 15px 40px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 8px 15px rgba(102, 126, 234, 0.3);
        display: block;
        margin: 30px auto;
    }
    
    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(102, 126, 234, 0.4);
    }
    
    .btn-back {
        background: linear-gradient(45deg, #ff6b6b, #ee5a52);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
    }
    
    .btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 107, 107, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .alert {
        border-radius: 12px;
        margin-bottom: 30px;
        padding: 20px;
        border: none;
    }
    
    .alert-danger {
        background: linear-gradient(45deg, #ff6b6b, #ee5a52);
        color: white;
    }
    
    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }
    
    .file-input-wrapper input[type=file] {
        position: absolute;
        left: -9999px;
    }
    
    .file-input-label {
        display: block;
        padding: 15px 20px;
        background: #f8f9fa;
        border: 2px dashed #667eea;
        border-radius: 12px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #667eea;
        font-weight: 600;
    }
    
    .file-input-label:hover {
        background: #667eea;
        color: white;
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        
        .form-card {
            margin: 10px;
            padding: 30px 20px;
        }
        
        .form-title {
            font-size: 2rem;
        }
    }
    
    .icon-input {
        position: relative;
    }
    
    .icon-input::before {
        content: '👤';
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.2rem;
        z-index: 1;
    }
    
    .icon-input input {
        padding-left: 50px;
    }
</style>

<div class="form-container">
    <div class="form-card">
        <a href="{{ route('mentors.index') }}" class="btn-back">← Kembali</a>
        
        <h1 class="form-title">Tambah Mentor Baru</h1>
        <p class="form-subtitle">Lengkapi form di bawah untuk menambah mentor baru</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops!</strong> Ada beberapa masalah dengan input Anda:
                <ul style="margin-top: 10px; margin-bottom: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('mentors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">👤 Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">📞 Nomor HP</label>
                    <input type="tel" name="nohp" class="form-control" placeholder="Contoh: 081234567890" value="{{ old('nohp') }}" required>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">📅 Tanggal dan Waktu</label>
                    <input type="datetime-local" name="tanggal_dan_waktu" class="form-control" value="{{ old('tanggal_dan_waktu') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">⚤ Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">📍 Alamat</label>
                <textarea name="alamat" class="form-control" placeholder="Masukkan alamat lengkap" rows="3" required>{{ old('alamat') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">📸 Foto Profil</label>
                <div class="file-input-wrapper">
                    <input type="file" name="foto" id="foto" accept="image/*">
                    <label for="foto" class="file-input-label">
                        📤 Klik untuk upload foto (JPG, PNG, GIF - Max 2MB)
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">📝 Keterangan</label>
                <textarea name="keterangan" class="form-control" placeholder="Masukkan keterangan tambahan..." rows="4">{{ old('keterangan') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">👨‍💼 Dibuat Oleh</label>
                <input type="text" name="created_by" class="form-control" placeholder="Masukkan nama pembuat" value="{{ old('created_by') }}" required>
            </div>

            <button type="submit" class="btn-submit">
                ✨ Simpan Data Mentor
            </button>
        </form>
    </div>
</div>

<script>
    // File input preview
    document.getElementById('foto').addEventListener('change', function(e) {
        const label = document.querySelector('.file-input-label');
        const fileName = e.target.files[0]?.name;
        if (fileName) {
            label.textContent = `📸 ${fileName}`;
            label.style.background = '#667eea';
            label.style.color = 'white';
        }
    });
    
    // Form animation
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });
</script>
@endsection