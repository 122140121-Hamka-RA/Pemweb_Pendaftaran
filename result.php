<?php
session_start();
if (!isset($_SESSION['form_data'])) {
    header("Location: form.php");
    exit();
}
$data = $_SESSION['form_data'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Pendaftaran</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Detail Pendaftaran</h2>
        <table>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Nama</td>
                <td><?= htmlspecialchars($data['nama']) ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?= htmlspecialchars($data['email']) ?></td>
            </tr>
            <tr>
                <td>Umur</td>
                <td><?= htmlspecialchars($data['umur']) ?></td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td><?= htmlspecialchars($data['telepon']) ?></td>
            </tr>
            <tr>
                <td>Browser/OS</td>
                <td><?= htmlspecialchars($data['user_agent']) ?></td>
            </tr>
        </table>

        <h3>Motivation Letter</h3>
        <pre><?= htmlspecialchars($data['motlet_content']) ?></pre>
        
        <!-- Tombol Kembali -->
        <button onclick="window.location.href='form.php'" class="back-button">
            Kembali ke Formulir
        </button>
    </div>
</body>
</html>
<?php
// Hapus data session setelah ditampilkan
unset($_SESSION['form_data']);
?>