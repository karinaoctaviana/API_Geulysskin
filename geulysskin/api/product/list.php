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

  // Blog post query
  $result = $pemesanan->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // Post array
    $pemesanan_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      
      $pemesanan_item = array(
        'Nama_Order' => $Nama_Order,
        'Jenis_Brand' => $Jenis_Brand,
        "Total_Barang" => $Total_Barang,
        'Harga' => $Harga

      );

      // Push to "data"
      array_push($pemesanan_arr, $pemesanan_item);
      // array_push($posts_arr['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($pemesanan_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }