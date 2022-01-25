<?php

const host="localhost";
const username="root";
const password="";
const dbname="book";

try{
$pdo=new PDO("mysql:host=".host.";dbname=".dbname,username,password);
}catch(Exception $e){
    echo "<strong>مشکلی در ارتباط وجود دارد</strong>";
}