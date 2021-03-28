<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="./styles/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <title>Connexion</title>
</head>

<body>
    <style>
        body {
            height: 100vh;
            background-image: linear-gradient(to right top, #64fd9c, #4d1db3);
        }

        .formulaire .form-control {
            height: 40px;
            border-radius: 10px;
        }

        .formulaire .form-control:focus {
            box-shadow: #4d1db3;
        }
    </style>

    <div class="navigation">
        <?php
        include "nav.php";
        ?>
    </div>
    <div class="formulaire">
        <?php
        include "form.php";
        ?>
    </div>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $("#pwdRules").hide();
        });
    </script>

    <script src="./js/frontEndPwdValidation.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>

</html>