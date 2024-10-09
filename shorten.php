<?php 
//Create DB connection
$host = 'localhost';
$dbname = 'url_shortener';
$port = '5433';
$username = 'postgres';
$password = 'aset';

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

//Function for generating Short URL 
function generateShortCode($length = 8): string
{
    return
    substr(str_shuffle("123456789#abcdefghilkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

//Using the POST method to send url request to server
if($_SERVER['REQUEST_METHOD']=='POST'){
    $lurl=$_POST['url'];

    //Check URL validity
    if(filter_var($lurl, FILTER_VALIDATE_URL)){
        $surl=generateShortCode();

        //Inserting Urls in to the PostgreSQL DB
        $urlquery=$pdo->prepare("INSERT INTO urls (lurl, surl) VALUES (:long_code, :short_code)");
        $urlquery->execute(['long_code' => $lurl, 'short_code' => $surl]);

        //Display Shortened URl
        echo "Shortened URL: <a 
        href='redirect.php?code=$surl
        </a>'";
    } else{
        echo "Invalid URL";
    }
}
?>