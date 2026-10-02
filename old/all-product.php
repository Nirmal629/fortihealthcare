<!-----Header------>
<?php 
$version = date('Y-m-d h:i:s');
include "includes/header.php"; 
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<!---------->
<section class="innerbanner_sec" style="background-image: url(assets/images/innerbanner.png);">
    <div class="cust_container">
        <div class="content">
            <h2 class="innerbanner_head">Our Product</h2>
            <nav aria-label="breadcrumb" class="breadcrumbs">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php" role="button" tabindex="0">Home</a></li>
                    <!-- <li class="breadcrumb-item"><a href="#" role="button" tabindex="1">demo</a></li> -->
                    <li class="breadcrumb-item active" aria-current="page">Our Product</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<!------------>
<section class="product_sec bothSide_gap">
    <div class="cust_container">
        <h4 class="sub_heading">Our Product</h4>
        <div class="sectionheading_wrap">
            <h2 class="heading">Delivering Health, One <span>Product at a Time</span></h2>
        </div>

        <div class="productlist_wrap">
    <?php
    include('admin/dbConnection.php');

    $result = mysqli_query($conn, "SELECT ID, PRODUCT_NAME, DESCRIPTION, IMAGE FROM ca_products ORDER BY ID DESC");

    if (mysqli_num_rows($result) > 0):
        while ($row = mysqli_fetch_assoc($result)):
            $id = $row['ID'];
            $name = htmlspecialchars($row['PRODUCT_NAME']);
            $desc = htmlspecialchars(mb_strimwidth(strip_tags($row['DESCRIPTION']), 0, 100, '...'));
            $image = !empty($row['IMAGE']) ? $row['IMAGE'] : 'assets/images/product/default.png'; // fallback image
    ?>
        <div class="product_box">
            <a href="product-Details.php?id=<?= $id ?>&v=<?=$version?>">
                <div class="product_img">
                    <img src="<?= 'admin/'.$image ?>" class="img-fluid" alt="<?= $name ?>" style="object-fit:cover"/>
                </div>
                <div class="details">
                    <h4 class="name"><?= $name ?></h4>
                    <p class="desc"><?= $desc ?></p>
                </div>
            </a>
        </div>
    <?php
        endwhile;
    else:
    ?>
        <p>No products found.</p>
    <?php endif; ?>
</div>

    </div>
</section>



<!-----modal------->
<!-- <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="productModalLabel">Product Details:</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="name"><span>Name:</span> ANASTRON 1mg Tablets IP</h4>
                <table>
                    <tr>
                        <td>Approx. Price:</td>
                        <td>Rs 200 / Stripe</td>
                    </tr>
                    <tr>
                        <td>Strength</td>
                        <td>1 mg</td>
                    </tr>
                    <tr>
                        <td>Packaging Type</td>
                        <td>Stripe</td>
                    </tr>
                    <tr>
                        <td>Packaging Size</td>
                        <td>1*10 Tablets</td>
                    </tr>
                    <tr>
                        <td>Dose</td>
                        <td>1 mg</td>
                    </tr>
                    <tr>
                        <td>Brand</td>
                        <td>Anastron</td>
                    </tr>
                    <tr>
                        <td>Composition</td>
                        <td>Anastrozole</td>
                    </tr>
                    <tr>
                        <td>Form</td>
                        <td>Tablet</td>
                    </tr>
                    <tr>
                        <td>Manufactured By</td>
                        <td>M Biotech</td>
                    </tr>
                </table>
                <p><b>Anastron 1mg</b> is used in the treatment of Breast Cancer. It is used with other treatments
                    such as surgery or radiation to treat breast cancer in women who have attained menopause.</p>
            </div>
            <div class="modal-footer gap-1">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div> -->



<!------footer------>
<?php include "includes/footer.php"; ?>