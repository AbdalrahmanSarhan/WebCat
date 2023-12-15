<?php session_start();
if (!isset($_SESSION['products'])) {
    include 'products.php';
    $_SESSION['products'] = $products;
}

// الاحتفاظ بأخر ثلاث منتجات تم البحث عنها
if (isset($_GET['search'])) {
    if (!isset($_COOKIE['one_product'])) {
        // تهيئة كوكيز المنتج الاول بالقيمة nothing
        setcookie('one_product', "nothing", time() + 86400, "/");
    } else if (!isset($_COOKIE['two_product'])) {
        // تهيئة كوكيز المنتج الثاني بالقيمة nothing
        setcookie('two_product', "nothing", time() + 86400, "/");
    } else if (!isset($_COOKIE['three_product'])) {
        // تهيئة كوكيز المنتج الثالث بالقيمة nothing
        setcookie('three_product', "nothing", time() + 86400, "/");
    } else {
        // تنفيذ مفهوم الرتل من اجل الاحتفاظ آخر ثلاث منتجات بحث عنها المستخدم
        $search = $_GET['search'] != "" ? $_GET['search'] : "nothing";
        setcookie('one_product', $_GET['search'], time() + 86400, "/");
        setcookie('two_product', $_COOKIE['one_product'], time() + 86400, "/");
        setcookie('three_product', $_COOKIE['two_product'], time() + 86400, "/");
    }
    header('location: ./index.php');
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <title>Products</title>
</head>
<style>
body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
}

.topnav {
    overflow: hidden;
    background-color: #333;
}

.topnav a {
    float: left;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
}

.topnav a:hover {
    background-color: #ddd;
    color: black;
}

.topnav a.active {
    background-color: #04AA6D;
    color: white;
}
</style>

<body>
    <!-- اخذ قائمة المفضلة من السيشن او التصريح عنها بمصفوفة فارغة -->
    <?php $favorite = $_SESSION['favorite'] ?? array()?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">Products</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./newProduct.php">Add Product</a>
                    </li>
                    <li class="nav-item">
                        <!-- طباعة عدد المنتجات في المفضلة في الهيدر -->
                        <a class="nav-link" href="./favorite.php">my Favorite ( <span style="color: red;">
                                <?=count($favorite)?> </span>)</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Display
                        </a>
                        <!-- عرض عدد المنتجات في الرئيسية عن الضغط على الرابط -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./index.php?count=15">15</a></li>
                            <li><a class="dropdown-item" href="./index.php?count=30">30</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="./index.php">all</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Size
                        </a>
                        <!-- قائمة البحث عن الحجم -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./index.php?size=small">small</a></li>
                            <li><a class="dropdown-item" href="./index.php?size=medium">medium</a></li>
                            <li><a class="dropdown-item" href="./index.php?size=large">large</a></li>
                            <li><a class="dropdown-item" href="./index.php?size=xLarge">xLarge</a></li>
                            <li><a class="dropdown-item" href="./index.php?size=xxLarge">xxLarge</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="./index.php">all</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search"
                        aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div id="body">
        <h3 style="text-align: center;"> We have these amazing prouject</h3>
        <h3 style="text-align: center;"> Last three search Products:</h3>
        <h6 style="text-align: center;">#1 : <?=$_COOKIE['one_product'] != "" ? $_COOKIE['one_product'] : "nothing"?>
        </h6>
        <h6 style="text-align: center;">#2 : <?=$_COOKIE['two_product'] != "" ? $_COOKIE['two_product'] : "nothing"?>
        </h6>
        <h6 style="text-align: center;">#3 :
            <?=$_COOKIE['three_product'] != "" ? $_COOKIE['three_product'] : "nothing"?></h6>

        <!-- https://getbootstrap.com/docs/4.0/components/card/ -->
        <div class="container">
            <div class="row">
            <?php
// الحصول على عدد المنتجات المطلوب للعرض في الصفحة من خلال الرابط اذا طلبه المستخدم والا ضعه -1
$count = isset($_GET['count']) ? $_GET['count'] : -1;
// الحصول على قياس المنتجات المطلوب للبحث عنه من خلال الرابط اذا طلبه المستخدم والا ضعه -1
$size = isset($_GET['size']) ? $_GET['size'] : -1;

$i = 1;
foreach ($_SESSION['products'] as $key => $value):
    // اذا تم الوصول للعدد المطلوب للعرض توقف
    if ($i > $count && $count != -1) {
        break;
    }
    // اذا المستخدم طلب قياس معين والمنتج الحالي ليس نفس القياس المطلوب انتقل على التالي
    if ($size != -1 &&   $_SESSION['products'][$key]['size'] != $size) {
        continue;
    }
    ?>

	                <div class="col-md-3 mb-2">
	                    <div class="card">
	                        <img class="card-img-top" height="200px" src="<?=$_SESSION['products'][$key]['image']?>"
	                            alt="Card image cap">
	                        <div class="card-body">
	                            <h6 class="card-title" style="font-weight: bold;color: green;">
	                                <?=$_SESSION['products'][$key]['name']?></h6>
	                            <a
	                                href="./index.php?size=<?=$_SESSION['products'][$key]['size']?>"><?=$_SESSION['products'][$key]['size']?></a>

	                            <p class="card-text">
	                                <?= substr($_SESSION['products'][$key]['paragraph'], 0, 50) . ' ....'?></p>
	                            <a href="add.php?id=<?=$_SESSION['products'][$key]['id']?>" class="btn btn-primary">Add to
	                                Favorite</a>
	                        </div>
	                    </div>
	                </div>
	                <?php $i++;

endforeach ?>
            </div>
        </div>
    </div>
</body>

</html>