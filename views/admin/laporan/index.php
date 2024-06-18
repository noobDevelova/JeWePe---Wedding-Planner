<?php include __DIR__ . '/../partials/header.php'; ?>
<h1>Daftar Laporan</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Laporan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode Paket</th>
                        <th>Gambar</th>
                        <th>Nama Paket</th>
                        <th>Harga</th>
                        <th>Jumlah Pesanan</th>
                        <th>Total Harga</th>
                        <th>Status Produk</th>
                    </tr>
                </thead>
                <tbody>

                    <?php if (!empty($report)) : ?>
                        <?php foreach ($report as $r) : ?>
                            <tr>
                                <td class="vertical-middle"><?php echo htmlspecialchars($r['package_code']); ?></td>
                                <td class="vertical-middle"><img class="product_image" src="uploads/productImage/<?php echo $r['package_image']; ?>" alt="product_img"></td>
                                <td class="vertical-middle"><?php echo htmlspecialchars($r['package_name']); ?></td>
                                <td class="vertical-middle"><?php echo number_format($r['price'], 0, ',', '.'); ?></td>
                                <td class="vertical-middle"><?php echo number_format($r['total_orders'], 0, ',', '.'); ?></td>
                                <td class="vertical-middle"><?php echo number_format($r['total_revenue'], 0, ',', '.'); ?></td>
                                <td class="vertical-middle">
                                    <?php
                                    $statusText = '';
                                    $badgeClass = '';

                                    switch ($r['status_publish']) {
                                        case 'drafted':
                                            $statusText = 'Disimpan';
                                            $badgeClass = 'badge-warning';
                                            break;
                                        case 'showed':
                                            $statusText = 'Ditampilkan';
                                            $badgeClass = 'badge-success';
                                            break;
                                        default:
                                            $statusText = 'Status Tidak Diketahui';
                                            $badgeClass = 'badge-secondary';
                                            break;
                                    }
                                    ?>
                                    <span class="badge badge-pill <?php echo $badgeClass; ?>"><?php echo $statusText; ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="11">Tidak ada data ditemukan</td>
                        </tr>
                    <?php endif;  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../partials/footer.php'; ?>