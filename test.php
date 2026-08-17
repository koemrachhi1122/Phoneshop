<?php
include __DIR__ . '/includes/db.php';

if($conn){
    echo "<h2 style='color:green'>Database Connected Successfully!</h2>";
}else{
    echo "<h2 style='color:red'>Connection Failed!</h2>";
}
?>