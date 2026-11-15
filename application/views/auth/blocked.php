<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
    <div class="text-center p-5 bg-white rounded-4 shadow-sm border" style="max-width: 480px;">
        <div class="display-1 fw-extrabold text-danger mb-2">403</div>
        <h4 class="fw-bold text-dark mb-2">Akses Ditolak (Access Forbidden)</h4>
        <p class="text-muted small mb-4">
            Maaf, Role akun Anda tidak memiliki izin untuk mengakses menu ini (Materi 5 &amp; 6: Proteksi Helper <code>is_logged_in()</code>).
        </p>
        <a href="<?= base_url('user'); ?>" class="btn btn-primary px-4 fw-semibold">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Profil Saya
        </a>
    </div>
</body>
</html>
