<?php include_once("assets/header.php"); ?>
<?php include_once("assets/navbar.php"); ?>

<?php 

//  If is pressed add contact button in navbar 
if (isset($_POST["add_contact"])) {

    //Create array with data from input fields
  	$data = [
			'name' =>             $_POST['contact_name'],
			'contact_number' =>   $_POST['contact_number'],
			'contact_number2' =>  $_POST['contact_number2'],
			'contact_number3' =>  $_POST['contact_number3'] 
    ];
    
  //Create JSON from array
  $data_string = json_encode($data);

  $url = 'http://localhost/phpPhonebookRest/api/contacts/create.php';

  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                     'Content-Type: application/json',
                 'Content-Length: ' . strlen($data_string))
   );

  $result = curl_exec($curl);

  // Get information regarding a specific transfer
  $response = curl_getinfo($curl);

  if ($response['http_code'] === 200 || $response['http_code'] === 201) {

    //Redirect to index page
    header("Location:index.php");

  }

  //Close a cURL session
  curl_close ($curl);
}

?>

<div class="container">

  <div class="row mt-3">

  <div class="col-md-12">

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">

    <div class="form-group">
      <input type="text" name="contact_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter contact name" >
      
    </div>

    <div class="form-group">
      <input type="text" name="contact_number" class="form-control" id="exampleInputPassword1" placeholder="Mobile phone contact number">
      
    </div>

    <div class="form-group">
      <input type="text" name="contact_number2" class="form-control" id="exampleInputPassword1" placeholder="Fixed phone contact number">
    </div>

    <div class="form-group">
      <input type="text" name="contact_number3" class="form-control" id="exampleInputPassword1" placeholder="Business phone contact number">
    </div>

    <input type="submit" name="add_contact" class="btn btn-primary" value="Add Contact">
  </form>

  </div>

  </div>

</div>

<?php include_once("assets/footer.php"); ?>