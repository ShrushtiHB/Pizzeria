<?php    
session_start();
include 'config.php';
 if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_GET["id"],  
                     'item_name'               =>     $_POST["hidden_name"],  
                     'item_price'          =>     $_POST["hidden_price"],  
                     'item_quantity'          =>     $_POST["quantity"]  
                );  
                $_SESSION["shopping_cart"][$count] = $item_array;  
           }  
           else  
           {  
                echo '<script>window.location="index.php"</script>';  
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],  
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"],  
                'item_quantity'          =>     $_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
 }  
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo '<script>window.location="cart.php"</script>';  
                }  
           }  
      }  
 }  
 if(isset($_GET["action"])){
     if($_GET["action"] == "addtoorder"){
          foreach($_SESSION["shopping_cart"] as $keys => $values){
               $username = $_SESSION['username'];
               $name = $values["item_name"];
               $quantity = $values["item_quantity"];
               $price = $values["item_price"];
               $itemtotal = $quantity*$price;
               $ordernumber = rand(1,99);
               $sql = "INSERT INTO orders (ordernumber, username, pizzaname, quantity, price, total)
                    VALUES ('$ordernumber', '$username', '$name', '$quantity', '$price', '$itemtotal')";
               $result = mysqli_query($conn, $sql);
               if($result) {
                    header("Location: checkout.php");;
               } else {
                    echo '<script>alert("Woops! Something went wrong.")</script>';
                }
          }
     }
}

 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Shopping Cart</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body style="background-image: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)),url(bg.jpg); width: 100%;background-position: center;
    background-size: cover; color:white;">  
           <br />  
                <h1 style="text-align:center">Order Details</h1>  
                <div class="table-responsive"style="margin-left:100px; margin-right:100px; width:80%">  
                     <table class="table table-bordered"style="width:100%">  
                          <tr>  
                               <th width="40%">Item Name</th>  
                               <th width="10%">Quantity</th>  
                               <th width="20%">Price</th>  
                               <th width="15%">Total</th>  
                               <th width="5%">Action</th>  
                          </tr>  
                          <?php   
                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {  
                          ?>  
                          <tr>  
                               <td><?php echo $values["item_name"]; ?></td>  
                               <td><?php echo $values["item_quantity"]; ?></td>  
                               <td>$ <?php echo $values["item_price"]; ?></td>  
                               <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>  
                               <td><a style="color:#ff7f7f; font-weight:800px" href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger" style="color:#ff7f7f">Remove</span></a></td>  
                          </tr>  
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                               }  
                          ?>  
                          <tr>  
                               <td colspan="3" align="right">Total</td>  
                               <td align="right">$ <?php echo number_format($total, 2); ?></td>  
                               <td></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
					 <?php
			echo '<a href="index.php"><button class="btn btn-warning">Add more items</button></a>&nbsp;<a href="cart.php?action=addtoorder"><button type="submit" class="btn btn-success pull-right"><span class="glyphicon glyphicon-share-alt"></span> Check Out</button></a>';
			?>
                </div>  
           </div>  
           <br />  
      </body>  
 </html>