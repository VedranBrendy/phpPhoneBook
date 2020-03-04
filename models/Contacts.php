<?php 
  class Contacts {
    // DB stuff
    private $conn;
    private $table = 'contacts';

    // Contact Properties
    public $id;
    public $name;
    public $created_at;
    public $contacts_id;
    public $contact_number;
    public $contact_number2;
    public $contact_number3;
    public $s;

 

    // Constructor
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Contacts
    public function read() {
      // Create query
      $query = 'SELECT contacts.id, name, created_at, contacts_id, contact_number,contact_number2,contact_number3 FROM contacts
                INNER JOIN contacts_numbers
                ON contacts.id = contacts_numbers.contacts_id'; 


      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
        // Get Single Contact
    public function read_single() {
          // Create query
          $query = 'SELECT contacts.id, name, created_at, contacts_id, contact_number,contact_number2,contact_number3 FROM contacts
                    INNER JOIN contacts_numbers
                    ON contacts.id = contacts_numbers.contacts_id
                    WHERE contacts.id = :id
                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(':id', $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->name = $row['name'];
          $this->contact_number = $row['contact_number'];
          $this->contact_number2 = $row['contact_number2'];
          $this->contact_number3 = $row['contact_number3'];
    }



    // Create Contact
    public function create() { 

        // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET name = :name';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->name = htmlspecialchars(strip_tags($this->name));

          // Bind data
          $stmt->bindParam(':name', $this->name);

          // Execute query
          if($stmt->execute()) {

           $last_id = $this->conn->lastInsertId();

            $query = 'INSERT INTO contacts_numbers SET contacts_id = '.$last_id.', contact_number = :contact_number, 
            contact_number2 = :contact_number2, contact_number3 = :contact_number3';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->contact_number   =  htmlspecialchars(strip_tags($this->contact_number));
            $this->contact_number2  =  htmlspecialchars(strip_tags($this->contact_number2));
            $this->contact_number3  =  htmlspecialchars(strip_tags($this->contact_number3));

            $stmt->bindParam(':contact_number', $this->contact_number);
            $stmt->bindParam(':contact_number2', $this->contact_number2);
            $stmt->bindParam(':contact_number3', $this->contact_number3);

              if($stmt->execute()) {

          return true;
              }
        
     }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Contact
    public function update() {
          // Create query
          $query = 'UPDATE contacts, contacts_numbers
                    SET contacts.name = :name, contact_number = :contact_number, 
                    contact_number2 = :contact_number2, contact_number3 = :contact_number3
                    WHERE contacts.id = :id AND contacts.id = contacts_numbers.contacts_id'; 

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));                 
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->contact_number = htmlspecialchars(strip_tags($this->contact_number));
          $this->contact_number2 = htmlspecialchars(strip_tags($this->contact_number2));
          $this->contact_number3 = htmlspecialchars(strip_tags($this->contact_number3));

          // Bind data
          $stmt->bindParam(':id', $this->id);
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':contact_number', $this->contact_number);
          $stmt->bindParam(':contact_number2', $this->contact_number2);
          $stmt->bindParam(':contact_number3', $this->contact_number3);

          // Execute query
          if($stmt->execute()) {

              return true; 
            
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Contact
    public function delete() {
          // Create query
          $query = 'DELETE contacts, contacts_numbers
          FROM contacts
          LEFT JOIN contacts_numbers
          ON contacts_numbers.contacts_id = contacts.id
          WHERE contacts.id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

       // Get Contacts
    public function search() {
      // Create query
      $query = "SELECT contacts.id, name, created_at, contacts_id, contact_number,contact_number2,contact_number3 FROM contacts
                INNER JOIN contacts_numbers
                ON contacts.id = contacts_numbers.contacts_id
                WHERE name LIKE '%".$this->s."%'"; 


      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
    
  }