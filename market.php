<?php
$db = new PDO("mysql:host=127.0.0.1;dbname=market", "root", "");
function infoByVendor($db)
{
    $statement = $db->prepare("SELECT items.name, price, quantity, quality FROM items inner join vendors on FID_Vender = ID_Vendors WHERE Vendors.name=?");
    $statement->execute([$_POST["vendor"]]);
    $string = "";

    while ($data = $statement->fetch()) {
        $string .= " <br> Title: {$data['name']} ::: Price: {$data['price']} ::: Quantity: {$data['quantity']} ::: Qulity: {$data['quality']} ";
    }
    echo $string;
}

function infoByCategory($db)
{
    $statement = $db->prepare("SELECT items.name, price, quantity, quality, category.name as 'category' FROM items inner join Category on FID_Category = ID_Category WHERE Category.name=?");
    $statement->execute([$_POST["category"]]);
    $string = "";

    while ($data = $statement->fetch()) {
        $string .= " <br> Title: {$data['name']} ::: Price: {$data['price']} ::: Quantity: {$data['quantity']} ::: Qulity: {$data['quality']} ::: Category: {$data['category']}";
    }
    echo json_encode($string);
}

function infoByPrice($db)
{
    $statement = $db->prepare("SELECT items.name, price, quantity, quality FROM items WHERE price between ? and ?");
    $statement->execute([$_POST["min_price"], $_POST["max_price"]]);
    $string = "";

    while ($data = $statement->fetch()) {
        $string .= " <br> Title: {$data['name']} ::: Price: {$data['price']} ::: Quantity: {$data['quantity']} ::: Qulity: {$data['quality']} ";
    }
    echo $string;
}

if (isset($_POST["vendor"])) {
    infoByVendor($db);
} elseif (isset($_POST["category"])) {
    infoByCategory($db);
} elseif (isset($_POST["min_price"])) {
    infoByPrice($db);
}
