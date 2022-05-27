<?php 
  class pemesanan {
    // DB stuff
    private $conn;
    private $table = 'pemesanan';

    // Paket Properties
    public $Id_Order_Order;
    public $Nama_Order;
    public $Jenis_Brand;
    public $Total_Barang;
    public $Harga;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get to Order
    public function read() {
      // Create query
      $query = 'SELECT * FROM ' . $this->table . ' ORDER BY Id_Order';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Data Order
    public function read_single() {
          // Create query
          $query = 'SELECT * FROM ' . $this->table . ' WHERE Id_Order = ?';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind Id_Order
          $stmt->bindParam(1, $this->Id_Order);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->Nama_Order = $row['Nama_Order'];
          $this->Jenis_Brand = $row['Jenis_Brand'];
          $this->Total_Barang = $row['Total_Barang'];
          $this->Harga = $row['Harga'];
    }

    // Order
    public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET Nama_Order = :Nama_Order, Jenis_Brand = :Jenis_Brand, Total_Barang = :Total_Barang, Harga = :Harga';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->Nama_Order = htmlspecialchars(strip_tags($this->Nama_Order));
        $this->Jenis_Brand = htmlspecialchars(strip_tags($this->Jenis_Brand));
        $this->Total_Barang = htmlspecialchars(strip_tags($this->Total_Barang));
        $this->Harga = htmlspecialchars(strip_tags($this->Harga));
    // Bind data
        $stmt->bindParam(':Nama_Order', $this->Nama_Order);
        $stmt->bindParam(':Jenis_Brand', $this->Jenis_Brand);
        $stmt->bindParam(':Total_Barang', $this->Total_Barang);
        $stmt->bindParam(':Harga', $this->Harga);

        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Update Order
    public function update() {
      // Create query
      $query = 'UPDATE ' . $this->table . '
                            SET Nama_Order = :Nama_Order, Jenis_Brand = :Jenis_Brand, Total_Barang = :Total_Barang, Harga = :Harga
                            WHERE Id_Order = :Id_Order';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->Nama_Order = htmlspecialchars(strip_tags($this->Nama_Order));
      $this->Jenis_Brand = htmlspecialchars(strip_tags($this->Jenis_Brand));
      $this->Total_Barang = htmlspecialchars(strip_tags($this->Total_Barang));
      $this->Harga = htmlspecialchars(strip_tags($this->Harga));
      $this->Id_Order = htmlspecialchars(strip_tags($this->Id_Order));

      // Bind data
      $stmt->bindParam(':Nama_Order', $this->Nama_Order);
      $stmt->bindParam(':Jenis_Brand', $this->Jenis_Brand);
      $stmt->bindParam(':Total_Barang', $this->Total_Barang);
      $stmt->bindParam(':Harga', $this->Harga);
      $stmt->bindParam(':Id_Order', $this->Id_Order);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Hapus Data Order
    public function delete() {
      // Create query
      $query = 'DELETE FROM ' . $this->table . ' WHERE Id_Order = :Id_Order';
     // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->Id_Order = htmlspecialchars(strip_tags($this->Id_Order));

      // Bind data
      $stmt->bindParam(':Id_Order', $this->Id_Order);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    } 

  }