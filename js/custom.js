
$(document).ready(function(){

    $('#down').click(function(){
        $('#formadd').slideToggle('slow');
      });
 
      $("#hide").slideToggle(function(){
        $("p").hide();
      });
      $("#show").click(function(){
        $("p").show();
      });

//On Click Increment
$('.increment').click(function (e){
e.preventDefault();

var qty =$(this).closest('.dataa').find('.input-qty').val();
var price =$(this).closest('.data').find('.price').val();



var value=parseInt(qty,10);
var valuee=parseInt(price);

valuee=isNaN(valuee) ? 0: valuee;

value =isNaN(value) ? 0 : value;
if(value < 10)
{
    value++;
    var result=valuee*value;

    $(this).closest('.dataa').find('.input-qty').val(value);    
    $(this).closest('.data').find('.total').val(result);  
    window.location.reload()
   
}else{
    value=10;
}   
    });

//On Click Decrement
$('.decrement').click(function (e){
e.preventDefault();

var qty =$(this).closest('.dataa').find('.input-qty').val();
var price =$(this).closest('.data').find('.price').val();

var value=parseInt(qty,0);
var valuee=parseInt(price);
valuee=isNaN(valuee) ? 0: valuee;
value =isNaN(value) ? 0 : value;
if(value > 0)
{
    value--;
    var result=valuee*value;
    $(this).closest('.dataa').find('.input-qty').val(value);
    $(this).closest('.data').find('.total').val(result);  
    window.location.reload() 
 
  

 
}       
    });

    $(document).on('click','.updateQty',function(){
        var qty=$(this).closest('.dataa').find('.input-qty').val();
        var prod=$(this).closest('.data').find('.cartidd').val();
        var userid=$(this).closest('.data').find('.useridd').val();
        $.ajax({
            method:"POST",
            url:"handlecart.php",
            data:{
                "prod_id":prod,
                "userid":userid,
                "prod_qty":qty,
                "scope":"update"
            },
            success: function(response){
               alert(response);
            }
        })
    });
    $(document).on('click','.remove',function(){
        var prod=$(this).closest('.dataa').find('.cartidd').val();
        var userid=$(this).closest('.dataa').find('.useridd').val();
        $.ajax({
            method:"POST",
            url:"handlecart.php",
            data:{
                "prod_id":prod,
                "userid":userid,
                "scope":"delete"
            },
            success: function(response){
           alert(response);
            }
        })
    });

  

});


    

