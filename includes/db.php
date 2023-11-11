<?php


$connection = mysqli_connect('localhost', 'puugoo', '1303PuuNRR!', 'cms');

if (!$connection) {

    die("DB connected Failed" . mysqli_connect($connection));
}
