//  $(document).ready(function(){
  
    

var baseUrl = 'http://localhost:8080/';
function addCart(productId,cost,userId){
   $.ajax({
    url:baseUrl + 'addCart',
    type:'POST',
    data:{productId:productId,pdCost:cost,userId:userId},
    beforeSend:()=>{
$('#wait').text('plz,Waiting to add in cart')
    },
    completed:()=>{
        $('#wait').text('')()
    },
    success:(response)=>{
     var res = JSON.parse(response);
     if(res.status == 'success'){
       var result = res.qty;
      $('#count').val(result);
      $('#addToCartBtn').hide();
      $('#input_div').show();

     }

    }
   })

}

function plus(productId,userId){
$.ajax({
  url:baseUrl + 'increment',
  type:'POST',
  data:{productId:productId,userId:userId},
  success:(resonse)=>{
    
  }
})
}



function minus(productId,userId){
$.ajax({
  url:baseUrl + 'decrement',
  type:'POST',
  data:{productId:productId,userId:userId},
  success:(resonse)=>{

  }
})
}


