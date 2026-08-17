<?php

session_start();

include __DIR__ . "/includes/db.php";

include __DIR__ . "/includes/header.php";



if(isset($_POST['login'])){


$email = $_POST['email'];

$password = $_POST['password'];



$result = $conn->query(

"SELECT * FROM users WHERE email='$email'"

);



if($result->num_rows > 0){


$user = $result->fetch_assoc();



if(password_verify($password,$user['password'])){


$_SESSION['user'] = $user;



if($user['role']=="admin"){


header("Location: admin/dashboard.php");


}else{


header("Location: index.php");


}


exit();



}else{


$error="Wrong Password";


}



}else{


$error="User not found";


}


}


?>



<div class="container mt-5">


<div class="row justify-content-center">


<div class="col-md-5">


<div class="auth-box">


<h2 class="text-center">

Login

</h2>



<?php

if(isset($error)){

echo "

<div class='alert alert-danger'>

$error

</div>

";

}

?>



<form method="POST">


<div class="mb-3">

<label>
Email
</label>


<input

type="email"

name="email"

class="form-control"

required>


</div>



<div class="mb-3">

<label>
Password
</label>


<input

type="password"

name="password"

class="form-control"

required>


</div>




<button

name="login"

class="btn btn-success w-100">

Login

</button>


</form>


</div>


</div>


</div>


</div>




<?php

include __DIR__ . "/includes/footer.php";

?>