<?php
header("Access-Control-Allow-Origin: *");
$arr = null;
$con = '';
$con = new mysqli("localhost", "root", "", "kuremas");
if ($con->connect_error) {
    $arr = ["result" => "error", "message" => "unable to connect"];
}
$sql = "SELECT * FROM `masakan` INNER join resep ON masakan.id=resep.masakan_id";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$data = [];
if ($result->num_rows > 0) {
    while ($r = mysqli_fetch_assoc($result)) {
        array_push($data, $r);
    }
    $arr = ["result" => "success", "data" => $data];
} else {
    $arr = ["result" => "error", "message" => "sql error: $sql"];
}
echo json_encode($arr);
$stmt->close();
$con->close();
