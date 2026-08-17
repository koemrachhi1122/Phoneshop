<?php

include __DIR__ . "/includes/db.php";

include __DIR__ . "/includes/header.php";

?>



<div class="container mt-5">


<h2 class="text-center mb-4">
All Smartphones
</h2>



<!-- SEARCH -->

<form method="GET" class="mb-4">


<div class="input-group">


<input 
type="text" 
name="search" 
class="form-control"
placeholder="Search phone..."
>


<button class="btn btn-primary">

<i class="fa fa-search"></i>
Search

</button>


</div>


</form>





<div class="row">



<?php


// Default Query

$sql = "SELECT * FROM products";



// Search

if(isset($_GET['search'])){


$search = $_GET['search'];


$sql = "SELECT * FROM products 
WHERE product_name LIKE '%$search%'";


}



// Category Filter

if(isset($_GET['category'])){


$category = $_GET['category'];


$sql = "SELECT * FROM products 
WHERE category_id='$category'";


}



$result = $conn->query($sql);



if($result->num_rows > 0){



while($product = $result->fetch_assoc()){


?>



<div class="col-md-4 mb-4">



<div class="product-card">



<img 
src="images/<?php echo $product['image']; ?>"
class="img-fluid"
>



<div class="card-body">



<h5 class="product-name">

<?php echo $product['product_name']; ?>

</h5>




<p>

<?php echo $product['description']; ?>

</p>



<p class="price">

$<?php echo $product['price']; ?>

</p>



<a 
href="product.php?id=<?php echo $product['id']; ?>"
class="btn btn-shop">

View Details

</a>



<a 
href="cart.php?add=<?php echo $product['id']; ?>"
class="btn btn-success">

<i class="fa fa-cart-plus"></i>

</a>



</div>


</div>


</div>



<?php


}


}else{


echo "

<div class='alert alert-warning text-center'>

No products found

</div>

";


}



?>


</div>


</div>



<?php

include __DIR__ . "/includes/footer.php";

?>