<?php

switch($_GET['view']){
    case 'deleteStory':
        include $views_dir.'/deleteStory.php';
        break;
    case 'getEpics':
        include $views_dir.'/getEpics.php';
        break;
    case 'getMilestone':
        include $views_dir.'/getMilestone.php';
        break;
    case 'dashboard':
        include $views_dir.'/dashboard.php';
        break;
    case 'createStory':
        include $views_dir.'/createStory.php';
        break;
}