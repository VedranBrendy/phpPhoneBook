<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Contacts.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate contact object
  $contact = new Contacts($db);

  // Get raw contacted data
  $data = json_decode(file_get_contents("php://input"));

  //Insert data for testing
 /*  file_put_contents('file.txt', print_r($data, true)); */

 if(!empty($data->name)){

    // set contact property values
    $contact->id              = $data->id;
    $contact->name            = $data->name; 
    $contact->contact_number  = $data->contact_number;
    $contact->contact_number2 = $data->contact_number2; 
    $contact->contact_number3 = $data->contact_number3;
  //Insert data in txt file for testing
/*     $datas = [
      "id"=>$data->id,
      "name"=>$data->name,
      "con"=>$data->contact_number,
      "con2"=>$data->contact_number2,
      "con3"=>$data->contact_number3
  ];

  file_put_contents('file.txt', print_r($datas, true)); */

    // create the contact
    if($contact->update()){


        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Contact updated."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create contact."));
    }
}
 
// tell the user data is incomplete
else {
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create contact. Data is incomplete."));
}