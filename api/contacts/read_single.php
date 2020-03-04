<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Contacts.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate contact object
  $contact = new Contacts($db);

  // Get ID
  $contact->id = isset($_GET['id']) ? $_GET['id'] : die("ID is not provided");

  // Get contact
  $contact->read_single();

  // Create array
  $contact_arr = array(
    'id' => $contact->id,
    'name' => $contact->name,
    'contact_number' => $contact->contact_number,
    'contact_number2' => $contact->contact_number2,
    'contact_number3' => $contact->contact_number3
  );

  // Make JSON
  print_r(json_encode($contact_arr));