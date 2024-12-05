<?php
// Cek apakah ID produk ada di URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Ambil data produk dari API (misalnya dengan menggunakan $product_id)
    $api_url = "https://dummyjson.com/products/$product_id";
    $response = file_get_contents($api_url);
    $product = json_decode($response, true);

    // Cek apakah produk ditemukan
    if (!$product) {
        die("Produk tidak ditemukan.");
    }
} else {
    die("ID produk tidak ditemukan.");
}

// Tangani form submit untuk update produk
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Simulasikan pengiriman data ke API untuk update produk
    // Biasanya, Anda akan mengirimkan data ke API menggunakan PUT request
    // Misalnya: file_get_contents("https://dummyjson.com/products/$product_id", false, $context);
    // Tapi untuk simulasi, kita cukup menampilkan pesan sukses.

    echo "Produk berhasil diperbarui!";
    // Setelah update, arahkan ke halaman daftar produk
    header("Location: product.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        input, textarea {
            padding: 10px;
            font-size: 16px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Product</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <label for="title">Nama Produk</label>
        <input type="text" name="title" id="title" value="<?php echo $product['title']; ?>" required>
        
        <label for="price">Harga</label>
        <input type="number" name="price" id="price" value="<?php echo $product['price']; ?>" required>
        
        <label for="price">Kategori</label>
        <input type="text" name="category" id="category" value="<?php echo $product['category']; ?>" required>

        <label for="status">Status Ketersediaan</label>
        <input type="text" name="availabilityStatus" id="availabilityStatus" value="<?php echo $product['availabilityStatus']; ?>" required>

        <label for="description">Description</label>
        <textarea name="description" id="description" required><?php echo $product['description']; ?></textarea>

        <button type="submit">Update Product</button>
    </form>
</div>

</body>
</html>
