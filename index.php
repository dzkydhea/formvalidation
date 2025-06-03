<?php
// Inisialisasi variabel
$nama = $email = $pesan = "";
$namaErr = $emailErr = $pesanErr = "";
$successMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hasError = false;

    // Validasi Nama
    if (empty(trim($_POST["nama"]))) {
        $namaErr = "Nama harus diisi";
        $hasError = true;
    } else {
        $nama = htmlspecialchars(trim($_POST["nama"]));
    }

    // Validasi Email
    if (empty(trim($_POST["email"]))) {
        $emailErr = "Email harus diisi";
        $hasError = true;
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Format email tidak valid";
        $hasError = true;
    } else {
        $email = htmlspecialchars(trim($_POST["email"]));
    }

    // Validasi Pesan
    if (empty(trim($_POST["pesan"]))) {
        $pesanErr = "Pesan harus diisi";
        $hasError = true;
    } else {
        $pesan = htmlspecialchars(trim($_POST["pesan"]));
    }

    // Jika tidak ada error, simulasikan penyimpanan ke database dan tampilkan pesan sukses
    if (!$hasError) {
        // Di sini Anda bisa menambahkan kode untuk menyimpan ke database...

        $successMsg = "Data berhasil dikirim!";
        // Reset field
        $nama = $email = $pesan = "";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Form Validasi Pengiriman Data</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f5f7fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .container {
        background: white;
        padding: 2rem 3rem;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 420px;
    }
    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 1.5rem;
    }
    .form-group {
        margin-bottom: 1.25rem;
    }
    label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #444;
    }
    input[type="text"],
    input[type="email"],
    textarea {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        border: 1.5px solid #ddd;
        font-size: 1rem;
        transition: border-color 0.3s ease;
        resize: vertical;
        font-family: inherit;
    }
    input[type="text"]:focus,
    input[type="email"]:focus,
    textarea:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 4px #007bffa0;
    }
    .error {
        color: #e74c3c;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    .success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
        padding: 0.75rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        text-align: center;
        font-weight: 600;
        box-shadow: 0 2px 6px rgba(21,87,36,0.15);
    }
    button {
        width: 100%;
        padding: 0.65rem;
        border: none;
        background: #007bff;
        color: white;
        font-size: 1.1rem;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        box-shadow: 0 4px 12px #007bff88;
        transition: background-color 0.3s ease;
    }
    button:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
<div class="container">
    <h2>Form Validasi Pengiriman Data</h2>
    <?php if ($successMsg): ?>
      <div class="success"><?php echo $successMsg; ?></div>
    <?php endif; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" placeholder="Masukkan nama Anda" />
            <?php if ($namaErr): ?>
              <div class="error"><?php echo $namaErr; ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" placeholder="Masukkan email Anda" />
            <?php if ($emailErr): ?>
              <div class="error"><?php echo $emailErr; ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="pesan">Pesan:</label>
            <textarea id="pesan" name="pesan" rows="4" placeholder="Tulis pesan Anda di sini..."><?php echo $pesan; ?></textarea>
            <?php if ($pesanErr): ?>
              <div class="error"><?php echo $pesanErr; ?></div>
            <?php endif; ?>
        </div>
        <button type="submit">Kirim</button>
    </form>
</div>
</body>
</html>
