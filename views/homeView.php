<?php

use Cms\Enums\WebsiteHeader;

?>
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

<body id="homeView">
<header class="jumbotron">
    <h1><?= $pageTitle ?></h1>
</header>
<?php \Cms\Views\View::get("includes/navbar.php", ["usernameUser" => $_SESSION["USERNAME"]]); ?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="introduction_text"><?= $pageInfoText ?></p>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="row">
                    <?php foreach ($projectPreview as $projects) {
                        foreach ($projects as $key => $project) { ?>
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="card mb-3">
                                    <h5 class="text-center">#<?= $project["id"] ?></h5>
                                    <?php
                                    if (isset($project["background_img"]) && !empty($project["background_img"])) {
                                        echo '<img class="card-img-top" src="' . $project["background_img"] . '" alt="Card image cap" class="project-img">';
                                    } else {
                                        echo '';
                                    }
                                    ?>
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $project["title"] ?></h5>

                                        <a href="<?= $_SESSION["GLOBAL_URL"] ?>admin.edit?project=<?= $project["id"] ?>"
                                           class="btn btn-dark btn-block">Edit this project</a>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
            <div class="col-12 col-md-2">
                <h2>Admin functions</h2>
                <div class="btn-group" role="group">
                    <button class="btn btn-secondary" data-toggle="modal" data-target="#createProject">
                        <span class="badge badge-primary">+</span> Create
                    </button>
                    <button class="btn btn-secondary" data-toggle="modal" data-target="#deleteProject">
                        <span class="badge badge-primary">-z</span> Delete
                    </button>
                    <button class="btn btn-secondary" data-toggle="modal" data-target="#changePosition">
                        <span class="badge badge-primary">%</span> Change
                    </button>
                </div>
                <h2>Website header</h2>
                <form action="<?= $_SESSION["GLOBAL_URL"] ?>change.header" method="post">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="websiteHeader1" name="website_banner_header"
                               value="<?= WebsiteHeader::snow ?>">
                        <label class="form-check-label"
                               for="websiteHeader1"><?= WebsiteHeader::snow ?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="websiteHeader2" name="website_banner_header"
                               value="<?= WebsiteHeader::nightsky ?>">
                        <label class="form-check-label"
                               for="websiteHeader2"><?= WebsiteHeader::nightsky ?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="websiteHeader3" name="website_banner_header"
                               value="<?= WebsiteHeader::bubbles ?>">
                        <label class="form-check-label"
                               for="websiteHeader3"><?= WebsiteHeader::bubbles ?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="websiteHeader4" name="website_banner_header"
                               value="<?= WebsiteHeader::normal ?>">
                        <label class="form-check-label"
                               for="websiteHeader4"><?= WebsiteHeader::normal ?></label>
                    </div>

                    <button type="submit" class="btn btn-success"
                            style="display: block; margin: auto; margin-top: 15px;">Save changes
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="modals-container">
        <div class="modal fade" id="createProject" tabindex="-1" role="dialog">
            <form action="<?= $_SESSION["GLOBAL_URL"] ?>create.project" method="post">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Create a new project</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">Create between</label>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" name="project_id_left"
                                               id="project_id_left" placeholder="Enter project ID" autocomplete="off">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="project_id_right"
                                               id="project_id_right" placeholder="Enter project ID" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="project_title" id="project_title"
                                       aria-describedby="project_title" placeholder="Enter project title"
                                       autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="title">Text color</label>
                                <input type="text" class="form-control" name="project_text_color"
                                       id="project_text_color" aria-describedby="project_text_color"
                                       placeholder="What should the text color be?" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="title">Background color</label>
                                <input type="text" class="form-control" name="project_background_color"
                                       id="project_background_color" aria-describedby="project_background_color"
                                       placeholder="Enter project color" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="title">Background image</label>
                                <input type="text" class="form-control" name="project_background_image"
                                       id="project_background_image" aria-describedby="project_title"
                                       value="https://acdaling.nl/img/" placeholder="Enter project title"
                                       autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="title">Banner</label>
                                <input type="text" class="form-control" name="project_banner" id="banner"
                                       aria-describedby="project_banner" placeholder="Enter project banner"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal fade" id="deleteProject" tabindex="-1" role="dialog">
            <form action="<?= $_SESSION["GLOBAL_URL"] ?>delete.project" method="post">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete project</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">The id of the project</label>
                                <input type="text" class="form-control" name="delete_project_with_id" id="project_id"
                                       aria-describedby="project_id" placeholder="Enter the project id"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal fade" id="changePosition" tabindex="-1" role="dialog">
            <form action="<?= $_SESSION["GLOBAL_URL"] ?>change.project" method="post">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Change project order</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">Swap project with id</label>
                                <input type="text" class="form-control" name="project_swap_one" id="project_id_one"
                                       aria-describedby="project_id_one" placeholder="Enter project id to be swaped"
                                       autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="title">To be swaped with id</label>
                                <input type="text" class="form-control" name="project_swap_two" id="project_id_two"
                                       aria-describedby="project_id_two" placeholder="Enter project id to be swaped"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
