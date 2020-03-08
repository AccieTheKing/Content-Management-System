<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">

    <title>CMS website - <?= $pageHeader; ?></title>
</head>

<body>
    <form action="/" method="POST" id="login_form" autocomplete="off">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-md-2 col-xl-6 offset-xl-3">
                    <h1 class="text-center"><?= $pageTitle ?></h1>
                    <?php
                    if (isset($_SESSION["USERNAME"]) && $_SESSION["USERNAME"]) {
                        print("<div class='form -group'>
                        <span class='text-danger text-center d-block'>Username or password is invalid!</span>
                    </div>");
                    } else {
                        unset($_SESSION["USERNAME"]);
                    }
                    ?>
                    <div class="form-group">
                        <label for="" class="lead small">Username</label>
                        <input type="text" class="form-control" name="txtfieldUsername" value="Visitor" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="" class="lead small">Password</label>
                        <input type="password" class="form-control" name="txtfieldPassword" value="Visitor1234!" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-control loginButton">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="./assets/index.js"></script>
</body>

</html>