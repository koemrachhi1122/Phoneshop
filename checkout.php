<?php

session_start();

include __DIR__ . "/includes/db.php";

include __DIR__ . "/includes/header.php";


// Check Login

if(!isset($_SESSION['user'])){

    echo "

    <div class='container mt-5'>

    <div class='alert alert-warning'>

    Please login before checkout.

    </div>

    </div>

    ";

    include __DIR__ . "/includes/footer.php";

    exit();

}



// Check Cart

if(empty($_SESSION['cart'])){

    echo "

    <div class='container mt-5'>

    <div class='alert alert-danger'>

    Your cart is empty.

    </div>

    </div>

    ";

    include __DIR__ . "/includes/footer.php";

    exit();

}



?>



<div class="container mt-5">


<h2 class="text-center mb-4">

Checkout

</h2>



<div class="row">



<div class="col-md-6">


<div class="auth-box">


<form method="POST">



<div class="mb-3">

<label>
Full Name
</label>

<input 
type="text"
name="name"
class="form-control"
required>

</div>




<div class="mb-3">

<label>
Address
</label>

<textarea
name="address"
class="form-control"
required></textarea>

</div>




<div class="mb-3">

<label>
Phone Number
</label>

<input 
type="text"
name="phone"
class="form-control"
required>

</div>



<button 
name="order"
class="btn btn-success w-100">

Place Order

</button>


</form>



</div>


</div>





<div class="col-md-6">


<div class="cart-box">


<h4>
Order Summary
</h4>



<?php


$total = 0;



foreach($_SESSION['cart'] as $id=>$qty){


$sql = "SELECT * FROM products WHERE id='$id'";


$result = $conn->query($sql);


$product = $result->fetch_assoc();


$subtotal = $product['price'] * $qty;


$total += $subtotal;



?>


<p>

<?php echo $product['product_name']; ?>

×

<?php echo $qty; ?>


<span class="float-end">

$<?php echo $subtotal; ?>

</span>


</p>



<?php } ?>


<hr>


<h4>

Total:

<span class="price">

$<?php echo $total; ?>

</span>


</h4>


</div>


</div>



</div>


</div>





<?php



// PROCESS ORDER


if(isset($_POST['order'])){



$user_id = $_SESSION['user']['id'];



$name = $_POST['name'];

$address = $_POST['address'];

$phone = $_POST['phone'];





// INSERT ORDER


$sql = "

INSERT INTO orders(user_id,total,status)

VALUES('$user_id','$total','Pending')

";



$conn->query($sql);



$order_id = $conn->insert_id;





// INSERT ORDER ITEMS


foreach($_SESSION['cart'] as $id=>$qty){



$sql = "

SELECT * FROM products WHERE id='$id'

";



$result = $conn->query($sql);


$product = $result->fetch_assoc();





$conn->query("

INSERT INTO order_items

(order_id,product_id,quantity,price)

VALUES

('$order_id','$id','$qty','".$product['price']."')

");



}





// CLEAR CART


unset($_SESSION['cart']);



echo "

<script>

alert('Order Successfully Placed!');

window.location='index.php';

</script>

";



}





include __DIR__ . "/includes/footer.php";


?>