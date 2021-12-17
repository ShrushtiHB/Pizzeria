<?php   
 session_start();  
 $connect = mysqli_connect("localhost", "root", "", "pizzeria");  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Shopping Cart</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <link rel="stylesheet" href="Homecss.css">
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body style="background-image: linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)),url(bg.jpg); width: 100%;background-position: center;
    background-size: cover; color:white;">  
           <br />  
           
           <div class="container" style="width:900px;"> 
           <h1 align="center">OUR MENU</h1><br />
            <div style="text-align:center"> 
                <a href="cart.php">
                    <button class="button">VIEW MY CART</button>
                </a>
                <a href="welcome.php">
                    <button class="button">GO BACK</button>
                </a>
                <a href="logout.php">
                    <button class="button" style="background-color:red">LOGOUT</button>
                </a>
            </div>
                <br /><br />
                <?php  
                $query = "SELECT * FROM food_items ORDER BY id ASC";  
                $result = mysqli_query($connect, $query);  
                if(mysqli_num_rows($result) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
                ?>  
                <div class="col-md-4" >  
                     <form method="post" action="cart.php?action=add&id=<?php echo $row["id"]; ?>">  
                          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px 16px;" align="center">  
                               <img src="<?php echo $row["image"]; ?>" class="img-responsive" style="width:374px; height:223px;" /><br />  
                               <h4 class="text-info"><?php echo $row["name"]; ?></h4>  
                               <h4 class="text-danger">Rs. <?php echo $row["price"]; ?></h4>  
                               <input type="text" name="quantity" class="form-control" value="1" />  
                               <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />  
                               <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
                               <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />  
                          </div>  
                     </form>  
                </div>  
                <?php  
                     }  
                }  
                ?>  
                <div style="clear:both"></div>  
                <br /> 
                
           </div>  
           <br />  
      </body>  
 </html>