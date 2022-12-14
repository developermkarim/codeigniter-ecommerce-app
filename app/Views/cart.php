
<?php

// use App\Models\CartModel;

 $this->extend('includes/template.php'); ?>

<?php $this->section('main-content'); ?>

<?php
// $cart = new CartModel();
// $cartSelect = $cart->select('COUNT(qyt)');
// $cart->where('user_id', session()->get('id'));
// $totalCount = $cart->findAll();
// print_r($totalCount['COUNT(qyt)']);

?>

 <!--cart middle section start hare-->
 <section class="cart_middlesc">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-md-12 col-12">
                    <div class="cart_middleimgbox">
                        <div class="cart_itembox">
                           
                            <h3>Total item (
                               
                                <?php echo session()->get('id') ? $totalSum :'0' ?>
                                
                                )</h3>
                           
                            <h4>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                  </svg>
                                  Deliver to
                            </h4>
                           
                        </div>
                        <div class="cart_middleborder"></div>
                       
                        <div class="cart_middleborder"></div>

                        <!-- /*  SELECT users.id,cart.user_id, product.id, product.qty as pdQty, product.image,product.MRP, product.selling_price,cart.id as cartId,cart.qyt as cartQty, cart.cost from cart INNER JOIN product INNER JOIN users ON product.id = cart.fk_product_id WHERE cart.user_id = users.id; */ -->

                      
                       

                        <?php
                        $totalPrice = 0;
                        $totalDiscount = 0;
                        foreach($cartItems as $cart):
                            $cartFormula = ($cart['MRP'] - $cart['cost']) * 100 / $cart['cost'];
                            $totalPrice += $cart['cost'] * $cart['cartQty'];
                            $totalDiscount+=  ($cart['MRP'] - $cart['cost']) * $cart['cartQty'];

                        ?>
                         <div class="row" id="fullCart">
                            <div class="col-xl-2 col-md-12 col-12">
                                <div class="cart_leftimgbox">
                                    <div class="cart_leftimgcon">
                                        <img src="uploads/<?= $cart['pdImage'];?>" class="cart_leftimg" alt="">
                                    </div>
                                    <div class="cart_formbox">
                                        <a href="javadcript:void(0)" onclick="minus(<?= $cart['pdId'];?>,<?= $cart['user_id'];?>)" >
                                        <div  class="cart_formminus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="cart_formminusicon" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                            </svg>
                                        </div>
                                        </a>

                                       
                                        <input type="text" id="count" value="<?= $cart['cartQty'] ;?>" maxlength="4"  class="cart_input">

                                        <a href="javascript:void(0)" onclick="addCart(<?= $cart['pdId'];?>,<?= $cart['cost'];?>,<?= $cart['user_id'];?>)">
                                        <div  class="cart_formplus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="cart_formminusicon" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                            </svg>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-4 col-md-12 col-12">
                                <div class="cart_middletextbox">
                                    <h3><?= $cart['pdName'] ?></h3>
                                    <h4>Black</h4>
                                    <h5>??? <?= number_format($cart['selling_price'] * $cart['cartQty'], 0,'.',',') ?> <del>??? <?= $cart['MRP'] * $cart['cartQty'];?></del><span> <?= round($cartFormula * $cart['cartQty'],2)  ;?>% OFF</span></h5>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12 col-12">
                                <div class="cart_rightextbox">
                                    <h6>Delivery expected <?= $cart['created_at'] ?></h6>
                                    <div class="cart_middletextbtnsc">

                                       <button onclick="removeCart(<?= $cart['cartId'] ;?>)" class="cart_middletextbtn">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="cart_deleteicon" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                          </svg>
                                          Remove 
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                    <div class="cart_cheackoutsc">
                        <a href="<?= base_url('checkout') ;?>">Checkout</a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-12 col-12">
                    <div class="cart_pricebox">
                        <h3>Price details</h3>
                        <div class="cart_priceborder"></div>
                        <div class="cart_pricetextbox">
                            <h4>Price <span id="items"></span> item</h4>
                            <h5 id="itemsPrice">??? <?= number_format($totalPrice,0,'.',',') ;?></h5>
                        </div>
                        <div class="cart_pricetextbox">
                            <h4>Discount</h4>
                            <h6 id="itemsDescount">??? <?= number_format($totalDiscount,0,'.',',')   ;?></h6>
                        </div>
                        <div class="cart_pricetextbox">
                            <h4>Delivery charge</h4>
                            <h6>Free</h6>
                        </div>
                        <div class="cart_amountbox">
                            <h4 >Total amount</h4>
                            <h5 >??? <?= number_format($totalPrice - $totalDiscount,0,',') ;?> </h5>
                        </div>
                        <p>You will get discount of ???1000 on this order</p>
                    </div>
                    <img src="images/price-carv.png" class="cart_pcarvimg">
                </div>
            </div>
        </div>
    </section>
    <!--cart middle section end hare-->
    <?php $this->endSection(); ?>