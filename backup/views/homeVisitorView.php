<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">

    <title>CMS website - <?= $pageHeader ?></title>
</head>

<body id="homeView">
    <header class="jumbotron">
        <h1><?= $pageTitle ?></h1>
    </header>
    <?php \Cms\Views\View::get("includes/navbar.php", ["usernameUser" => $_SESSION["USERNAME"]]) ?>
    <main class="container">
        <div class="row">
            <div class="col-12">
                <p class="introduction_text"><?= $pageInfoText ?></p>
            </div>
        </div>
        <div class="row">
            <?php foreach ($projectPreview as $projects) {
                foreach ($projects as $project) { ?>
                    <?php if (isset($project["background_img"]) && !empty($project["background_img"])) { ?>
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="card mb-3">
                                <img class="card-img-top" src="<?= $project["background_img"] ?>" alt="Card image cap" class="project-img">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $project["title"] ?></h5>
                                    <a href="<?= ($usernameUser === "Accie") ? $_SESSION["GLOBAL_URL"] . 'admin.edit' :
                                                    $_SESSION["GLOBAL_URL"] . 'visitor.' ?>edit?project=<?= $project["id"] ?>" class="btn btn-dark btn-block">View project</a>
                                </div>
                            </div>
                        </div>
            <?php }
                }
            } ?>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="./assets/index.js"></script>
</body>

</html>