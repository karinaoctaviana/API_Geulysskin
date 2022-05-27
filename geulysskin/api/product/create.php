<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/pemesanan.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $pemesanan = new pemesanan($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $pemesanan->Nama_Order = $data->Nama_Order;
  $pemesanan->Jenis_Brand = $data->Jenis_Brand;
  $pemesanan->Total_Barang = $data->Total_Barang;
  $pemesanan->Harga = $data->Harga;

  // Create post
  if($pemesanan->create()) {
    echo json_encode(
      array('message' => 'pemesanan Created')
    );
  } else {
    echo json_encode(
      array('message' => 'pemesanan Not Created')
    );
  }
