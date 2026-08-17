<?php

include __DIR__ . "/includes/db.php";

include __DIR__ . "/includes/header.php";


if(isset($_POST['register'])){


    $name = $_POST['fullname'];

    $email = $_POST['email'];

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );


    // Check Email

    $check = $conn->query(
        "SELECT * FROM users WHERE email='$email'"
    );


    if($check->num_rows > 0){


        echo "

        <div class='container mt-5'>
        <div class='alert alert-danger'>
        Email already exists!
        </div>
        </div>

        ";


    }else{


        $sql = "

        INSERT INTO users
        (fullname,email,password)

        VALUES

        ('$name','$email','$password')

        ";


        if($conn->query($sql)){


            echo "

            <script>

            alert('Register Successfully');

            window.location='login.php';

            </script>

            ";


        }


    }


}

?>



<div class="container mt-5">


<div class="row justify-content-center">


<div class="col-md-5">


<div class="auth-box">


<h2 class="text-center mb-4">

Create Account

</h2>



<form method="POST">


<div class="mb-3">

<label>
Full Name
</label>

<input

type="text"

name="fullname"

class="form-control"

required>

</div>




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

name="register"

class="btn btn-primary w-100">

Register

</button>


</form>


</div>


</div>


</div>


</div>



<?php

include __DIR__ . "/includes/footer.php";

?>