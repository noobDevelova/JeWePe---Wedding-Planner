<?php include __DIR__ . '/../partials/header.php'; ?>

<h1>Produk Wedding</h1>
<a href="index.php?controller=product&action=addProduct" class="btn btn-primary btn-icon-split mb-2">
    <span class="icon text-white-50">
        <i class="fas fa-plus-square"></i>
    </span>
    <span class="text">Tambah Produk</span>
</a>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Paket Wedding</h6>
    </div>
    <div class="card-body">
        <?php if (!empty($message)) : ?>
            <div class="alert alert-success">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>


        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode Paket</th>
                        <th>Gambar</th>
                        <th>Nama Paket</th>
                        <th>Harga</th>
                        <th>Status Publish</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)) : ?>
                        <?php foreach ($products as $p) : ?>
                            <tr>
                                <td class="vertical-middle"><?php echo htmlspecialchars($p['package_code']); ?></td>
                                <td class="vertical-middle"><img class="product_image" src="uploads/productImage/<?php echo $p['package_image']; ?>" alt="product_img"></td>
                                <td class="vertical-middle"><?php echo htmlspecialchars($p['package_name']); ?></td>
                                <td class="vertical-middle"><?php echo number_format($p['price'], 0, ',', '.'); ?></td>
                                <td class="vertical-middle"><?php echo $p['status_publish'] === 'showed' ? 'Ditampilkan' : 'Disimpan'; ?></td>
                                <td class="vertical-middle">
                                    <a href="index.php?controller=product&action=updateProduct&id=<?php echo $p['package_code']; ?>" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-flag"></i>
                                        </span>
                                        <span class="text">Edit</span>
                                    </a>
                                    <a href="index.php?controller=product&action=deleteProduct&id=<?php echo $p['package_code']; ?>" class="btn btn-danger btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Hapus</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="11">Tidak ada data ditemukan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../partials/footer.php'; ?>