



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>mail</h1>
    <?php 
    $subject="my subject";
    $message="Your message";
    $recipient="12shubhamgupta1999@gmail.com";
    mail($recipient,$subject,$message);
    ?>
</body>
</html>