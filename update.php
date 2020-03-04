<?php include_once("config/init.php"); ?>
<?php

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $curl = curl_init();
    curl_setopt ($curl, CURLOPT_URL, "http://localhost/phpPhonebookRest/api/contacts/read_single.php?id=$id");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $results = curl_exec ($curl);
    curl_close ($curl);


   $row = json_decode($results);


}

//  If is pressed update button 
if(isset($_POST['update_contact'])){

  	$data = [
      'id' =>               $_POST['id'],
			'name' =>             $_POST['name'],
			'contact_number' =>   $_POST['contact_number'],
			'contact_number2' =>  $_POST['contact_number2'],
			'contact_number3' =>  $_POST['contact_number3'] 
    ];

    $data_string = json_encode($data);

    $url = 'http://localhost/phpPhonebookRest/api/contacts/update.php';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string))
    );
    $result = curl_exec($ch);
    $response = curl_getinfo($ch);


    if ($response['http_code'] === 200  OR $response['http_code'] === 201) {
    header("Location:index.php");
    } 

    curl_close ($curl);
}

?>


<div class="container">

<div class="row mt-3">

<div class="col-md-12">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">

    <input type="hidden" name="id" value="<?php echo $id; ?>">

  <div class="form-group">
    <input type="text" name="name" class="form-control" value="<?php echo $row->name; ?>" aria-describedby="emailHelp" placeholder="Enter contact name" >
  </div>

  <div class="form-group">
    <input type="text" name="contact_number" class="form-control" value="<?php echo $row->contact_number; ?>" placeholder="Mobile phone contact number">
  </div>

   <div class="form-group">
    <input type="text" name="contact_number2" class="form-control" value="<?php echo $row->contact_number2; ?>" placeholder="Fixed phone contact number">
  </div>

   <div class="form-group">
    <input type="text" name="contact_number3" class="form-control" value="<?php echo $row->contact_number3; ?>" placeholder="Business phone contact number">
  </div>

  <input type="submit" name="update_contact" class="btn btn-warning" value="Update Contact">
</form>
</div>


</div>

</div>

<?php include_once("assets/footer.php"); ?>