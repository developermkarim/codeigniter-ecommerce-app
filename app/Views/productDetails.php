<?php $this->extend('includes/template.php'); ?>

<?php $this->section('main-content'); ?>


<section class="details_section">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-md-12 col-12">
                <div class="details_menubox">

                   

                        <div class="item">
                            <img src="<?= base_url();?>/uploads/<?=$productDetals['image'];?>" class="details_img" width=200 height=300>

                        </div>

                            <div class="details_btnsc">
                                <a href="cart.html"><button class="details_btn">ADD TO CART</button></a>
                            </div>
                    </div>
</div>

                <div class="col-xl-8 col-md-12 col-12">
                    <div class="details_textbox">
                        <h3><?= $productDetals['product_name'];?></h3>
                        <h4>BDT <?= $productDetals['selling_price'] ;?> <p><del>BDT <?= $productDetals['MRP'];?></del></p></h4>
                        <h6>Hurry, Only <?= $productDetals['qty'];?> left! </h6>
                        <h5>Available offers</h5>
                        <H6><?=$productDetals['product_desc'];?></H6>
                        <h6><b>Partner OfferSign</b> up for Flipkart Pay Later and get Flipkart Gift Card worth
                            ₹100*Know
                            More</h6>
                        <h6>No Cost EMI on Bajaj Finserv EMI Card on cart value above ₹2999T&amp;C</h6>
                    </div>
                    <div class="details_textbox1">
                        <h3>Specifications</h3>
                        <h6>Sales Package1 X Power Bank , Charging Cable , User Manual</h6>
                        <h6>Model Name Power Bank DX03 10000 Mah</h6>
                        <h6>Suitable Device Mobile</h6>
                        <h6>Number of Output Ports 3</h6>
                        <h6>Charging Cable Included Yes</h6>
                        <h6>Weight 195 g</h6>
                    </div>
                </div>
            </div>
        </div>
</section>


<?php $this->endSection(); ?>