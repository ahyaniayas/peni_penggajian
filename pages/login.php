<?php
session_start();
include 'koneksi.php';

$username=$_POST['username'];
$password=$_POST['password'];

$data[] = $username;
$data[] = $password;

$sql = "SELECT * FROM user WHERE username=? and password=?";
$row = $koneksi -> prepare($sql);
$row -> execute($data);

$jml = $row -> rowcount();

if($jml > 0){
    // Jika Berhasil
    $isi = $row->fetch(PDO::FETCH_OBJ);      
    $_SESSION['username']=$isi->username;
    $_SESSION['password']=$isi->password;
    $_SESSION['level']=$isi->level;

    echo "<script>
    location='index.php?username=".$username."';</script>";
}else{
    // Jika Gagal
    echo "<script> alert ('username atau password salah');
    location='../index.php';</script>";
}

?>