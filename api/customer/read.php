<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Customer.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog customer object
  $customer = new Customer($db);

  // Blog customer query
  $result = $customer->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any customers
  if($num > 0) {
    // customer array
    $customers_arr = array();
    // $customers_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $customer_item = array(
        'id' => $id,
        'name' => $name,
        'number' => $number,
        'category_id' => $category_id,
        'category_name' => $category_name
      );

      // Push to "data"
      array_push($customers_arr, $customer_item);
      // array_push($customers_arr['data'], $customer_item);
    }

    // Turn to JSON & output
    //echo http_build_query($customers_arr,' ',', ');
    echo json_encode($customers_arr);


  } else {
    // No customers
    echo json_encode(
      array('message' => 'No customers Found')
    );
  }
