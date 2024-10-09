<?php 
//Create DB connection
$host = 'localhost';
$dbname = 'url_shortener';
$port = '5433';
$username = 'postgres';
$password = '';

//Creating a PDO DB Connection
try{
    $pdo = new
PDO("pgsql:host=$host;port=$port;dbname=$dbname;", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to Database Successfully";
} catch (PDOException $e){
    die("Could not Connect to the database: " .
    $e->getMessage());
}

//Get short code from URL
if(isset($_GET['url'])){
    $surl=$_GET['url'];

    //Retrieve original URL from DB
    $urlquery=$pdo->prepare("SELECT lurl FROM url_shortener WHERE surl = :short_code");
    $urlquery->execute([':short_code' => $surl]);
    $result=$urlquery->fetch(PDO::FETCH_ASSOC);

    if($result){
        //redirecting to original URL
        header('Location:'.$result['lurl']);
        exit();
    }else{
        echo "Invalid URL";
    }

}
?>