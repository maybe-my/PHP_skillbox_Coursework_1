<?php

include 'db.php';
// If upload button is clicked ...
if (isset($_FILES["product-photo"])) {

    $filename = $_FILES["product-photo"]["name"];
    $tempname = $_FILES["product-photo"]["tmp_name"];
    $folder = "tovarsImages/" . $filename;

    // Now let's move the uploaded image into the folder: image
    if (!move_uploaded_file($tempname, $folder)) {
        $msg = "Failed to upload image";
    }

    $data = [
        "name" => $_POST["product-name"],
        "price" => $_POST["product-price"],
        "category" => $_POST['product-category'],
        "new" => $_POST['product-new'],
        "sale" => $_POST['product-sale'],
        "image" => $filename
    ];
    $sql = 'INSERT INTO tovars (name, price,category, is_new, is_sale,image) VALUES ("' . $data['name'] . '", 
        "' . $data['price'] . '",  
        "' . $data['category'] . '",
        "' . $data['new'] . '",
        "' . $data['sale'] . '",
        "' . $data['image'] . '")';

    if (!$connect->query($sql) === TRUE) {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }

}


mysqli_close($connect);
echo "good";


// Test upload

//if ( 0 < $_FILES['file']['error'] ) {
//    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
//}
//else {
//    move_uploaded_file($_FILES['file']['tmp_name'], 'tovarsImages/' . $_FILES['file']['name']);
//    echo 'Успешно: ' . $_POST['name'] ;
//}