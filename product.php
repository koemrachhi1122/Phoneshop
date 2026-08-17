<?php

include __DIR__ . "/includes/db.php";

include __DIR__ . "/includes/header.php";


// Check Product ID

if(!isset($_GET['id'])){

    header("Location: products.php");
    exit();

}


$id = $_GET['id'];



// Get Product Data

$sql = "SELECT * FROM products WHERE id='$id'";

$result = $conn->query($sql);



if($result->num_rows == 0){

    echo "
    <div class='container mt-5'>
        <div class='alert alert-danger'>
            Product not found
        </div>
    </div>";

    include __DIR__ . "/includes/footer.php";
    exit();

}


$product = $result->fetch_assoc();



?>



<div class="container mt-5">


<div class="row">



<!-- PRODUCT IMAGE -->

<div class="col-md-6">


<div class="product-card">


<img 
src="images/<?php echo $product['image']; ?>"
class="img-fluid"
>



</div>


</div>





<!-- PRODUCT INFO -->

<div class="col-md-6">


<h1>

<?php echo $product['product_name']; ?>

</h1>



<h3 class="price">

$<?php echo $product['price']; ?>

</h3>



<p>

<?php echo $product['description']; ?>

</p>




<p>

<strong>
Available:
</strong>

<?php echo $product['quantity']; ?>

pieces

</p>




<?php if($product['quantity'] > 0){ ?>


<a 
href="cart.php?add=<?php echo $product['id']; ?>"
class="btn btn-success btn-lg">

<i class="fa fa-cart-plus"></i>

Add To Cart

</a>



<?php }else{ ?>


<button class="btn btn-danger">

Out of Stock

</button>



<?php } ?>



</div>



</div>

</div>






<!-- RELATED PRODUCTS -->


<div class="container mt-5">


<h2 class="text-center mb-4">

Related Products

</h2>



<div class="row">


<?php


$category = $product['category_id'];



$sql2 = "
SELECT * FROM products
WHERE category_id='$category'
AND id!='$id'
LIMIT 3
";



$result2 = $conn->query($sql2);



while($item = $result2->fetch_assoc()){


?>


<div class="col-md-4 mb-4">



<div class="product-card">


<img 
src="images/<?php echo $item['image']; ?>"
class="img-fluid"
>



<div class="card-body">


<h5>

<?php echo $item['product_name']; ?>

</h5>



<p class="price">

$<?php echo $item['price']; ?>

</p>



<a 
href="product.php?id=<?php echo $item['id']; ?>"
class="btn btn-shop">

View

</a>


</div>


</div>


</div>



<?php } ?>



</div>


</div>





<?php

include __DIR__ . "/includes/footer.php";

?>