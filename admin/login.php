<?php





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logga in</title>

    <style>

        body {
            background: #f2f6f8;
            font-family: Nunito;
        }

        .flex_center {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .full-height {
            height: 100vh;
        }

        .login-form_wrapper {
            max-width: 300px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #dce1e4;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #45a049;
        }


        .error-msg {
            color: #f00;
        }
        .success-msg {
            color: #1A8C1A;
        }




    </style>


</head>
<body>
    <div class="flex_center full-height">
        <div class="login-form_wrapper">

            <form class="login-form" id="login-form">
                <div class="input_wrapper">
                    <label for="username">Användarnamn:</label>
                    <input type="text" id="username" placeholder="Användarnamn" required>
                </div>
                <div class="input_wrapper">
                    <label for="password">Lösenord:</label>
                    <input type="password" id="password" placeholder="Lösenord" required>
                </div>
                <div class="input_wrapper">
                    <input type="submit" id="loginBtn" value="Logga in">
                </div>
            </form>
            <div id="login-msg"></div>
        </div>

    </div>


<?php include_once('layout_includes/footer.php'); ?>