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
