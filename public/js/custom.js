//  $(document).ready(function(){
  
    

var baseUrl = 'http://localhost:8080/';
function addCart(productId,cost,userId){
   $.ajax({
    url:baseUrl + 'addCart',
    type:'POST',
    data:{productId:productId,pdCost:cost,userId:userId},
    beforeSend:()=>{
    },
    completed:()=>{
        // $('#wait').text('')()
    },
    success:(response)=>{
     var res = JSON.parse(response);
     if(res.status == 'success'){
      // window.location.href = baseUrl + 'cartShow';
       var result = res.qty;
       var discount = ( 4 / res.price) * 100 
      $('#count').val(result);
      $('#totalItem').text(res.count)
      $("#countValue").text(res.count)
      $('#addToCartBtn').hide();
      $('#input_div').show();
     }

    }
   })

}

// 'qty'=>$oldtqty,'count'=>$allCount,'price'=>$pdPrice used in addToCart()
/* <div class="cart_pricetextbox">
<h4>Price <span id="items"></span> item</h4>
<h5 id="itemsPrice">₹ 45,998</h5>
</div>
<div class="cart_pricetextbox">
<h4>Discount</h4>
<h6 id="itemsDescount">-₹ 1000</h6>
</div>
<div class="cart_pricetextbox">
<h4>Delivery charge</h4>
<h6>Free</h6>
</div>
<div class="cart_amountbox">
<h4 >Total amount</h4>
<h5 id="itemsTotal">₹ 44,998</h5>
</div> */


function minus(productId,userId){
$.ajax({
  url:baseUrl + 'decrement',
  type:'POST',
  data:{productId:productId,userId:userId},
  beforeSend:()=>{},
  complete:()=>{},
  success:(resonse)=>{
 var res = JSON.parse(resonse);
 if(res.status == 'success'){
  // alert('you have  cart successfully')
  // window.location.href = baseUrl + 'cartShow';

  $('#count').val(res.qyt);
  
  var CartRow =  $('#fullCart');
  if(res.qyt > 1){
    CartRow.hide();
  }
  $('#addToCartBtn').hide();
  $('#input_div').show();

 }
 else{
  $('#addToCartBtn').show();
  $('#input_div').hide();
 }
 }

})

}

function removeCart(cartId){

  $.ajax({
    url:baseUrl + 'cartRemove',
    type:'POST',
    data:{cartId:cartId},
    success: (respose)=>{
    if(respose == 'success'){

    
   
    
      alert('you have delted cart successfully')
      window.location.href = baseUrl + 'cartShow';
  
      
    }
      
    }

  })

}


/* Add address Function Here */
function addShipping(){
  var f_name = $("#firstname").val();
  var l_name = $("#lastname").val();
  var pincode = $('#pincode').val();
  var  city = $('#city').val();
  var area = $('#area').val();
  var message = $('#message').val();
  // alert(f_name+l_name+pincode+message+area+city);
  var addressStr = `${f_name} ${l_name} ${pincode}`;
  if(f_name == '' || l_name == '' || pincode == ''){
    alert('plz fill up the field')
    
  }


  else {


// alert(formdata.name)
  $.ajax({
    url:baseUrl + 'shipping',
    type:'POST',
    data:{f_name:f_name,l_name:l_name,city:city,area:area,pincode:pincode,message:message},
    beforeSend:()=>{},
    complete: ()=>{},
    success: (response)=>{
   var res = JSON.parse(response)
    console.log(res);
    if(res.status == 'success'){
    alert('Shipping added successfully')
      $('#shippingAddressDiv').append('<label><input name="shipping" type="radio" value="'+res.lastInsertId+'">'+addressStr+'</label><br>');
    }
    else{
      alert('Shipping Not added ,please , check the wrong')
    }
    
   
  }
})
  }

}

function proceddToPay(){
   if($("input:radio[name='shipping']").is(':checked')){
    const delivaryAddress = $("input[name='payment']:checked").val();
    alert(delivaryAddress)
   }
   else{
    alert('please,check at least one value')
   }
  $.ajax({
    url:baseUrl + 'proceed',
    type:'POST',
    beforeSend:()=>{},
    complete: ()=>{},
    success: (response)=>{
     alert(response)
   
    }

})
}