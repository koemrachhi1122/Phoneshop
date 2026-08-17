<?php

session_start();

include __DIR__ . "/includes/db.php";

include __DIR__ . "/includes/header.php";


// Create Cart

if(!isset($_SESSION['cart'])){

    $_SESSION['cart'] = [];

}


// ADD PRODUCT TO CART

if(isset($_GET['add'])){


    $product_id = $_GET['add'];


    if(isset($_SESSION['cart'][$product_id])){


        $_SESSION['cart'][$product_id]++;


    }else{


        $_SESSION['cart'][$product_id] = 1;


    }


    header("Location: cart.php");

    exit();

}





// REMOVE PRODUCT

if(isset($_GET['remove'])){


    $id = $_GET['remove'];


    unset($_SESSION['cart'][$id]);


    header("Location: cart.php");

    exit();

}





// UPDATE CART

if(isset($_POST['update'])){


    foreach($_POST['quantity'] as $id=>$qty){


        if($qty > 0){

            $_SESSION['cart'][$id] = $qty;

        }


    }


    header("Location: cart.php");

    exit();

}



?>



<div class="container mt-5">


<h2 class="text-center mb-4">

Shopping Cart

</h2>



<?php if(empty($_SESSION['cart'])){ ?>


<div class="alert alert-warning text-center">

Your cart is empty.

<br><br>

<a href="products.php" class="btn btn-primary">

Continue Shopping

</a>

</div>



<?php }else{ ?>



<form method="POST">


<div class="table-responsive">


<table class="table table-bordered bg-white">


<tr>

<th>Image</th>

<th>Product</th>

<th>Price</th>

<th>Quantity</th>

<th>Total</th>

<th>Action</th>

</tr>



<?php


$total = 0;



foreach($_SESSION['cart'] as $id=>$qty){



$sql = "SELECT * FROM products WHERE id='$id'";


$result = $conn->query($sql);


$product = $result->fetch_assoc();



$subtotal = $product['price'] * $qty;


$total += $subtotal;



?>



<tr>


<td>

<img 
src="images/<?php echo $product['image']; ?>"
width="80">

</td>



<td>

<?php echo $product['product_name']; ?>

</td>




<td>

$<?php echo $product['price']; ?>

</td>



<td>


<input 

type="number"

name="quantity[<?php echo $id; ?>]"

value="<?php echo $qty; ?>"

min="1"

class="form-control"


>


</td>




<td>

$<?php echo $subtotal; ?>

</td>



<td>


<a 

href="cart.php?remove=<?php echo $id; ?>"

class="btn btn-danger btn-sm">

Remove

</a>


</td>


</tr>



<?php } ?>



<tr>


<td colspan="4" class="text-end">

<h4>

Total:

</h4>

</td>


<td colspan="2">


<h4 class="price">

$<?php echo $total; ?>

</h4>


</td>


</tr>



</table>


</div>



<button 

name="update"

class="btn btn-primary">

Update Cart

</button>



<a 

href="checkout.php"

class="btn btn-success">

Checkout

</a>



</form>



<?php } ?>



</div>



<?php

include __DIR__ . "/includes/footer.php";

?>