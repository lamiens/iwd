<?php
include 'settings.php';
include $inc_dir.'/functions.php';
include $base_dir_api.'/endpoints.php';
include $base_dir_api.'/request/methods.php';
header('Access-Control-Allow-Origin: http://localhost:3000');

if (isset($_FILES['story'])){
    $target_file = $csv_dir.'/'.basename($_FILES['story']['name']);
    $storyName = $_FILES['story']['name'];
    move_uploaded_file($_FILES['story']['tmp_name'], $target_file);
    $method = Methods::getInstance();
    //$method->setStories($target_file);
    $notification = toastSucces($storyName);
}

$method = Methods::getInstance();
$method->deleteStory(225);


?>

<html>
    <head>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/frontend.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= './assets/style.css'?>">
    <script src="<?= './assets/frontend.js'?>"></script>
    </head>
    <body id="body-pd">
            <header class="header" id="header">
                <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
                <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
            </header>
            <h1 class="text-center title">Gestion de vos stories Shorcuts</h1>
            <div class="container">
                <div class="l-navbar" id="nav-bar">
                    <nav class="nav">
                        <div> 
                                <a href="#" class="nav_logo"> 
                                    <i class='bx bx-layer nav_logo-icon'></i> 
                                    <span class="nav_logo-name">Story Manager</span> 
                                </a>
                                <div class="nav_list"> 
                                    <a href="#" class="nav_link active create_story"> 
                                        <i class='bx bx-grid-alt nav_icon'></i> 
                                        <span class="nav_name">Créer une Story</span> 
                                    </a> 
                                <a href="#" class="nav_link delete_story"> 
                                        <i class='bx bx-trash nav_icon'></i> 
                                        <span class="nav_name">Supprimer une Story</span> 
                                </a> 
                                <a href="#" class="nav_link update_story"> 
                                    <i class='bx bx-check-square nav_icon'></i> 
                                    <span class="nav_name">Update une Story</span> 
                                </a> 
                                <a href="#" class="nav_link list_epics"> 
                                    <i class='bx bx-show nav_icon'></i> 
                                    <span class="nav_name">Voir les Épics</span> 
                                </a> 
                                <a href="#" class="nav_link list_milestones"> 
                                    <i class='bx bx-show-alt nav_icon'></i> 
                                    <span class="nav_name">Voir les Milestones</span> 
                                </a> 
                            </div>
                        </div> 
                        <a href="#" class="nav_link"> 
                        <i class='bx bx-log-out nav_icon'></i> 
                        <span class="nav_name">SignOut</span> </a>
                </nav>
             </div>
                <div class="content"> 
                <div class=" d-flex flex-column flex-shrink-0 p-3 m-3">
                    <h2>Créer votre story</h2>
                        <form method="post" action="" enctype="multipart/form-data" class="col-sm-12 shadow rounded bg-white rounded">
                            <div class="form-group">
                                <label for="story_field">Fichier à uploader</label>
                                <input name="story" id="story_field" type="file" class="form-control"/> 
                            </div>
                            <button class="btn btn-default ">Envoyer</button>
                        </form>
                </div>
                    <?php if (isset($notification)) :?> 
                        <div class="row">
                            <div class="alert-success col-sm-12 text-center p-3"><?= $notification?></div>
                            <div class="jumbotron"><?= getStorySended($target_file) ?></div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </body>
        <footer>
        </footer>
</html>


