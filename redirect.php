<?php 
//Create DB connection
$host = 'localhost';
$dbname = 'url_shortener';
$port = '5432';
$username = 'postgres';
$password = 'aset';

//Creating a PDO DB Connection
try{
    $pdo = new
PDO("pgsql:host=$host;port=$port;dbname=$dbname;", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    #echo "Connected to Database Successfully";
} catch (PDOException $e){
    die("Could not Connect to the database: " . $e->getMessage());
}

//Get short code from URL
if(isset($_GET['code'])){
    $surl=$_GET['code'];

    //Retrieve original URL from DB
    $urlquery = $pdo->prepare("SELECT lurl FROM urls WHERE surl = :short_code");
    $urlquery->execute(['short_code' => $surl]);
    $result = $urlquery->fetch(PDO::FETCH_ASSOC);

    if($result){
        //redirecting to original URL
        $lurl = $result['lurl'];
        header("Location: $lurl");
        exit;
    }else{
        echo "Invalid URL";
    }
} else {
    echo "No short URL code provided!";

}
?>
