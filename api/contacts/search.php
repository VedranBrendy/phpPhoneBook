<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Contacts.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog contact object
  $contact = new Contacts($db);

   // Get raw contacted data
  $data = json_decode(file_get_contents("php://input"));


  // Get deta
  $contact->s = $data->s;


  // Contact query
  $result = $contact->search();

  $num = $result->rowCount();

  // Check if any contacts
  if($num > 0) {

    // contact array
    $contacts_arr = [];


    while($row = $result->fetch(PDO::FETCH_ASSOC)) {

      extract($row);

      $contact_item = [
        'id' => $id,
        'contact_number' => $contact_number,
        'contact_number2' => $contact_number2,
        'contact_number3' => $contact_number3,
        'name' => $name,
        'created_at' => $created_at
      ];

      // Push data in array
      array_push($contacts_arr, $contact_item);

    }

    // Turn to JSON & output
    echo json_encode($contacts_arr);

  } else {

    // No contacts
    http_response_code(404);

    echo json_encode(

      array('message' => 'No contacts Found')
      
    );
  }