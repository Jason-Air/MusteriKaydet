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

  // Get ID
  $customer->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get customer
  $customer->read_single();

  // Create array
  $customer_arr = array(
    'id' => $customer->id,
    'name' => $customer->name,
    'number' => $customer->number,
    'category_id' => $customer->category_id,
    'category_name' => $customer->category_name
  );

  // Make JSON
  print_r(json_encode($customer_arr));