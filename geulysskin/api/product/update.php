<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
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

  // Set ID to update
  $pemesanan->Id_Order = $data->Id_Order;
  $pemesanan->Nama_Order = $data->Nama_Order;
  $pemesanan->Jenis_Brand = $data->Jenis_Brand;
  $pemesanan->Total_Barang = $data->Total_Barang;
  $pemesanan->Harga = $data->Harga;

  // Update pemesanan
  if($pemesanan->update()) {
    echo json_encode(
      array('message' => 'pemesanan Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'pemesanan Not Updated')
    );
  }