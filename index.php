<?php

include __DIR__ . "/includes/db.php";

include __DIR__ . "/includes/header.php";

?>



<!-- =========================
     HERO SECTION
========================= -->

<section class="hero">

<div>

<h1>
Welcome to PhoneShop
</h1>


<p>
Latest Smartphones at Best Prices
</p>


<a href="products.php" class="btn btn-primary btn-shop">

Shop Now

</a>


</div>

</section>





<!-- =========================
     CATEGORIES
========================= -->

<div class="container mt-5">


<h2 class="section-title">
Popular Categories
</h2>


<div class="row">


<?php


$sql = "SELECT * FROM categories LIMIT 5";

$result = $conn->query($sql);


while($row = $result->fetch_assoc()){


?>


<div class="col-md-3 mb-4">


<div class="category-box">


<i class="fa-solid fa-mobile-screen"></i>


<h5>

<?php echo $row['category_name']; ?>

</h5>


<a href="products.php?category=<?php echo $row['id']; ?>">

View Phones

</a>


</div>


</div>


<?php } ?>


</div>

</div>






<!-- =========================
     FEATURED PRODUCTS
========================= -->


<div class="container mt-5">


<h2 class="section-title">
Latest Smartphones
</h2>


<div class="row">



<?php


$sql = "SELECT * FROM products LIMIT 6";


$result = $conn->query($sql);



while($product = $result->fetch_assoc()){


?>



<div class="col-md-4 mb-4">


<div class="product-card">



<img src="images/<?php echo $product['image']; ?>"
class="img-fluid">



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



<a href="product.php?id=<?php echo $product['id']; ?>"
class="btn btn-shop">

View Details

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