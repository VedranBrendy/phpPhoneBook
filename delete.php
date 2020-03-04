<?php 

// Get id from url
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    //Create array with data 
    $data = [

      'id' => $id

    ];
    //Create JSON from array
    $data_string = json_encode($data);

    $url = "http://localhost/phpPhonebookRest/api/contacts/delete.php";

    //Start  curl
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $results  = curl_exec($curl);

     $response = curl_getinfo($curl);

       if ($response['http_code'] === 200  OR $response['http_code'] === 201) {

      //Redirect to index page
      header("Location:index.php");

    } 

    curl_close($curl);


}


?>