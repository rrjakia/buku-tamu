<?php

require_once('koneksi.php');

function query($query)
{
    global $koneksi;

    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query error: " . mysqli_error($koneksi));
    }

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}


function tambah_tamu($data)
{
    global $koneksi;

    $query = mysqli_query(
        $koneksi,
        "SELECT MAX(id_tamu) AS kodeTerbesar FROM buku_tamu"
    );

    $dataTerbesar = mysqli_fetch_assoc($query);

    if ($dataTerbesar['kodeTerbesar'] == null) {
        $kode = 1;
    } else {
        $kode = $dataTerbesar['kodeTerbesar'] + 1;
    }

    $tanggal = date("Y-m-d");

    $nama_tamu = htmlspecialchars($data["nama_tamu"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $bertemu = htmlspecialchars($data["bertemu"]);
    $kepentingan = htmlspecialchars($data["kepentingan"]);

    $query = "INSERT INTO buku_tamu
              (id_tamu, tanggal, nama_tamu, alamat, no_hp, bertemu, kepentingan)
              VALUES
              ('$kode', '$tanggal', '$nama_tamu', '$alamat', '$no_hp', '$bertemu', '$kepentingan')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


// function tambah data user
function tambah_user($data)
{
    global $koneksi;

    // mengambil data user dari tabel dengan kode terbesar
    $query = mysqli_query(
        $koneksi,
        "SELECT MAX(id_user) AS kodeTerbesar FROM users"
    );

    $dataTerbesar = mysqli_fetch_assoc($query);
    $kodeuser = $dataTerbesar['kodeTerbesar'];

    // mengambil angka dari kode user terbesar
    $urutan = (int) substr($kodeuser, 3, 2);

    // nomor yang diambil ditambah 1
    $urutan++;

    // membuat kode user baru
    $huruf = "usr";
    $kodeuser = $huruf . sprintf("%02s", $urutan);

    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $user_role = htmlspecialchars($data["user_role"]);

    $query = "INSERT INTO users
              (id_user, username, password, user_role)
              VALUES
              ('$kodeuser', '$username', '$password', '$user_role')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


// function ubah data tamu
function ubah($data)
{
    global $koneksi;

    $id = htmlspecialchars($data["id_tamu"]);
    $nama_tamu = htmlspecialchars($data["nama_tamu"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $bertemu = htmlspecialchars($data["bertemu"]);
    $kepentingan = htmlspecialchars($data["kepentingan"]);

    $query = "UPDATE buku_tamu SET
                nama_tamu = '$nama_tamu',
                alamat = '$alamat',
                no_hp = '$no_hp',
                bertemu = '$bertemu',
                kepentingan = '$kepentingan'
              WHERE id_tamu = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


// function hapus data tamu
function hapus_tamu($id)
{
    global $koneksi;

    $query = "DELETE FROM buku_tamu WHERE id_tamu = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


// function ubah data user
function ubah_user($data)
{
    global $koneksi;

    $kode         = htmlspecialchars($data["id_user"]);
    $username     = htmlspecialchars($data["username"]);
    $user_role    = htmlspecialchars($data["user_role"]);

    $query = "UPDATE users SET
                username    = '$username',
                user_role   = '$user_role'
              WHERE id_user = '$kode'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


// function hapus data user
function hapus_user($id)
{
    global $koneksi;

    $query = "DELETE FROM users WHERE id_user = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


function ganti_password($data)
{
    global $koneksi;

    $kode          = htmlspecialchars($data["id_user"]);
    $password      = htmlspecialchars($data["password"]);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE users SET
                password = '$password_hash'
              WHERE id_user = '$kode'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
