<?php include 'partials/header.php'; ?>

<!-- banner -->
<section class=" layer bg-dark" id="home">
    <div class="container">
        <div class="banner-text">
            <div class="slider-info mb-4">
                <div class="banner-heading">
                    <h3>
                        Perjalanan Pernikahan Anda Dimulai Dari Sini
                    </h3>
                </div>
                <a href="contact.html"> Plan Your Wedding</a>
            </div>
            <!-- To bottom button-->
            <div class="thim-click-to-bottom">
                <div class="rotate">
                    <a href="#welcome" class="scroll">
                        <span class="fa fa-angle-double-down"></span>
                    </a>
                </div>
            </div>
            <!-- //To bottom button-->

        </div>
    </div>
</section>
<!-- //banner -->

<!-- welcome -->
<section class="welcome py-5" id="welcome">
    <div class="container py-md-5">
        <h3 class="heading text-capitalize text-center mb-lg-5 mb-4"> kami akan merencanakan setiap detil untuk pernikahan anda </h3>
        <div class="row welcome-grids">
            <div class="col-lg-4 mb-lg-0 mb-5">
                <h4 class="left-heading">Our Weddings Story</h4>
                <p class="mb-3">Sed gravida dignissim magna idesn molestie. Nulla congue, ex init dictum lacinia, nisl est posuere nulla, nec eges tas leo mi id lorem. Maecenas sem nulla ex init dictu lacinia, Maecenas sem nulla. Sed gravida dignissim magna idesn en molestie</p>

            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="image1 mb-4">
                    <h4>Hair / Makeup</h4>
                    <p class="mt-3">Sed gravida dignissim magna idesn en molestie. Nulla congue, ex init dictu lacinia, Maecenas sem nulla</P>
                </div>
                <div class="image1">
                    <h4>Venue & Catering</h4>
                    <p class="mt-3">Sed gravida dignissim magna idesn en molestie. Nulla congue, ex init dictu lacinia, Maecenas sem nulla</P>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 mt-sm-0 mt-4">
                <div class="image1 mb-4">
                    <h4>Photo / Video </h4>
                    <p class="mt-3">Sed gravida dignissim magna idesn en molestie. Nulla congue, ex init dictu lacinia, Maecenas sem nulla</P>
                </div>
                <div class="image1">
                    <h4>Flowers & Music</h4>
                    <p class="mt-3">Sed gravida dignissim magna idesn en molestie. Nulla congue, ex init dictu lacinia, Maecenas sem nulla</P>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- welcome -->

<!-- Recent Events -->
<section class="Recent Events py-5">
    <div class="container py-sm-3">
        <h3 class="heading text-capitalize mb-lg-5 mb-4"> Paket Pernikahan Kami</h3>
        <div class="row course-grids">
            <?php
            $filteredProducts = array_filter($products, function ($p) {
                return $p['status_publish'] === 'showed';
            });

            if (!empty($filteredProducts)) :
            ?>
                <?php foreach ($filteredProducts as $p) : ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <img class="card-img-top" src="uploads/productImage/<?php echo htmlspecialchars($p['package_image']); ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($p['package_name']); ?></h5>
                                <?php echo $p['description'] ?>
                                <a href="index.php?controller=landing&action=details&id=<?php echo htmlspecialchars($p['package_code']); ?>" class="btn btn-primary mt-3">Detail</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <h5>Tidak ada data ditemukan</h5>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- Recent Events -->

<!-- Clients -->
<section class="clients-main">
    <div class="wthree-different-dot1 py-5">
        <div class="container py-sm-3">
            <h3 class="heading text-capitalize text-center mb-sm-5 mb-4"> Testimoni</h3>
            <div class="row cli-ent">
                <div class="col-lg-4 col-md-6 item g1">
                    <div class="row agile-dish-caption">
                        <div class="col-lg-11 text-center mx-auto">
                            <h5>Michael Johnson</h5>
                            <p class="para-w3-agile"> Phasellus iaculis sapien in tellus gravida, a placerat lacus elementum. Nulla vitae lac nec elit mollis pretium. Sed sed nunc lectus sapien in tellus.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 item g1">
                    <div class="row agile-dish-caption">
                        <div class="col-lg-11 text-center mx-auto">
                            <h5>Mary elizabeth</h5>
                            <p class="para-w3-agile"> Phasellus iaculis sapien in tellus gravida, a placerat lacus elementum. Nulla vitae lac nec elit mollis pretium. Sed sed nunc lectus sapien in tellus.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 item g1">
                    <div class="row agile-dish-caption">
                        <div class="col-lg-11 text-center mx-auto">
                            <h5>Elisa kour</h5>
                            <p class="para-w3-agile"> Phasellus iaculis sapien in tellus gravida, a placerat lacus elementum. Nulla vitae lac nec elit mollis pretium. Sed sed nunc lectus sapien in tellus.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--// Clients -->


<?php include 'partials/footer.php'; ?>