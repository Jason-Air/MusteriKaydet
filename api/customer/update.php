<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Customer.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog customer object
  $customer = new Customer($db);

  // Get raw customered data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $customer->id = $data->id;

  $customer->name = $data->name;
  $customer->number = $data->number;
  $customer->category_id = $data->category_id;

  // Update customer
  if($customer->update()) {
    echo json_encode(
      array('message' => 'Customer Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Customer Not Updated')
    );
  }

