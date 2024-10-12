<?php 

$fullname = $_POST["fullName"];
$username = $_POST["username"];
$password = $_POST["password"];
$confirmpassword = $_POST["confirmPassword"];

echo $username;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(trim($password) == trim($confirmpassword)){
        $host = "localhost";
        $database = "ecommerce";
        $dbusername = "root";
        $dbpassword = "";
        
        $dsn = "mysql: host=$host;dbname=$database;";
        try {
            $conn = new PDO($dsn, $dbusername, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $stmt = $conn->prepare('INSERT INTO users (fullname,username,password,created_at,updated_at)VALUES (:p_fullname, :p_username, :p_password,NOW(),NOW())');
            $stmt->bindParam(':p_fullname',$fullname);
            $stmt->bindParam(':p_username',$username);
            $stmt->bindParam(':p_password',$password);
            $stmt->execute();
            header("location: /registration.php?success=Registration Successful");
            
            echo"connection successful";
        } catch (Exception $e){
            echo "Connection Failed: " . $e->getMessage();
        }
        
    } else {
        header("location: /registration.php?error=Hey! Password not the same");
       exit;
    }

}

?>