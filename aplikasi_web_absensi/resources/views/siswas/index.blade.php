<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Informasi Absensi Siswa</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }

        .container {
            max-width: 1400px;
        }

        .main-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .header-section {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .header-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(50%, -50%);
        }

        .header-section h2 {
            margin: 0;
            font-weight: 700;
            font-size: 2.5rem;
            position: relative;
            z-index: 1;
        }

        .header-section p {
            margin: 10px 0 0 0;
            opacity: 0.9;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }

        .content-section {
            padding: 2rem;
        }

        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .btn-create {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-create:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
            color: white;
            text-decoration: none;
        }

        .search-container {
            position: relative;
            max-width: 300px;
        }

        .search-container input {
            border: 2px solid #e9ecef;
            border-radius: 50px;
            padding: 10px 40px 10px 20px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .search-container input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            outline: none;
        }

        .search-container .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }

        .table-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .table thead th {
            border: none;
            padding: 1.2rem 1rem;
            font-weight: 600;
            color: #495057;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            vertical-align: middle;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-top: 1px solid #f1f3f4;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f8f9ff;
            transform: scale(1.005);
        }

        .row-number {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .student-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .student-avatar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .student-name {
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }

        .student-role {
            color: #666;
            font-size: 0.85rem;
            margin: 0;
        }

        .gender-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            border: none;
        }

        .gender-badge.male {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        .gender-badge.female {
            background-color: #fce4ec;
            color: #c2185b;
        }

        .semester-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            border: none;
        }

        .contact-info {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #495057;
        }

        .contact-info i {
            width: 16px;
            text-align: center;
        }

        .location-info {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #495057;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            background-color: #d4edda;
            color: #155724;
            border: none;
        }

        .creator-info {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .creator-avatar {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .btn-action {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .btn-show {
            background-color: #e8f5e8;
            color: #2e7d32;
        }

        .btn-edit {
            background-color: #fff3e0;
            color: #f57c00;
        }

        .btn-delete {
            background-color: #ffebee;
            color: #d32f2f;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            text-decoration: none;
        }

        .btn-show:hover {
            color: #2e7d32;
        }

        .btn-edit:hover {
            color: #f57c00;
        }

        .btn-delete:hover {
            color: #d32f2f;
        }

        .alert {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .no-data {
            text-align: center;
            padding: 3rem;
            color: #666;
        }

        .no-data i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }

        @media (max-width: 768px) {
            .header-section h2 {
                font-size: 2rem;
            }

            .content-section {
                padding: 1rem;
            }

            .action-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .search-container {
                max-width: none;
            }

            .table-responsive {
                font-size: 0.85rem;
            }

            .student-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table tbody tr {
            animation: fadeInUp 0.5s ease forwards;
        }

        .table tbody tr:nth-child(odd) {
            animation-delay: 0.1s;
        }

        .table tbody tr:nth-child(even) {
            animation-delay: 0.2s;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main-card">
            <!-- Header Section -->
            <div class="header-section">
                <h2><i class="fas fa-graduation-cap me-3"></i>Sistem Informasi Absensi Siswa</h2>
                <p>Smart Integrated System Palembang</p>
            </div>

            <!-- Content Section -->
            <div class="content-section">
                <!-- Success Message -->
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Success!</strong> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Action Bar -->
                <div class="action-bar">
                    <a class="btn-create" href="{{ route('siswas.create') }}">
                        <i class="fas fa-plus"></i>
                        Create New Siswa
                    </a>

                    <div class="search-container">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search students...">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                </div>

                <!-- Table Container -->
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table" id="studentsTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Asal Kampus</th>
                                    <th>Jurusan</th>
                                    <th>Semester</th>
                                    <th>Alamat</th>
                                    <th>No Hp</th>
                                    <th>Nohp Orangtua</th>
                                    <th>Foto</th>
                                    <th>Keterangan</th>
                                    <th>Created By</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswas as $siswa)
                                    <tr>
                                        <td>
                                            <div class="row-number">{{ ++$i }}</div>
                                        </td>
                                        <td>
                                            <div class="student-info">
                                                <div class="student-avatar">{{ substr($siswa->nama, 0, 1) }}</div>
                                                <div>
                                                    <p class="student-name">{{ $siswa->nama }}</p>
                                                    <p class="student-role">Student</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="gender-badge {{ strtolower($siswa->jenis_kelamin) }}">
                                                {{ $siswa->jenis_kelamin }}
                                            </span>
                                        </td>
                                        <td>{{ $siswa->asal_kampus }}</td>
                                        <td>
                                            <div>
                                                <strong>{{ $siswa->jurusan }}</strong>
                                                <br><small class="text-muted">Jurusan</small>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="semester-badge">Semester {{ $siswa->semester }}</span>
                                        </td>
                                        <td>
                                            <div class="location-info">
                                                <i class="fas fa-map-marker-alt text-danger"></i>
                                                {{ $siswa->alamat }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="contact-info">
                                                <i class="fas fa-phone text-success"></i>
                                                {{ $siswa->nohp }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="contact-info">
                                                <i class="fas fa-phone text-info"></i>
                                                {{ $siswa->nohp_orangtua }}
                                            </div>
                                        </td>
                                        <td>
                                            @if ($siswa->foto)
                                                <i class="fas fa-image text-primary"></i> {{ $siswa->foto }}
                                            @else
                                                <i class="fas fa-image text-muted"></i> No Photo
                                            @endif
                                        </td>
                                        <td>
                                            <span class="status-badge">{{ $siswa->keterangan }}</span>
                                        </td>
                                        <td>
                                            <div class="creator-info">
                                                <div class="creator-avatar">{{ substr($siswa->created_by, 0, 1) }}</div>
                                                <span>{{ $siswa->created_by }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a class="btn-action btn-show" href="{{ route('siswas.show', $siswa->id) }}" title="Show">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a class="btn-action btn-edit" href="{{ route('siswas.edit', $siswa->id) }}" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn-action btn-delete" title="Delete" data-id="{{ $siswa->id }}"
                                                    onclick="deleteSiswa(this, {{ $siswa->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if ($siswas->isEmpty())
                            <div class="no-data">
                                <i class="fas fa-users"></i>
                                <h5>No Students Found</h5>
                                <p>Start by adding your first student record.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Pagination if needed -->
                <div class="d-flex justify-content-center mt-4">
                    {!! $siswas->links() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        // Delete functionality with AJAX (using DELETE method)
        function deleteSiswa(button, id) {
            if (!confirm('Are you sure you want to delete this student?')) {
                return;
            }

            // Add loading state
            const originalContent = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            button.disabled = true;

            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            fetch('{{ route("siswas.destroy", ":id") }}'.replace(':id', id), {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Remove the row from the table with animation
                    const row = button.closest('tr');
                    row.style.transition = 'opacity 0.3s ease';
                    row.style.opacity = '0';
                    setTimeout(() => {
                        row.remove();
                        // Update row numbers
                        updateRowNumbers();
                        // Show success message
                        showAlert('success', data.message || 'Student deleted successfully!');
                    }, 300);
                } else {
                    throw new Error(data.message || 'Failed to delete student.');
                }
            })
            .catch(error => {
                // Restore button state
                button.innerHTML = originalContent;
                button.disabled = false;
                // Show error message
                showAlert('danger', error.message || 'An error occurred while deleting the student.');
                console.error('Delete error:', error);
            });
        }

        // Update row numbers after deletion
        function updateRowNumbers() {
            const rows = document.querySelectorAll('#studentsTable tbody tr');
            rows.forEach((row, index) => {
                row.querySelector('.row-number').textContent = index + 1;
            });
        }

        // Show alert message
        function showAlert(type, message) {
            const alertContainer = document.createElement('div');
            alertContainer.className = `alert alert-${type} alert-dismissible fade show`;
            alertContainer.setAttribute('role', 'alert');
            alertContainer.innerHTML = `
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} me-2"></i>
                <strong>${type.charAt(0).toUpperCase() + type.slice(1)}!</strong> ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            document.querySelector('.content-section').prepend(alertContainer);

            // Auto-hide alert after 5 seconds
            setTimeout(() => {
                alertContainer.style.transition = 'opacity 0.5s ease';
                alertContainer.style.opacity = '0';
                setTimeout(() => alertContainer.remove(), 500);
            }, 5000);
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('#studentsTable tbody tr');

            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
            // Update row numbers after filtering
            updateRowNumbers();
        });

        // Auto-hide alerts on page load
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    if (alert) {
                        alert.style.transition = 'opacity 0.5s ease';
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 500);
                    }
                }, 5000);
            });
        });
    </script>
</body>

</html>