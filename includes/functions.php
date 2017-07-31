<?php 
// FUNCTIONS.php_ini_loaded_file


function display(){
  echo "<table class='table table-bordered'><tr><th>ID</th><th>Food Items</th><th>Amount</th><th>Quantity</th><th>Total</th><th>Images</th></tr>";
                $file = "data/shop.csv";
                	$filehandle = fopen($file, 'r');
                    while (($display = fgetcsv($filehandle)) !== false ){ #while is always true
                        $num = count($display); #returns the number of elements in $num arrray
                        echo "<tr>";
                        for ($c=0; $c < $num; $c++) { #for loop to stop at the end of files in  $num array
                        	if (empty($display[$c])) { # determines if $display is empty, A variable is considered empty if it does not exist or if its value equals FALSE. here the value of $display is not empty. empty is a bool
                                #The following things are considered to be empty:
                                #"" (an empty string)
                                # 0 (0 as an integer)
                                # 0.0 (0 as a float)
                                # "0" (0 as a string)
                                # NULL
                                # FALSE
                                # array() (an empty array)
                                # $var; (a variable declared, but without a value)
                               $value = "&nbsp;"; #assigns $value to space if $display is empty
                            } else {
                                $value = $display[$c]; #assigns $value to $display if $display have elements in the file, in this case $display is not empty, so it is true
                            }
                              echo "<td>" .$value. '</td>';
                            }
                            echo "</tr>";
                            
                          // echo fgets($filehandle)."<br>";
                    }
                    echo "</table>";
                    fclose($filehandle); 
}


?>