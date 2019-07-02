<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Customer.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog customer object
  $customer;

  // Get raw customered data
  $data = json_decode(file_get_contents("php://input"));
  $sonuc=array();

  foreach($data as $d){
    $customer = new Customer($db);
    $customer->name = $d->name;
    $customer->number = $d->number;
    $customer->category_id = $d->category_id;

    // Create customer
    if($customer->create()) {
      
      array_push($sonuc, array('message' => $d->name . ' Customer Created'));
      
    } else {
      array_push($sonuc, array('message' => $d->name . ' Customer Not Created'));
    }
  }

  echo json_encode($sonuc);