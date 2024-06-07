<?php
$a[] = "Egg Noodles";
$a[] = "Egg FriedRice";
$a[] = "Double Egg FriedRice";
$a[] = "Chicken Noodles";
$a[] = "Chicken FriedRice";
$a[] = "Double Egg Chicken FriedRice";
$a[] = "Chicken Manchuria";
$a[] = "Veg Manchuria";
$a[] = "Veg Noodles";
$a[] = "Veg FriedRice";
$a[] = "Veg Manchurian FriedRice";
$a[] = "Pepsi";
$a[] = "Mountain Due";
$a[] = "Badam Milk";
$a[] = "Water";
$a[] = "Thumpsup";
$a[] = "Chicken Roll";
$a[] = "Egg Roll";
$a[] = "Paneer Roll";
$a[] = "Parata";
$a[] = "Chicken Dum Biryani";
$a[] = "Veg Biryani";
$a[] = "Egg Biryani";
$a[] = "Chicken FriedPiece Biryani";

$q = $_REQUEST["q"];

$hint = "";

if($q !== ""){
    $q = strtolower($q);
    $len = strlen($q);
    foreach($a as $name){
        if(stristr($q, substr($name, 0, $len))){
            if($hint === ""){
                $hint = $name;
            }else{
                $hint .= ", $name";
            }
        }
    }
}

echo $hint === ""? "no suggestion" : $hint;         
?>