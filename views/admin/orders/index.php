<?php include __DIR__ . '/../partials/header.php'; ?>
<h1>Daftar Order</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Order</h6>
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
                        <th>Kode Order</th>
                        <th>Gambar</th>
                        <th>Nama Pemesan</th>
                        <th>Email Pemesan</th>
                        <th>Status Order</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders)) : ?>
                        <?php foreach ($orders as $o) : ?>
                            <tr>
                                <td class="vertical-middle"><?php echo htmlspecialchars($o['order_code']); ?></td>
                                <td class="vertical-middle"><img class="product_image" src="uploads/productImage/<?php echo $o['package_image']; ?>" alt="product_img"></td>
                                <td class="vertical-middle"><?php echo htmlspecialchars($o['customer_name']); ?></td>
                                <td class="vertical-middle"><?php echo $o['customer_email'] ?></td>
                                <td class="vertical-middle">
                                    <?php
                                    $statusText = '';
                                    $badgeClass = '';

                                    switch ($o['order_status']) {
                                        case 'pending':
                                            $statusText = 'Menunggu Konfirmasi';
                                            $badgeClass = 'badge-warning';
                                            break;
                                        case 'approved':
                                            $statusText = 'Pesanan Diterima';
                                            $badgeClass = 'badge-success';
                                            break;
                                        case 'cancelled':
                                            $statusText = 'Dibatalkan';
                                            $badgeClass = 'badge-danger';
                                            break;
                                        default:
                                            $statusText = 'Status Tidak Diketahui';
                                            $badgeClass = 'badge-secondary';
                                            break;
                                    }
                                    ?>
                                    <span class="badge badge-pill <?php echo $badgeClass; ?>"><?php echo $statusText; ?></span>
                                </td>
                                <td class="vertical-middle">
                                    <?php if ($o['order_status'] === 'pending') {
                                    ?>
                                        <a href="index.php?controller=order&action=approveOrder&id=<?php echo htmlspecialchars($o['order_code']);  ?>" class="btn btn-success btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            <span class="text">Terima</span>
                                        </a>
                                    <?php
                                    } ?>
                                    <?php if ($o['order_status'] === 'approved') {
                                    ?>
                                        <a href="index.php?controller=order&action=cancelOrder&id=<?php echo htmlspecialchars($o['order_code']);  ?>" class="btn btn-warning btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-times"></i>
                                            </span>
                                            <span class="text">Batalkan</span>
                                        </a>
                                    <?php
                                    } ?>
                                    <a href="index.php?controller=order&action=deleteOrder&id=<?php echo htmlspecialchars($o['order_code']);  ?>" class="btn btn-danger btn-icon-split">
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