<?php 
$version = date('Y-m-d h:i:s');
include "includes/header.php"; 
include("admin/dbConnection.php");
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$id = intval($_GET['id'] ?? 0);
$product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM ca_products WHERE ID = $id"));

if (!$product) {
    echo "<script>alert('Product not found'); window.location.href='index.php';</script>";
    exit;
}

// fallback image
$image = !empty($product['IMAGE']) ? $product['IMAGE'] : 'admin/assets/images/product/default.png';
?>

<section class="innerbanner_sec" style="background-image: url(assets/images/innerbanner.png);">
    <div class="cust_container">
        <div class="content">
            <h2 class="innerbanner_head"><?= htmlspecialchars($product['PRODUCT_NAME']) ?></h2>
            <nav aria-label="breadcrumb" class="breadcrumbs">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<section class="productdetails_sec bothSide_gap">
    <div class="cust_container">
        <div class="card">
            <!-- card left -->
            <div class="product-imgs">
                <div class="img-display">
                    <div class="img-showcase">
                        <img src="<?= 'admin/'.$image ?>" alt="<?= htmlspecialchars($product['PRODUCT_NAME']) ?>">
                        <!-- Repeat as placeholder -->
                        <img src="<?= 'admin/'.$image ?>" alt="<?= htmlspecialchars($product['PRODUCT_NAME']) ?>">
                        <img src="<?= 'admin/'.$image ?>" alt="<?= htmlspecialchars($product['PRODUCT_NAME']) ?>">
                        <img src="<?= 'admin/'.$image ?>" alt="<?= htmlspecialchars($product['PRODUCT_NAME']) ?>">
                    </div>
                </div>
                <div class="img-select">
                    <div class="img-item"><a href="#" data-id="1"><img src="<?= 'admin/'.$image ?>" alt="thumb"></a></div>
                    <div class="img-item"><a href="#" data-id="2"><img src="<?= 'admin/'.$image ?>" alt="thumb"></a></div>
                    <div class="img-item"><a href="#" data-id="3"><img src="<?= 'admin/'.$image ?>" alt="thumb"></a></div>
                    <div class="img-item"><a href="#" data-id="4"><img src="<?= 'admin/'.$image ?>" alt="thumb"></a></div>
                </div>
            </div>

            <!-- card right -->
            <div class="product-content">
                <h2 class="product-title"><?= htmlspecialchars($product['PRODUCT_NAME']) ?></h2>

                <div class="product-price">
                    <p class="new-price">Approx. Price: <span>$<?= number_format($product['PRICE'], 2) ?> / Stripe</span></p>
                </div>

                <div class="product-detail">
                    <?= nl2br($product['DESCRIPTION']) ?>
                    <!--<h2>About this item:</h2>-->
                    <!--<p><?= nl2br($product['DESCRIPTION']) ?></p>-->

                    <!--<ul>-->
                    <!--    <li>Strength: <span><?= htmlspecialchars($product['STRENGTH'] ?? '-') ?></span></li>-->
                    <!--    <li>Packaging Type: <span><?= htmlspecialchars($product['PACKAGING_TYPE'] ?? '-') ?></span></li>-->
                    <!--    <li>Packaging Size: <span><?= htmlspecialchars($product['PACKAGING_SIZE'] ?? '-') ?></span></li>-->
                    <!--    <li>Dose: <span><?= htmlspecialchars($product['DOSE'] ?? '-') ?></span></li>-->
                    <!--    <li>Brand: <span><?= htmlspecialchars($product['BRAND'] ?? '-') ?></span></li>-->
                    <!--    <li>Composition: <span><?= htmlspecialchars($product['COMPOSITION'] ?? '-') ?></span></li>-->
                    <!--    <li>Form: <span><?= htmlspecialchars($product['FORM'] ?? '-') ?></span></li>-->
                    <!--    <li>Manufactured By: <span><?= htmlspecialchars($product['MANUFACTURED_BY'] ?? '-') ?></span></li>-->
                    <!--</ul>-->
                </div>

                <div class="purchase-info">
                    <button type="button" class="btn">I'm Interested</button>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include "includes/footer.php"; ?>
