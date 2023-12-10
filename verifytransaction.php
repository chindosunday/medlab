<?php
$ref = $_GET['ref'];



$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($ref),
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
var_dump($response);
die($ref);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
    $result = json_decode($response);
}
if ($result->data->status == 'success') {
    $status = $result->data->status;
    $reference = $result->data->reference;
    $lname = $result->data->customer->last_name;
    $fname = $result->data->customer->first_name;
    $email = $result->data->customer->email;

    $date_default =  date("Y-m-d H:i:s");

    $sql = "insert into transactions( email, status, transactionReference,createdAt) values(:em, :st, :tf, :ca )";
    $stmt = $conn->prepare($sql);
    //Insert Data to payment Data
    $stmt->bindValue(":em", $email);
    $stmt->bindValue(":st", $status);
    $stmt->bindValue(":tf", $reference);
    $stmt->bindValue(":ca", $date_default);

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
