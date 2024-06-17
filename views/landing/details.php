<?php include 'partials/header.php'; ?>

<section class="about mb-5 py-5">
    <div class="container py-sm-5  mb-4">
        <h3 class="heading text-capitalize mt-5 mb-lg-5 mb-4"> Detail Paket</h3>
        <div class="row about-grids">
            <div class="card shadow mb-4 mx-3">
                <div class="col-lg-6">
                    <h4><?php echo $product['package_name'] ?></h4>
                    <div class="row">
                        <div class="col">
                            <p class="mb-3"><?php echo $product['description'] ?></p>
                        </div>
                        <div class="col ml-auto">
                            <img src="uploads/productImage/<?php echo $product['package_image']; ?>" alt="product_img">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <h1>Tertarik dengan paket ini? Yuk segera order</h1>
        <form action="index.php?controller=landing&action=addOrder" method="POST" class="px-3 pt-3 pb-0">
            <input type="hidden" id="deskripsiHidden" name="package_id" value="<?php echo htmlspecialchars($product['package_id']); ?>">

            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Nama Anda</label>
                <input type="text" class="form-control" placeholder="" name="customer_name" id="recipient-name2" required="">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Email Anda</label>
                <input type="email" class="form-control" placeholder="" name="customer_email" id="recipient-name3" required="">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">No. Telp Anda</label>
                <input type="text" class="form-control" placeholder="" name="customer_phone_number" id="recipient-name5" required="">
            </div>
            <div class="form-group">
                <label for="recipient-name1" class="col-form-label">Tanggal Pernikahan</label>
                <input type="date" class="form-control" placeholder="" name="wedding_date" id="recipient-name6" required="">
            </div>
            <div class="right-w3l">
                <button type="submit" class="btn btn-primary">Pesan</button>
            </div>
        </form>
    </div>
</section>

<?php include 'partials/footer.php'; ?>