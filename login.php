<?php
// Cek apakah metode permintaan adalah POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari body request (JSON)
    $data = json_decode(file_get_contents("php://input"));
    
    // Validasi input
    if (!isset($data->email) || !isset($data->password)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Email dan password harus diisi.'
        ]);
        exit;
    }
    
    // Email dan password yang valid (simulasi autentikasi)
    $validEmail = 'admin@gmail.com';
    $validPassword = '123';
    
    // Validasi email dan password
    if ($data->email === $validEmail && $data->password === $validPassword) {
        // Jika valid, kembalikan token dan data pengguna
        echo json_encode([
            'status' => 'success',
            'message' => 'Login berhasil!',
            'token' => 'static_token_12345',
            'user' => [
                'id' => 1,
                'name' => 'John Doe',
                'email' => $validEmail
            ]
        ]);
    } else {
        // Jika email atau password salah
        echo json_encode([
            'status' => 'error',
            'message' => 'Email atau password salah.'
        ]);
    }
} else {
    // Jika metode bukan POST
    echo json_encode([
        'status' => 'error',
        'message' => 'Metode yang didukung hanya POST.'
    ]);
}
?>
