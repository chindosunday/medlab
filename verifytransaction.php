<?php
require_once('classes/dbconnection.php');
$newobject = new Db();
$conn = $newobject->connect();

$ref = $_GET['ref'];



$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/$ref",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer sk_test_ea9d05341b50f4502a4f419e48787810a555c6ad",
        "Cache-Control: no-cache",
    ),
));




$response = curl_exec($curl);
//var_dump($response);
//die($ref);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    //echo $response;
    $result = json_decode($response);
}
if ($result->data->status == 'success') {
    $status = $result->data->status;


    $reference = $result->data->reference;
    //$fname = $result->data->customer->first_name;
    //$lname = $result->data->customer->last_name;
    $email = $result->data->customer->email;
    $amount = $result->data->amount;

    // $date_default =  date("Y-m-d H:i:s");

    $sql = "insert into transactions( amount, status, reference, email) values(:am, :st, :rf, :em )";
    $stmt = $conn->prepare($sql);
    //Insert Data to payment Data
    $stmt->bindValue(":am", $amount);
    $stmt->bindValue(":st", $status);
    $stmt->bindValue(":rf", $reference);
    $stmt->bindValue(":em", $email);

    $stmt->execute();
    if (!$stmt) {
        echo "Error Query Failed ";
    } else {

        header("Location:success.php?status=success");
        exit;
    }
} else {
    header("Location:error.php");
}

$sql = "SELECT  users.first_name, users.last_name, transactions.amount, transactions.date FROM 
users JOIN transactions ON users.email = transactions.email where users.email = '?";
