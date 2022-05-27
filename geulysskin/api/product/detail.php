<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/pemesanan.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $pemesanan = new pemesanan($db);

  // Get Id_Order
  $pemesanan->Id_Order = isset($_GET['Id_Order']) ? $_GET['Id_Order'] : die();

  // Get post
  $pemesanan->read_single();

  // Create array
  $pemesanan_arr = array(
    'Nama_Order' => $pemesanan->Nama_Order,
    'Jenis_Brand' => $pemesanan->Jenis_Brand,
    'Total_Barang' => $pemesanan->Total_Barang,
    'Harga' => $pemesanan->Harga
  );

  // Make JSON
  print_r(json_encode($pemesanan_arr));