<?php 
    session_start();

    //include functions file
    include ('includes/functions.php');

    define("TITLE", "Shopping Cart");

    $error_message = "";
    
    if (isset($_POST['save'])){

        $item = $_POST['item'];
        $amount = $_POST['amount'];
        $quantity = $_POST['quantity'];
        $total = $_POST['total'];
        // $image = $_FILES['file'];
        // $new_image = implode($image, '=>');
  
        #initialize form input to empty so if no data is inputed, it will display an error message
        if ($item == "" || $amount == "" || $quantity == ""){
          $error_message = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Incorrect Details, You are not yet hungry. </div>"; 
        } else {

        $file = "data/shop.csv"; //get file path
        define ('READ_MODE', "r"); //declare constant for read mode
        define ('APPEND_MODE', "a"); // define constant for write mode
        $file_handle = fopen($file, READ_MODE); // open the file to read

        $counter = 0; #initialize counter
        while (!feof ($file_handle)) { #while is not end of file
            $line = fgetcsv($file_handle); #get elements in the file one line at a time
            if ($line) { #if it gets a line of element in the file it should assign a unique number strting from 1
                $counter++; #continue adding numbers 2, 3, 4, etc as long as is not end of file
            }

        }

        $counter++; #generates d user_id for new elements of a file 

        fclose($file_handle);

        $user_id = $counter;

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed  = array('jpg','jpeg','gif','png','pdf');
        if(in_array($fileActualExt, $allowed)){
          if($fileError == 0){
            if($fileSize < 1000000){
              $fileNameNew = uniqid('', true). ".". $fileActualExt;
              $fileDestination = './uploads/'.$fileNameNew;
              move_uploaded_file($fileTmpName, $fileDestination);
            }
          }
        }

        $file_handle = fopen($file, APPEND_MODE);
        $data = [$user_id, $item, $amount, $quantity, $total, $fileDestination];
        fputcsv($file_handle, $data);
        fclose ($file_handle);

        header ("index.php");
        }

    }

    include('includes/header.php');
   
?>

            <h1> <?php echo TITLE; ?></h1>
            <p><?php echo $error_message; ?></p>
             <div class="row">
             <div class="col-md-7">
              <h2 class="logo"> Mini Shopping Cart</h2>
                <p class="text-danger">* Required fields</p>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="food items" class="col-sm-2 control-label">Item Name</label>
                    <small class="text-danger">* </small>
                    <input type="text" placeholder="What is the name of the item?" name="item"><br><br>
                  </div>
                  <div class="form-group">
                    <label for="amount" class="col-sm-2 control-label">Amount</label>
                    <small class="text-danger">* </small>
                    <input type="text" placeholder="Enter Amount" name="amount">
                    </div>
                    <div class="form-group">
                    <label for="quantity" class="col-sm-2 control-label"> 
                    Quantity <span class="label label-primary quantity-label">1</span></label>
                    <small class="text-danger">* </small>
                    <input type="number" placeholder="Quantity" name="quantity" min="0">
                    </div>
                     <div class="form-group">
                    <label for="total" class="col-sm-2 control-label">Total</label>
                    <small class="text-danger"> </small>
                    <input type="text" placeholder="Total" name="total" class="text-center total">
                    </div>
                    <div class="form-group">
                    <label for="file-upload" class="col-sm-2 control-label"> Upload Image </label>
                    <small class="text-danger">* </small>
                   <!--  <input type="hidden" name="MAX_FILE_SIZE" value="1000"> -->
                    <input type="file" name="file" accept="image/*" id="image">
                    </div>
                    <!-- <div class="text-center text-giant total"></div> -->
                    <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary" name="save" id="save">Save</button>
                    </div>

                </form>
               
              </div>
              <div class="col-md-5">
                 <h2 class="logo"> Menu List</h2>
                <?php 
                     display();
                     echo("<p>Total :           ");
                    //echo("<input type='sum'");
                    $file="data/shop.csv";
                    $file_handle1= fopen($file, "r");
                    $totals = array();
                    while(!feof($file_handle1)) {//not file end
                          $line= fgetcsv($file_handle1);
                          $pull = $line[4];
                          array_push($totals, $pull);
                      }
                      // print_r ($totals);
                    $sum = 0;
                    for ($i = 0; $i < count($totals); $i++) {
                      $sum = $sum + $totals[$i];
                    }
                    // $sum = array_sum($totals);
                    echo ("N $sum.00");
                    fclose($file_handle1);    
                    //echo(">");
                    echo("</p>");
                ?>
                <a href="data/shop.csv"><button type="button" class="btn btn-success">Download</button></a>
              </div>
              </div>

              <?php
                include('includes/footer.php');
              ?>

       