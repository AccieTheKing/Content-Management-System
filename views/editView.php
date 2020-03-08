<?php
foreach ($pageContent["contentTitle"] as $project)
    if ($project["id"] == $_GET["project"])
        $pageVar = $project;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">

    <title>CMS website - <?= $pageHeader ?></title>
</head>

<body id="editView">
    <?php \Cms\Views\View::get("includes/navbar.php", ["usernameUser" => $_SESSION["USERNAME"]]) ?>
    <div class="jumbotron" style="background: url(<?= $pageVar["background_img"] ?>) center center">
        <span class="project-number">#<?= $pageVar["id"] ?></span>
        <h1><?= $pageVar["title"] ?></h1>
    </div>

    <main class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1">
                <form action="<?= $_SESSION["GLOBAL_URL"] ?>admin.edit" method="post">

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="true">General</a>
                            <a class="nav-item nav-link" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="false">Details</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
                            <div class="row">
                                <div class="col-12">
                                    <h2>General Settings</h2>
                                    <p class="lead">Displayed on the homepage of the website.</p>

                                    <input type="text" class="form-control" name="project_id" value="<?= $pageVar["id"] ?>" readonly hidden>

                                </div>
                            </div>
                            <div class="row pt-15 form-group">
                                <label for="id" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="project_title" value="<?= $pageVar["title"] ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="row pt-15 form-group">
                                <label for="id" class="col-sm-2 col-form-label">Textcolor</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="project_color" value="<?= $pageVar["text_color"] ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="id" class="col-sm-2"> Background color</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="project_backgroundColor" value="<?= $pageVar["background_color"] ?>" autocomplete="off">
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="id" class="col-sm-2">Background image</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="project_BackgroundImg" value="<?= $pageVar["background_img"] ?>" autocomplete="off">
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="id" class="col-sm-2">PositionX</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="project_positionX" value="<?= $pageVar["positionX"] ?>" autocomplete="off">
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="id" class="col-sm-2">PositionY</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="project_positionY" value="<?= $pageVar["positionY"] ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="id" class="col-sm-2">Act as banner (0 or 1)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="project_is_banner" value="<?= $pageVar["is_banner"] ?>" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
                            <div class="row pt-15 form-group">
                                <div class="col-12">
                                    <h3>Detail page</h3>
                                    <p class="lead">Details viewed after clicking on a project</p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="id" class="col-sm-2">Detail page url</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="project_content_url" value="<?= $pageVar["content"]["url"] ?>" autocomplete="off">
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="id" class="col-sm-2">Detail page content</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="project_content_title" value="<?= $pageVar["content"]["title"] ?>" autocomplete="off">
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="id" class="col-sm-2">Detail page description</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="project_content_description" value="<?= $pageVar["content"]["description"] ?>" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-dark my-2 my-sm-0">Save</button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
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