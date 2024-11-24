<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Server-side validation
    $errors = [];

    // Nama validasi
    $nama = $_POST['nama'] ?? '';
    if (strlen($nama) < 3 || strlen($nama) > 50) {
        $errors[] = "Nama harus antara 3-50 karakter";
    }

    // Email validasi
    $email = $_POST['email'] ?? '';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email tidak valid";
    }

    // Umur validasi
    $umur = $_POST['umur'] ?? '';
    if ($umur < 18 || $umur > 100) {
        $errors[] = "Umur harus antara 18-100 tahun";
    }

    // Telepon validasi
    $telepon = $_POST['telepon'] ?? '';
    if (!preg_match('/^[0-9]{10,12}$/', $telepon)) {
        $errors[] = "Nomor telepon harus 10-12 digit angka";
    }

    // File validasi    
    $motlet_content = '';
    if (isset($_FILES['motlet'])) {
        $file = $_FILES['motlet'];
        $allowed_types = ['text/plain'];
        $max_size = 5 * 1024 * 1024; // 5MB

        if (!in_array($file['type'], $allowed_types)) {
            $errors[] = "Hanya file teks (.txt) yang diperbolehkan";
        }

        if ($file['size'] > $max_size) {
            $errors[] = "Ukuran file maksimal 5MB";
        }

        // Baca isi file
        if (empty($errors)) {
            $motlet_content = file_get_contents($file['tmp_name']);
        }
    } else {
        $errors[] = "Motivation letter harus diunggah";
    }

    // Browser dan OS informasi
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    if (empty($errors)) {
        // Simpan data untuk ditampilkan di result.php
        session_start();
        $_SESSION['form_data'] = [
            'nama' => $nama,
            'email' => $email,
            'umur' => $umur,
            'telepon' => $telepon,
            'motlet_content' => $motlet_content,
            'user_agent' => $user_agent
        ];
        header("Location: result.php");
        exit();
    } else {
        // Tampilkan error
        echo "<h2>Error Validasi:</h2>";
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo "<p><a href='form.php'>Kembali ke formulir</a></p>";
    }
}