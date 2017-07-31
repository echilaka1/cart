<?php
if(isset($_POST['send'])){
    $product = $_POST['product'];
    $amount = $_POST['amount'];
    $quantity = $_POST['quantity'];
    $total = $_POST['total'];
   $image = $_FILES['photo'];
    $new_image = implode($image, '=>');


$file="data/cart.csv";
define('READ_MODE', "r"); //TO READ THE FILE
define('APPEND_MODE', "a");//TO WRITE ON THE FILE
//$file_handle=fopen($file, READ_MODE);//opening file
    
$file_handle= fopen($file, READ_MODE);
     $counter=0;
    
    while(!feof($file_handle)) {//not file end
        $line= fgetcsv($file_handle);
        if($line){
        $counter++;
        }
     }
    $counter++;
    fclose($file_handle);
    $user_id=$counter;
    //echo($user_id);
    $ImageName = $_FILES['photo']['name'];
    $fileElementName = 'photo';
    $path = 'uploads/'; 
    $location = $path . $_FILES['photo']['name']; 
    move_uploaded_file($_FILES['photo']['tmp_name'], $location); 
$file_handle= fopen($file, APPEND_MODE);
$data= [$user_id, $product, $amount, $quantity, $total, $new_image];
fputcsv($file_handle, $data);
fclose($file_handle);
    
     
//            $file="data/cart.csv";
//            $file_handle1= fopen($file, "r");
//            $totals = array();
//            while(!feof($file_handle1)) {//not file end
//                
//                 $line= fgetcsv($file_handle1);
//                $pull = $line[4];
//                array_push($totals, $pull);
//            }
//            echo(array_sum($totals));
//            fclose($file_handle);
    
        
    header("Location:cart.php");
}
?>



<!DOCTYPE html>
<html>
<head>
<title>Shopping cart</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="cart.css" type="text/css"> 
</head>
<body id ="cart">
<h1>Shopping Cart</h1>
<div class="container">
    <div class="row">
    <div class="col-md-6">
        <form id="shop" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <div id="formDiv">
                <h2>PRODUCT NAME</h2> <br>
                <input type="text" placeholder="Product name" id="product" name="product">
                <h2>AMOUNT</h2>
                <h>N</h><input type="number" placeholder="Enter Amount" id="amount" name="amount" min="1">.00
                <h2>QUANTITY</h2>
                <select id="quantity" name="quantity">
                    <option selected value="1" id="one" name= "one">1</option>
                    <option value="2" id="two" name= "value">2</option>
                    <option value="3" id="three" name= "value">3</option>
                    <option value="4" id="four" name= "value">4</option>
                    <option value="5" id="five" name= "value">5</option>
                </select>
                <span >
                    
                

                    <input type="file" name="photo" accept="image/*" id="photo">
                    
    
                        
                             
                    
                    <h2 >TOTAL</h2>
                    <input type="text" placeholder="Total" id="total" name="total">
                </span>
                <br><br>
                <input type=submit id="send" name="send" value="Add To Cart">
            </div>    
        </form>
    </div> <!--end of column3 --> 
    <div class="col-md-6" id="file"> 
        <?php
            echo("<table class='table table-bordered'><tr><th>S/N</th><th>PRODUCT</th><th>AMOUNT</th><th>QUANTITY</th><th>TOTAL</th><th>IMAGE</th></tr>");
            $file="data/cart.csv";
            $file_handle = fopen($file, "r");
        
            while(($fileIn= fgetcsv($file_handle)) !==false){
                $count=count($fileIn);
                echo("<tr>");
                for($i=0; $i < $count; $i++){
                    if (empty($fileIn[$i])) {
                          $newFile = "&nbsp;";
                        } 
                    else {
                          $newFile = $fileIn[$i];
                        }
                    echo("<td><img src='uploads/file2.jpg'></td>");
                }
                echo("</tr>");
            }    
            echo("</table>");
        
            echo("<p>Total :           ");
                //echo("<input type='sum'");
                $file="data/cart.csv";
            $file_handle1= fopen($file, "r");
            $totals = array();
            while(!feof($file_handle1)) {//not file end
                
                 $line= fgetcsv($file_handle1);
                $pull = $line[4];
                array_push($totals, $pull);
            }
            $sum = array_sum($totals);
            echo("N $sum.00");
            fclose($file_handle);
                    
                    
                //echo(">");
                echo("</p>");
        ?>   .
        <a href="data/cart.csv" ><button id="download" >Download</button> </a>
    </div> <!--end of column8-->
    </div>
</div> <!--end of conatainer-->
    
    
    
    

    
     <!--javascript--> 

     <script type="text/javascript"> 
         'use strict';
        
         // taking everything
        var product = document.getElementById("product"),
            priceInput = document.getElementById("amount"),
            quantityInput = document.getElementById("quantity"),
            cost = document.getElementById("total"),
            exam =  document.getElementById("shop");
        var item = product.value,
                price = priceInput.value,
                quantity = quantityInput.value,    
                totalPrice = cost.value; //get total price

         // functions we'll need
        function calculateThing() { 
            var item = product.value,
                price =priceInput.value,
                quantity = quantityInput.value;
                console.log(price);
                console.log(quantity);
                
            var total = price * quantity;
            
            console.log(total);
            cost.value = /*"N"+*/ total.toFixed(2);
        }
         
         
         // function imageDisplay{
              
            
          //}
         //adding event listeners
         document.getElementById("amount").addEventListener('input', calculateThing);
         document.getElementById("quantity").addEventListener('input', calculateThing);
         
         document.getElementById("file").addEventListener('input', imageDisplay);

    </script>
</body>
</html>