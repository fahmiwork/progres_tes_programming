<?php
// Mendapatkan halaman, jumlah item per halaman, dan kata kunci pencarian
$limit = 10; // Jumlah produk per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Halaman saat ini
$skip = ($page - 1) * $limit; // Produk yang akan dilewati
$search = isset($_GET['search']) ? $_GET['search'] : ''; // Kata kunci pencarian

// Membuat URL API dengan parameter pencarian jika ada
$api_url = "https://dummyjson.com/products?limit=$limit&skip=$skip";
if (!empty($search)) {
    $api_url .= "&q=" . urlencode($search);
}

// Mengambil data produk dari API dummyjson.com
$response = file_get_contents($api_url);
$data = json_decode($response, true);

// Mendapatkan total jumlah produk
$total_products = $data['total']; // Total produk di API
$total_pages = ceil($total_products / $limit); // Menghitung jumlah halaman yang diperlukan

// Data produk yang diterima
$products = $data['products'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List with Search and Pagination</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    
    <h2>Product</h2>
    <a href="add_product.php">Tambah Data</a>

    <!-- Form Pencarian -->
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Cari produk..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Cari</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Product</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Status Ketersediaan</th>
                <th>Harga</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['title']; ?></td>
                    <td><?php echo $product['description']; ?></td>
                    <td><?php echo $product['category']; ?></td>
                    <td><?php echo $product['availabilityStatus'] ?? 'Unknown'; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $product['id']; ?>">
                            <button>Edit</button>
                        </a>
                        <a href="?delete=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?')">
                            <button>Delete</button>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Tidak ada data produk ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination Controls -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>">&laquo; Previous</a>
        <?php endif; ?>

        <span>Page <?php echo $page; ?> of <?php echo $total_pages; ?></span>

        <?php if ($page < $total_pages): ?>
            <a href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>">Next &raquo;</a>
        <?php endif; ?>
    </div>
</div>

</body>
</html>