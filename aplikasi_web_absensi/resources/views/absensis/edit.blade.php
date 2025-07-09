<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Absensi</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .container {
            max-width: 600px;
            margin: 30px auto;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .card-header {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 20px;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
        }
        
        .btn-primary {
            background: #007bff;
            border: none;
            border-radius: 8px;
            padding: 10px 30px;
        }
        
        .btn-secondary {
            background: #6c757d;
            border: none;
            border-radius: 8px;
            padding: 8px 20px;
            color: white;
            text-decoration: none;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Absensi</h4>
                    <a href="javascript:history.back()" class="btn btn-secondary btn-sm">Back</a>
                </div>
            </div>
            
            <div class="card-body p-4">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">ID User</label>
                            <input type="text" class="form-control" name="id_user" value="1" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Role User</label>
                            <select class="form-select" name="role_user">
                                <option value="Mahasiswa" selected>Mahasiswa</option>
                                <option value="Dosen">Dosen</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal dan Waktu</label>
                            <input type="datetime-local" class="form-control" name="tanggal_waktu" value="2025-07-04T15:00">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="Hadir">Hadir</option>
                                <option value="Sakit" selected>Sakit</option>
                                <option value="Izin">Izin</option>
                                <option value="Alfa">Alfa</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto Absensi</label>
                        <input type="file" class="form-control" name="foto_absensi" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, GIF (Max: 2MB)</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="3" placeholder="Masukkan keterangan..."></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update Absensi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const submitBtn = document.querySelector('button[type="submit"]');
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Ubah tombol jadi loading
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Updating...';
                
                // Ambil data form
                const formData = new FormData(form);
                
                // GANTI INI dengan endpoint backend Anda
                fetch('/update-absensi', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Absensi berhasil diupdate!');
                        // Redirect kembali ke halaman absensi
                        window.location.href = '/absensi';
                    } else {
                        alert('Error: ' + (data.message || 'Terjadi kesalahan'));
                        // Reset tombol
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = 'Update Absensi';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan koneksi!');
                    
                    // Reset tombol
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Update Absensi';
                });
            });
        });
    </script>
</body>
</html>