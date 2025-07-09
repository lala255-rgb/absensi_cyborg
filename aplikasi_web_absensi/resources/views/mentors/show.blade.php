@extends('mentors.layout')

@section('content')
<style>
    .show-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 20px 0;
    }
    
    .show-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        padding: 40px;
        margin: 20px auto;
        max-width: 900px;
        position: relative;
        overflow: hidden;
    }
    
    .show-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #f5576c);
    }
    
    .show-title {
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
    
    .show-subtitle {
        text-align: center;
        color: #666;
        margin-bottom: 40px;
        font-size: 1.1rem;
    }
    
    .profile-section {
        display: flex;
        align-items: center;
        margin-bottom: 40px;
        padding: 30px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
        border: 2px solid #e1e5e9;
    }
    
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin-right: 30px;
        border: 4px solid #667eea;
        background: linear-gradient(45deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: white;
        font-weight: bold;
        flex-shrink: 0;
    }
    
    .profile-info {
        flex: 1;
    }
    
    .profile-name {
        font-size: 2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
    }
    
    .profile-role {
        color: #667eea;
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 15px;
    }
    
    .profile-meta {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .profile-meta span {
        background: #667eea;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }
    
    .detail-item {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 15px;
        border-left: 5px solid #667eea;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .detail-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        background: white;
    }
    
    .detail-label {
        font-weight: 700;
        color: #333;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        font-size: 1.1rem;
    }
    
    .detail-label::before {
        margin-right: 10px;
        font-size: 1.3rem;
    }
    
    .detail-value {
        color: #555;
        font-size: 1rem;
        line-height: 1.5;
        word-break: break-word;
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
    
    .action-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 30px;
    }
    
    .btn-edit {
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
    }
    
    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .btn-delete {
        background: linear-gradient(45deg, #dc3545, #c82333);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    }
    
    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .photo-preview {
        width: 100%;
        max-width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
        border: 3px solid #667eea;
        margin-top: 10px;
    }
    
    .no-photo {
        width: 100%;
        height: 200px;
        background: linear-gradient(45deg, #667eea, #764ba2);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
        margin-top: 10px;
    }
    
    @media (max-width: 768px) {
        .profile-section {
            flex-direction: column;
            text-align: center;
        }
        
        .profile-avatar {
            margin-right: 0;
            margin-bottom: 20px;
        }
        
        .details-grid {
            grid-template-columns: 1fr;
        }
        
        .show-card {
            margin: 10px;
            padding: 30px 20px;
        }
        
        .show-title {
            font-size: 2rem;
        }
        
        .action-buttons {
            flex-direction: column;
            align-items: center;
        }
    }
</style>

<div class="show-container">
    <div class="show-card">
        <a href="{{ route('mentors.index') }}" class="btn-back">← Kembali</a>
        
        <h1 class="show-title">Detail Mentor</h1>
        <p class="show-subtitle">Informasi lengkap tentang mentor</p>

        <!-- Profile Section -->
        <div class="profile-section">
            <div class="profile-avatar">
                {{ strtoupper(substr($mentor->nama, 0, 1)) }}
            </div>
            <div class="profile-info">
                <div class="profile-name">{{ $mentor->nama }}</div>
                <div class="profile-role">📚 Mentor</div>
                <div class="profile-meta">
                    <span>📅 {{ \Carbon\Carbon::parse($mentor->tanggal_dan_waktu)->format('d M Y') }}</span>
                    <span>⚤ {{ $mentor->jenis_kelamin }}</span>
                    <span>👤 {{ $mentor->created_by }}</span>
                </div>
            </div>
        </div>

        <!-- Details Grid -->
        <div class="details-grid">
            <div class="detail-item">
                <div class="detail-label" style="&::before { content: '📞'; }">
                    📞 Nomor HP
                </div>
                <div class="detail-value">{{ $mentor->nohp }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-label">
                    📅 Tanggal & Waktu
                </div>
                <div class="detail-value">
                    {{ \Carbon\Carbon::parse($mentor->tanggal_dan_waktu)->format('d F Y - H:i') }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label">
                    ⚤ Jenis Kelamin
                </div>
                <div class="detail-value">{{ $mentor->jenis_kelamin }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-label">
                    📍 Alamat
                </div>
                <div class="detail-value">{{ $mentor->alamat }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-label">
                    📸 Foto
                </div>
                <div class="detail-value">
                    @if($mentor->foto && file_exists(public_path('storage/' . $mentor->foto)))
                        <img src="{{ asset('storage/' . $mentor->foto) }}" alt="Foto {{ $mentor->nama }}" class="photo-preview">
                    @else
                        <div class="no-photo">
                            📸
                        </div>
                        <small style="color: #666;">Tidak ada foto</small>
                    @endif
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label">
                    📝 Keterangan
                </div>
                <div class="detail-value">
                    {{ $mentor->keterangan ?: 'Tidak ada keterangan' }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label">
                    👨‍💼 Dibuat Oleh
                </div>
                <div class="detail-value">{{ $mentor->created_by }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-label">
                    🕒 Tanggal Dibuat
                </div>
                <div class="detail-value">
                    {{ $mentor->created_at ? \Carbon\Carbon::parse($mentor->created_at)->format('d F Y - H:i') : 'Tidak tersedia' }}
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('mentors.edit', $mentor->id) }}" class="btn-edit">
                ✏️ Edit Mentor
            </a>
            <form method="POST" action="{{ route('mentors.destroy', $mentor->id) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus mentor ini?')">
                    🗑️ Hapus Mentor
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // Add some interactive animations
    document.querySelectorAll('.detail-item').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.borderLeftColor = '#f5576c';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.borderLeftColor = '#667eea';
        });
    });
</script>
@endsection