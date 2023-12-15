<?php
session_start();
include 'products.php';

$_SESSION['products'] = $products;
//استقبال المعلومات من المستخدم
if (isset($_POST['newProduct'])) {
    $Id = $_POST['Id'];
    $Name = $_POST['Name'];
    $Size = $_POST['Size'];
    $Image = $_POST['Image'];
    $Paragraph = $_POST['Paragraph'];
    //اضافة المعلومات الى السيشن 
    $all_products = $_SESSION['products'];

    $new_product = array(); // انشاء array جديدة
    //تجهيز المنتج ضمن array
    $new_product['id'] = $Id;
    $new_product['name'] = $Name;
    $new_product['size'] = $Size;
    $new_product['image'] = $Image;
    $new_product['paragraph'] = $Paragraph;
    $all_products = [$new_product, ...$all_products]; //دمج مصفوفتين ++new
    

    $_SESSION['products'] = $all_products;

    header('Location: index.php');

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container" style="padding-top: 100px;padding-bottom: 100px;">
        <div class="row" style="justify-content: center;display: flex;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>New Product</h4>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Id">Id</label>
                                <input type="text" name="Id" id="Id" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="Name">Name</label>
                                <input type="text" name="Name" id="Name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="Size">Size</label>
                                <input type="text" name="Size" id="Size" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="Image">Image</label>
                                <input type="text" name="Image" id="Image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="Paragraph">Paragraph</label>
                                <input type="text" name="Paragraph" id="Paragraph" class="form-control">
                            </div>
                            <div class="form-group">
                                <br>
                                <button type="submit" name="newProduct" class="btn btn-success">Add</button>
                                <a class="btn btn-primary" href="index.php">go to home</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>