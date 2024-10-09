<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title style="color:#0047AB; font: size: 25px;"><strong>Shortening Service</strong></title>
</head>
<body>
    <h1 style="color:#0047AB; font: size: 25px; text-align: center"><strong>ASE URL Shortening Service</strong></h1>
    <form action="shorten.php" method="POST">
        <label style="font-size: 22px;" for="url"><strong>Enter URL</strong></label>
        <input type="text" name="url" id="url" required>  <br>
        <button style="animation: ease-in; background-color: darkorange; font-style: oblique; font-size: 18px;
        color: #071d86" type="submit"><strong>Shorten</strong></button>
    </form>
</body>
</html>