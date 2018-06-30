<?php
require 'chatbot/chatbot.php';
$chatbot = new ChatBot();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <title>MYBOT</title>
</head>
<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6  text-center ">
                <h1 class="display-4 py-5">My Bot</h1>
               <?=$chatbot->printChat()?>
            </div>
            <div class="col-md-6  text-center ">
                <h1 class="display-4 py-5">Q&A</h1>
                <?=$chatbot->printQaTable()?>
            </div>
        </div>
    </div>
    <script src="js/dom_access.js"></script>
</body>
</html>