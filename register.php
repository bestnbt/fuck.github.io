<?php
$servername = "localhost";
$username = "cs_100lol_sbs"; // 宝塔面板默认数据库用户名
$password = "W8xD7ctywGZzMJBh"; // 设置的数据库密码
$dbname = "cs_100lol_sbs";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);
$username = $conn->real_escape_string($data['username']);
$password = password_hash($data['password'], PASSWORD_DEFAULT);

$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "用户名已存在"]);
} else {
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "注册失败"]);
    }
}

$conn->close();
?>
