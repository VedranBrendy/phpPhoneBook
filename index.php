<?php include_once("config/init.php");

//Read data for table 
if (!isset($_POST['search'])) {
 
    $url = "http://localhost/phpPhonebookRest/api/contacts/read.php";

    $curl = curl_init();
    curl_setopt ($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec ($curl);
    $response = curl_getinfo($curl);
    curl_close ($curl);

    $encode = json_decode($result);

  //  If is pressed  search button in navbar
} elseif (isset($_POST['search']) && !empty($_POST['search_field'])) {

    /* SEARCH */
  	$search_data = [

      's' => $_POST['search_field']

    ];

    $data_string = json_encode($search_data);

    $url = 'http://localhost/phpPhonebookRest/api/contacts/search.php';

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                      'Content-Type: application/json',
                  'Content-Length: ' . strlen($data_string))
    );

    $result = curl_exec($curl);
    $response = curl_getinfo($curl);

    if ($response['http_code'] === 201) {
      header("Location:index.php");
    }

    curl_close ($curl);

    $encode = json_decode($result);

}

?>
<div class="container">

    <?php 
    
      if ($response['http_code'] === 404 ) {

        echo "<h3>No contacts in PhoneBook</h3>";

      } else { 

    ?>

    <table class="table table-hover mt-3">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Mobile contact</th>
          <th scope="col">Phone contact</th>
          <th scope="col">Business contact</th>
          <th scope="col">Created</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

      <?php 
 
      foreach ($encode as $row) {

          ?>
            <tr>
              <th scope="row"><?php echo $row->name ?></th>
          
              <td>
                <?php echo isset($row->contact_number) ? '<h5><span class="badge badge-primary">'.numForm($row->contact_number).'</span></h5>' : '';  ?>
              </td>
                <td>
                  <?php echo isset($row->contact_number2) ? '<h5><span class="badge badge-secondary">'.numForm($row->contact_number2).'</span></h5>' : ''; ?>
                </td>
                <td>
                <?php echo isset($row->contact_number3) ? '<h5><span class="badge badge-success">'.numForm($row->contact_number3).'</span></h5>' : ''; ?>
                </td>
              
                <td><?php echo $row->created_at ?></td>
              <td>
              <a href="update.php?id=<?php echo $row->id; ?>" class="btn btn-sm btn-outline-warning">Edit</a>
              <a onclick="if(!confirm('Confirm deletion of contact!'))return false" href="delete.php?id=<?php echo $row->id; ?>" class="btn btn-sm btn-outline-danger">Delete</a>
              </td>
            </tr>

          <?php

        }

    }  
    
    ?>

    </tbody>
  </table> 
  
</div>

<?php include_once("assets/footer.php"); ?>