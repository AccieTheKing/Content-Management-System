<?php $pageVar = $pageContent["contentTitle"][$_GET["project"]] ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">

    <title>CMS website - <?= $pageHeader ?></title>
</head>

<body id="editView">
<header class="jumbotron" style="background: url(<?= $pageVar["background_img"] ?>) center center">
    <h1><?= $pageVar["title"] ?></h1>
</header>
<?php \Cms\Views\View::get("includes/navbar.php", ["usernameUser" => $_SESSION["USERNAME"]]) ?>
<main class="container">

    <form action="#" method="post">

        <div class="row pt-15">
            <div class="col-6 offset-md-2 col-md-4">
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" name="project_id" value="<?= $pageVar["id"] ?>" readonly>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="form-group">
                    <label for="id">Title</label>
                    <input type="text" class="form-control" name="project_title" value="<?= $pageVar["title"] ?>" autocomplete="off" readonly>
                </div>
            </div>
        </div>

        <div class="row pt-15">
            <div class="col-12">
                <div class="text-center">
                    <h3>Main page</h3>
                </div>
                <div class="form-group">
                    <label for="id">Textcolor</label>
                    <input type="text" class="form-control" name="project_color" value="<?= $pageVar["text_color"] ?>" autocomplete="off" readonly>
                </div>
                <div class="form-group">
                    <label for="id">Background color</label>
                    <input type="text" class="form-control" name="project_backgroundColor"
                           value="<?= $pageVar["background_color"] ?>" autocomplete="off" readonly>
                </div>
            </div>
        </div>

        <div class="row pt-15">
            <div class="col-12">
                <div class="form-group">
                    <label for="id">Background image</label>
                    <input type="text" class="form-control" name="project_BackgroundImg"
                           value="<?= $pageVar["background_img"] ?>" autocomplete="off" readonly>
                </div>
                <div class="form-group">
                    <label for="id">PositionX</label>
                    <input type="text" class="form-control" name="project_positionX"
                           value="<?= $pageVar["positionX"] ?>" autocomplete="off" readonly>
                </div>
            </div>
        </div>

        <div class="row pt-15">
            <div class="col-12">
                <div class="form-group">
                    <label for="id">PositionY</label>
                    <input type="text" class="form-control" name="project_positionY"
                           value="<?= $pageVar["positionY"] ?>" autocomplete="off" readonly>
                </div>
                <div class="form-group">
                    <label for="id">Is banner</label>
                    <input type="text" class="form-control" name="project_is_banner"
                           value="<?= $pageVar["is_banner"] ?>" autocomplete="off" readonly>
                </div>
            </div>
        </div>

        <div class="row pt-15">
            <div class="col-12">
                <div class="form-group">
                    <div class="text-center">
                        <h3>Detail page</h3>
                    </div>
                    <label for="id">Detail page url</label>
                    <input type="text" class="form-control" name="project_content_url"
                           value="<?= $pageVar["content"]["url"] ?>" autocomplete="off" readonly>
                </div>
                <div class="form-group">
                    <label for="id">Detail page content</label>
                    <input type="text" class="form-control" name="project_content_title"
                           value="<?= $pageVar["content"]["title"] ?>" autocomplete="off" readonly>
                </div>
                <div class="form-group">
                    <label for="id">Detail page description</label>
                    <input type="text" class="form-control" name="project_content_description"
                           value="<?= $pageVar["content"]["description"] ?>" autocomplete="off" readonly>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <button type="button" class="btn btn-outline-dark my-2 my-sm-0">Save</button>
                </div>
            </div>
        </div>

    </form>

</main>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="./assets/index.js"></script>
</body>

</html>