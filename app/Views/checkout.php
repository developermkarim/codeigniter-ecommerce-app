<?php
error_reporting(0);


 $this->extend('includes/template.php'); ?>

<?php $this->section('main-content'); ?>



 <!--cart middle section start hare-->
 <section class="cart_middlesc">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-md-12 col-12">
                    <div class="checkout_paymentbox">
                        <div class="checkout_atextele">Delivery address</div>
                      

                        <div class="checkout_paymentform">
                            <div id="shippingAddressDiv"></div>
                      
                                <?php
                                foreach ($shippingAddress as $key => $value) :?>
                                 
                                 <label for=""><input type="radio" name="shipping" value="<?= $value['id'] ;?>"><?= $value['firstname'] . ' ' . $value['lastname'] . ' ' . $value['area'] . ' ' . $value['pincode'];?>
                                </label><br>

                                <?php endforeach; ?>
                        </div>



                        <div class="checkout_paymentbtnsc">
                            <a href="#" class="consualt_btn"  data-toggle="modal" data-target="#exampleModal">Add Address</a>
                        </div>
                    </div>
                    <div class="cart_middleimgbox">
                        <div class="checkout_deliverybox">Order summery</div>
                       
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
                                   
                                </div>
                            </div>
                            
                            <div class="col-xl-4 col-md-12 col-12">
                                <div class="cart_middletextbox">
                                    <h3><?= $cart['pdName'] ?></h3>
                                    <h4>Black</h4>
                                    <h5>৳ <?= number_format($cart['selling_price'] * $cart['cartQty'], 0,'.',',') ?> <del>৳ <?= $cart['MRP'] * $cart['cartQty'];?></del><span> <?= round($cartFormula * $cart['cartQty'],2)  ;?>% OFF</span></h5>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12 col-12">
                                <div class="cart_rightextbox">
                                    <h6>Delivery expected <?= $cart['created_at'] ?></h6>
                                   
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                    <div class="cart_emailbox">
                        <div>
                        &nbsp; &nbsp; &nbsp;  <input type="radio" name="payment" value="COD" id=""> Cash On Delivery
                        &nbsp; &nbsp; &nbsp;
                      <input type="radio" name="payment" value="online" id=""> Online Payment
                        </div>
                     
                        <a id="btn" href="javascript:void(0)" onclick="proceddToPay()">proceed to pay</a>
                    </div>
                    
                </div>
                <div class="col-xl-3 col-md-12 col-12">
                    <div class="cart_pricebox">
                        <h3>Price details</h3>
                        <div class="cart_priceborder"></div>
                        <div class="cart_pricetextbox">
                            <h4>Price <span id="items"></span> item</h4>
                            <h5 id="itemsPrice">৳ <?= number_format($totalPrice,0,'.',',') ;?></h5>
                        </div>
                        <div class="cart_pricetextbox">
                            <h4>Discount</h4>
                            <h6 id="itemsDescount">৳ <?= number_format($totalDiscount,0,'.',',')   ;?></h6>
                        </div>
                        <div class="cart_pricetextbox">
                            <h4>Delivery charge</h4>
                            <h6>Free</h6>
                        </div>
                        <div class="cart_amountbox">
                            <h4 >Total amount</h4>
                            <h5 >৳ <?= number_format($totalPrice - $totalDiscount,0,',') ;?> </h5>
                        </div>
                        <p>You will get discount of ₹1000 on this order</p>
                    </div>
                    <img src="images/price-carv.png" class="cart_pcarvimg">
                </div>
            </div>
        </div>
    </section>
    <!--cart middle section end hare-->
   
     <!--modal section start hare-->
     <section>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
              
                <h5 class="modal-title" id="exampleModalLabel">Seclet Your Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                   <!-- <form id="shipping-form" class="modal_formbox" method="POST" action=""> -->
                        <!-- <select name="cars" id="cars" class="modal_form"> -->
                        <!-- <option value="volvo">Shipping Address</option> -->
                        <!-- <option value="audi">Joypur</option>
                        <option value="audi">Kolkata</option>
                        <option value="audi">Hooghly</option>
                        <option value="saab">Saab</option>
                        <option value="opel">Opel</option> -->
                        <!-- <option value="audi">Audi</option> -->
                        <!-- </select> -->
                        <div class="col-md-12 mrg10">

                        <input type="text" name="firstname" class="form-control" placeholder="First Name"  id="firstname">
                        </div>

                        <div class="col-md-12 mrg10">
                        <input type="text" name="lastname" class="form-control" placeholder="Last Name"  id="lastname" >
                        </div>
                        
                        <div class="col-md-12 mt-2 mrg10">
                        <input type="text" name="city" class="form-control" placeholder="City "  id="city" required>
                        </div>
                        <div class="col-md-12 mt-2 mrg10">
                        <input type="text" name="area" class="form-control" placeholder="Area"  id="area" required>
                        </div>
                        <div class="col-md-12 mt-2 mrg10">
                        <input type="text" name="pincode" class="form-control" placeholder="Pin Code"  id="pincode" required>
                        </div>

                       <textarea type="text" placeholder="Message" class="modal_form1" id="message" name="message" required></textarea>
                      <div class="col-md-12">
                        <a href="javascript:void(0)" onclick="addShipping()" class="modal_btn">Add</a>
                      </div>
                  
                </div>
               
            </div>
            </div>
        </div>
    </section>
<!--modal section end hare--> 

<?php $this->endSection(); ?>

