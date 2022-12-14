<?php $this->extend('includes/template'); ?>

<?php $this->section('main-content'); ?>


<section class="productslist_section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-md-6 col-12">
                <div class="products_listbox">
                    <h3>products LIst </h3>
                </div>
            </div>
        </div>
    </div>
</section>

<!--banner section end hare-->
<!--prosucts section start hare-->
<section class="products_section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-12 p-0 m-0">
                <div class="deals_textbox">
                    <h4>FASHION</h4>
                    <a href="#">VIEW ALL</a>
                </div>
            </div>
        <?php foreach ($product as $key => $value):?>

            <div class="col-xl-3 col-md-6 col-12">
                <div class="products_imgbox">
                   <a href="<?= base_url() ;?>/showProductDetails/<?= $value['id'] ;?>"> <img src="<?= base_url() ;?>/uploads/<?= $value['image'];?>" class="products_img"></a>
                    <h3><?= $value['product_name'];?></h3>
                    <h3><?= '   price '. $value['selling_price'];?> ৳ <del><?= $value['MRP'];?></span></h3>
                    <p><?= $value['product_desc'];?></p>
                    <p class='font-weight-bold'><?= $value['qty'];?> in Stocks</p>
                    <div class="products_textbox">

                        <div class="products_ulbox">
                            <ul>

                                <li>
                                    <a href="details.html"><button><svg xmlns="http://www.w3.org/2000/svg"
                                                class="products_ulboxicon" fill="currentColor" class="bi bi-cart4"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
                                            </svg> Add</button></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
<?php endforeach; ?>
          
        </div>
    </div>
</section>
<!--prosucts section end hare-->
<?php $this->endSection(); ?>