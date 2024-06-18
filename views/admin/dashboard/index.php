<?php include __DIR__ . '/../partials/header.php'; ?>
<h1>Dashboard</h1>

<section>
    <h2>Selamat Datang di Admin JeWePe</h2>
    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Paket</h5>
                    <h6><?php echo $metrics['total_catalog'] ?></h6>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Order</h5>
                    <h6><?php echo $metrics['total_orders'] ?></h6>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Order Pending</h5>
                    <h6><?php echo $metrics['total_pending_orders'] ?></h6>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Pesanan Yang Diterima</h5>
                    <h6><?php echo $metrics['total_approved_orders'] ?></h6>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../partials/footer.php'; ?>