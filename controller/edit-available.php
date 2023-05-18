<?php
// $_GET['id]
// select * from product where id = $_GET['id']





$old_val=$_GET['availaility'];

if($old_val=='available')
{
    $new_val='unavailable';
}
else
{
    $new_val='available';
}

$id=$_GET['id'];
include "../models/product.php";
$product=new Product();
$product->update_product($id,'availability',$new_val);
header("location:../views/product/products-table.php");
?>
