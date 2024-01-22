<?php
include 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="img/logo/wgs.jpg" rel="icon">
    <title>WGS - LOGIN</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">



</head>

<body>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <img src="img/logo/wgs.jpg" alt="WGS Logo" class="logo-img">

                <?php
                if (isset($error)) {
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                }
                ?>

                <form action="" method="post">
                    <div class="form-group">
                        <label for="username">Username :</label>
                        <input type="text" class="form-control" id="username" name="username" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password :</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <input type="checkbox" onclick="showPassword()"> Show
                                </span>
                            </div>




                        </div>

                    </div>

                    <div class="btnlogin" style="text-align: center;">

                        <button type="submit" class="btn btn-primary mx-auto">Login</button>
                </form>
            </div>
        </div>
    </div>



    <script src="js/index.js"></script>
    <!-- Bootstrap JS and dependencies (popper.js and jQuery) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>