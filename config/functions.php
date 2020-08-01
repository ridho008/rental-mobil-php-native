<?php
// koneksi
$conn = new mysqli("localhost", "root", "", "rental_mobil") or die(mysqli_error($conn));

// fungsi base_url
function base_url($url = null)
{
  $base_url = "http://localhost/rental-mobil-php-native/";
  if($url != null) {
    return $base_url . $url;
  } else {
    return $base_url;
  }
}

function register($data)
{
  global $conn;
  $nama = htmlspecialchars(strtolower($data['nama']));
  $username = htmlspecialchars(strtolower($data['username']));
  $password1 = $conn->real_escape_string($data['password1']);
  $password2 = $conn->real_escape_string($data['password2']);
  $jk = htmlspecialchars(strtolower($data['jk']));

  if($password1 != $password2) {
    echo "<script>alert('Konfirmasi password tidak sama!');window.location='register.php';</script>";
    return false;
  }

  if(empty($nama && $username && $password1 && $password2 && $jk)) {
    echo "<script>alert('Inputan tidak boleh kosong!');window.location='register.php';</script>";
    return false;
  }

  $password_hash = password_hash($password1, PASSWORD_DEFAULT);
  $query = $conn->query("INSERT INTO tb_user VALUES(null, '$nama', '$username', '$password_hash', '$jk', '2' )");
  return $conn->affected_rows;
}



// ------------------ADMIN-------------------------


function tambahuser($data)
{
  global $conn;
  $nama = htmlspecialchars(strtolower($data['nama']));
  $username = htmlspecialchars(strtolower($data['username']));
  $password = $conn->real_escape_string($data['password']);
  $jk = htmlspecialchars(strtolower($data['jk']));

  if(empty($nama && $username && $password && $jk)) {
    echo "<script>alert('Inputan tidak boleh kosong!');window.location='?p=user';</script>";
    return false;
  }

  $password_hash = password_hash($password, PASSWORD_DEFAULT);
  $query = $conn->query("INSERT INTO tb_user VALUES(null, '$nama', '$username', '$password_hash', '$jk', '2' )");
  return $conn->affected_rows;
}

function ubahuser($data)
{
  global $conn;
  $id_user = htmlspecialchars($data['id']);
  $nama = htmlspecialchars(strtolower($data['nama']));
  $username = htmlspecialchars(strtolower($data['username']));
  $password = $conn->real_escape_string($data['password']);
  $jk = htmlspecialchars(strtolower($data['jk']));

  // if(empty($nama && $username && $password && $jk)) {
  //   echo "<script>alert('Inputan tidak boleh kosong!');window.location='?p=user';</script>";
  //   return false;
  // }

  $password_hash = password_hash($password, PASSWORD_DEFAULT);
  $query = $conn->query("UPDATE tb_user SET nama_user = '$nama', username = '$username', password = '$password_hash', jk_user = '$jk', level = '2' WHERE id_user = $id_user ") or die(mysqli_error($conn));
  return $conn->affected_rows;
}



// -------------------MOBIL-----------------------

function tambahmobil($data)
{
  global $conn;
  $polisi = htmlspecialchars($data['polisi']);
  $merk = htmlspecialchars($data['merk']);
  $tahun = htmlspecialchars($data['tahun']);
  $hrg_mobil = htmlspecialchars($data['hrg_mobil']);

  if(empty($polisi && $merk && $tahun && $hrg_mobil)) {
    echo "<script>alert('Inputan tidak boleh kosong!');window.location='?p=mobil';</script>";
    return false;
  }

  $sqlMobil = $conn->query("INSERT INTO tb_mobil VALUES (null, '$polisi', '$merk', '$tahun', '$hrg_mobil', 'Aktif')") or die(mysqli_error($conn));
  return $conn->affected_rows;
}

function ubahmobil($data)
{
  global $conn;
  $id_mobil = htmlspecialchars($data['id']);
  $polisi = htmlspecialchars($data['polisi']);
  $merk = htmlspecialchars($data['merk']);
  $tahun = htmlspecialchars($data['tahun']);
  $hrg_mobil = htmlspecialchars($data['hrg_mobil']);

  if(empty($polisi && $merk && $tahun && $hrg_mobil)) {
    echo "<script>alert('Inputan tidak boleh kosong!');window.location='?p=mobil';</script>";
    return false;
  }

  $sqlMobil = $conn->query("UPDATE tb_mobil SET no_polisi = '$polisi', merk = '$merk', tahun = '$tahun', hrg_mobil = '$hrg_mobil' WHERE id_mobil = $id_mobil") or die(mysqli_error($conn));
  return $conn->affected_rows;
}