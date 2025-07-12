<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Self Service Absensi - Modern</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated background elements */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)" opacity="0.5"><animate attributeName="opacity" values="0.5;1;0.5" dur="3s" repeatCount="indefinite"/></circle><circle cx="80" cy="30" r="1.5" fill="rgba(255,255,255,0.1)" opacity="0.3"><animate attributeName="opacity" values="0.3;0.8;0.3" dur="4s" repeatCount="indefinite"/></circle><circle cx="40" cy="70" r="1" fill="rgba(255,255,255,0.1)" opacity="0.4"><animate attributeName="opacity" values="0.4;0.9;0.4" dur="2.5s" repeatCount="indefinite"/></circle></svg>') repeat;
            pointer-events: none;
            z-index: -1;
        }

        .main-container {
            max-width: 480px;
            width: 100%;
            position: relative;
            z-index: 1;
        }

        .attendance-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-header-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .card-header-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.08)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-3px); }
        }

        .header-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .header-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header-subtitle {
            font-size: 0.9rem;
            opacity: 0.9;
            font-weight: 400;
            letter-spacing: 0.5px;
        }

        .card-body {
            padding: 2rem;
        }

        .camera-container {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 320px;
            border-radius: 16px;
            border: 2px solid rgba(102, 126, 234, 0.1);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            transition: all 0.4s ease;
        }

        .camera-container.active {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            transform: scale(1.02);
        }

        #camera {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
            border-radius: 14px;
        }

        .camera-placeholder {
            text-align: center;
            padding: 2rem;
            color: #6c757d;
        }

        .camera-icon {
            font-size: 3.5rem;
            color: #667eea;
            margin-bottom: 1rem;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }

        .status-text {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #495057;
        }

        .status-subtext {
            font-size: 0.9rem;
            color: #6c757d;
            opacity: 0.8;
        }

        .info-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        .info-item {
            text-align: center;
            padding: 1rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .info-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .info-icon {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .info-text {
            font-size: 0.85rem;
            font-weight: 600;
            color: #2d3748;
            margin: 0;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .btn-modern {
            flex: 1;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-modern:hover::before {
            left: 100%;
        }

        .btn-primary-modern {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-primary-modern:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-success-modern {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(72, 187, 120, 0.3);
        }

        .btn-success-modern:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(72, 187, 120, 0.4);
        }

        .btn-modern:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }

        .guidance-box {
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
            border: 1px solid rgba(102, 126, 234, 0.2);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .guidance-icon {
            color: #667eea;
            font-size: 1.2rem;
            margin-right: 0.5rem;
        }

        .guidance-title {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .guidance-list {
            margin: 0;
            padding-left: 1.5rem;
            color: #4a5568;
        }

        .guidance-list li {
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .loading-container {
            text-align: center;
            padding: 2rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border-radius: 16px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .loading-spinner {
            width: 3rem;
            height: 3rem;
            border: 0.3rem solid rgba(102, 126, 234, 0.2);
            border-top: 0.3rem solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loading-text {
            font-size: 1.1rem;
            font-weight: 500;
            color: #495057;
            margin-top: 1rem;
        }

        .loading-subtext {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 0.5rem;
        }

        .alert-modern {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1rem;
            position: relative;
            overflow: hidden;
        }

        .alert-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: currentColor;
        }

        .alert-success {
            background: linear-gradient(135deg, #f0fff4 0%, #e6fffa 100%);
            color: #2f855a;
            border-left: 4px solid #48bb78;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fff5f5 0%, #fed7d7 100%);
            color: #c53030;
            border-left: 4px solid #f56565;
        }

        .alert-warning {
            background: linear-gradient(135deg, #fffbeb 0%, #fef5e7 100%);
            color: #d69e2e;
            border-left: 4px solid #f6e05e;
        }

        .alert-info {
            background: linear-gradient(135deg, #ebf8ff 0%, #e6fffa 100%);
            color: #2c5282;
            border-left: 4px solid #4299e1;
        }

        @media (max-width: 576px) {
            .main-container {
                padding: 0 10px;
            }

            .card-body {
                padding: 1.5rem;
            }

            .camera-container {
                min-height: 280px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }

            .header-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="attendance-card">
            <div class="card-header-custom">
                <div class="header-icon">
                    <i class="fas fa-user-clock"></i>
                </div>
                <h1 class="header-title">Self Service Absensi</h1>
                <p class="header-subtitle">Smart Integrated System Palembang</p>
            </div>
            
            <div class="card-body">
                <!-- Camera Section -->
                <div class="camera-container" id="cameraWrapper">
                    <video id="camera" autoplay playsinline muted></video>
                    <div class="camera-placeholder" id="cameraPlaceholder">
                        <div class="camera-icon">
                            <i class="fas fa-camera"></i>
                        </div>
                        <p class="status-text">Kamera Siap Digunakan</p>
                        <p class="status-subtext">Klik tombol di bawah untuk mengaktifkan</p>
                    </div>
                    <div class="d-none alert alert-danger position-absolute bottom-0 start-0 w-100 m-0 rounded-0" id="cameraError">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <span id="cameraErrorMessage"></span>
                    </div>
                </div>

                <!-- User Info Section -->
                <div class="info-section">
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-icon text-primary">
                                <i class="fas fa-user"></i>
                            </div>
                            <p class="info-text" id="userName">Pengguna</p>
                        </div>
                        <div class="info-item">
                            <div class="info-icon text-success">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <p class="info-text" id="currentDate"></p>
                        </div>
                        <div class="info-item">
                            <div class="info-icon text-warning">
                                <i class="fas fa-clock"></i>
                            </div>
                            <p class="info-text" id="currentTime"></p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button id="startCameraBtn" class="btn-modern btn-primary-modern" onclick="startCamera()">
                        <i class="fas fa-video me-2"></i>Aktifkan Kamera
                    </button>
                    <button id="absenBtn" class="btn-modern btn-success-modern" onclick="takeAttendance()" disabled>
                        <i class="fas fa-fingerprint me-2"></i>Absen Sekarang
                    </button>
                </div>

                <!-- Guidance Section -->
                <div class="guidance-box">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-info-circle guidance-icon mt-1"></i>
                        <div>
                            <div class="guidance-title">Petunjuk Absensi:</div>
                            <ol class="guidance-list">
                                <li>Aktifkan kamera dan pastikan wajah terlihat jelas</li>
                                <li>Pastikan pencahayaan cukup terang</li>
                                <li>Klik tombol "Absen Sekarang" untuk mengambil foto</li>
                                <li>Tunggu hingga proses selesai</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Loading Indicator -->
                <div id="loadingIndicator" class="d-none">
                    <div class="loading-container">
                        <div class="loading-spinner mx-auto"></div>
                        <div class="loading-text">Sedang memproses absensi...</div>
                        <div class="loading-subtext">Mohon tunggu sebentar</div>
                    </div>
                </div>

                <!-- Message Container -->
                <div id="messageContainer"></div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        // Global variables
        let cameraStream = null;
        const videoElement = document.getElementById('camera');
        const startCameraBtn = document.getElementById('startCameraBtn');
        const absenBtn = document.getElementById('absenBtn');
        const loadingIndicator = document.getElementById('loadingIndicator');
        const cameraPlaceholder = document.getElementById('cameraPlaceholder');
        const cameraError = document.getElementById('cameraError');
        const cameraErrorMessage = document.getElementById('cameraErrorMessage');
        const messageContainer = document.getElementById('messageContainer');
        const cameraWrapper = document.getElementById('cameraWrapper');
        const userNameElement = document.getElementById('userName');
        const currentDateElement = document.getElementById('currentDate');
        const currentTimeElement = document.getElementById('currentTime');

        // Display message function
        function showMessage(message, type = 'success') {
            const icons = {
                success: 'check-circle',
                danger: 'exclamation-triangle',
                warning: 'exclamation-circle',
                info: 'info-circle'
            };
            
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-modern d-flex align-items-center`;
            alertDiv.innerHTML = `
                <i class="fas fa-${icons[type]} me-2"></i>
                <div>${message}</div>
                <button type="button" class="btn-close ms-auto" onclick="this.parentElement.remove()"></button>
            `;
            
            messageContainer.appendChild(alertDiv);
            
            // Auto dismiss after 5 seconds
            setTimeout(() => {
                if (alertDiv.parentElement) {
                    alertDiv.remove();
                }
            }, 5000);
        }

        // Update time function
        function updateDateTime() {
            const now = new Date();
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            
            const dayName = days[now.getDay()];
            const date = now.getDate();
            const monthName = months[now.getMonth()];
            const year = now.getFullYear();
            
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            
            currentDateElement.textContent = `${date} ${monthName} ${year}`;
            currentTimeElement.textContent = `${hours}:${minutes}:${seconds}`;
        }

        // Start camera function
        async function startCamera() {
            try {
                startCameraBtn.disabled = true;
                startCameraBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memuat...';
                cameraPlaceholder.innerHTML = `
                    <div class="loading-spinner mx-auto mb-3"></div>
                    <p class="status-text">Menyiapkan kamera...</p>
                `;
                
                cameraError.classList.add('d-none');
                
                cameraStream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        width: { ideal: 1280 },
                        height: { ideal: 720 },
                        facingMode: 'user'
                    },
                    audio: false
                });

                videoElement.srcObject = cameraStream;
                videoElement.style.display = 'block';
                
                videoElement.onloadedmetadata = () => {
                    videoElement.play();
                    
                    cameraPlaceholder.classList.add('d-none');
                    absenBtn.disabled = false;
                    startCameraBtn.style.display = 'none';
                    cameraWrapper.classList.add('active');
                    
                    showMessage('Kamera berhasil diaktifkan', 'success');
                };

            } catch (error) {
                console.error('Camera Error:', error);
                
                let errorMessage = 'Gagal mengakses kamera';
                if (error.name === 'NotAllowedError') {
                    errorMessage = 'Izin kamera ditolak. Harap izinkan akses kamera di pengaturan browser Anda.';
                } else if (error.name === 'NotFoundError') {
                    errorMessage = 'Perangkat kamera tidak ditemukan.';
                } else if (error.name === 'NotReadableError') {
                    errorMessage = 'Kamera sedang digunakan oleh aplikasi lain.';
                }
                
                cameraErrorMessage.textContent = errorMessage;
                cameraError.classList.remove('d-none');
                cameraPlaceholder.innerHTML = `
                    <div class="text-danger mb-3">
                        <i class="fas fa-camera-slash" style="font-size: 3rem;"></i>
                    </div>
                    <p class="status-text">Kamera tidak tersedia</p>
                `;
                
                startCameraBtn.disabled = false;
                startCameraBtn.innerHTML = '<i class="fas fa-redo me-2"></i>Coba Lagi';
                absenBtn.disabled = true;
                
                showMessage(errorMessage, 'danger');
            }
        }

        // Take attendance function
        async function takeAttendance() {
            if (!cameraStream) {
                showMessage('Harap aktifkan kamera terlebih dahulu', 'warning');
                return;
            }

            loadingIndicator.classList.remove('d-none');
            absenBtn.disabled = true;
            absenBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
            
            try {
                const canvas = document.createElement('canvas');
                canvas.width = videoElement.videoWidth;
                canvas.height = videoElement.videoHeight;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(videoElement, 0, 0, canvas.width, canvas.height);
                
                videoElement.style.opacity = '0.7';
                setTimeout(() => videoElement.style.opacity = '1', 200);
                
                const imageData = canvas.toDataURL('image/jpeg', 0.85);

                let location = null;
                if (navigator.geolocation) {
                    location = await new Promise((resolve) => {
                        navigator.geolocation.getCurrentPosition(
                            position => resolve({
                                latitude: position.coords.latitude,
                                longitude: position.coords.longitude
                            }),
                            () => resolve(null),
                            {
                                enableHighAccuracy: true,
                                timeout: 3000,
                                maximumAge: 0
                            }
                        );
                    });
                }

                const simulateServerResponse = () => {
                    return new Promise(resolve => {
                        setTimeout(() => {
                            resolve({
                                success: true,
                                message: "Absensi Anda telah berhasil dicatat pada sistem"
                            });
                        }, 2000);
                    });
                };

                const result = await simulateServerResponse();

                if (result.success) {
                    showMessage(result.message, 'success');
                    
                    if (cameraStream) {
                        cameraStream.getTracks().forEach(track => track.stop());
                        videoElement.srcObject = null;
                        videoElement.style.display = 'none';
                    }
                    
                    cameraPlaceholder.classList.remove('d-none');
                    cameraPlaceholder.innerHTML = `
                        <div class="text-success mb-3">
                            <i class="fas fa-check-circle" style="font-size: 3.5rem;"></i>
                        </div>
                        <p class="status-text">Absensi Berhasil</p>
                        <p class="status-subtext">Terima kasih telah melakukan absensi</p>
                    `;
                    
                    absenBtn.disabled = true;
                    absenBtn.innerHTML = '<i class="fas fa-check me-2"></i>Selesai';
                } else {
                    throw new Error(result.message || 'Gagal menyimpan absensi');
                }

            } catch (error) {
                console.error('Attendance Error:', error);
                showMessage(error.message || 'Terjadi kesalahan saat absen', 'danger');
            } finally {
                loadingIndicator.classList.add('d-none');
                
                if (cameraStream && absenBtn.innerHTML.includes('Selesai')) {
                    // Keep disabled if successful
                } else if (cameraStream) {
                    absenBtn.disabled = false;
                    absenBtn.innerHTML = '<i class="fas fa-fingerprint me-2"></i>Absen Sekarang';
                }
            }
        }

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            updateDateTime();
            setInterval(updateDateTime, 1000);
            
            // Set demo username
            userNameElement.textContent = "John Doe";
            
            // Auto-start camera after a delay
            setTimeout(() => {
                if (!cameraStream) {
                    startCamera();
                }
            }, 1000);
        });

        // Cleanup when page is closed
        window.addEventListener('beforeunload', function() {
            if (cameraStream) {
                cameraStream.getTracks().forEach(track => track.stop());
            }
        });
    </script>
</body>
</html>