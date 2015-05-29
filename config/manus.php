<?php

require 'config.php';

$menu["anonymous"] = array(
    'Home' => $config['site_url'],
    'View All CVs' => $config['site_url'] . '/ViewAllCVs',
    'Create New CV' => $config['site_url'] . '/CreateNewCV'
);

if (isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
    $menu["logedIn"] = array(
        'Home' => $config['site_url'],
        'View All CVs' => $config['site_url'] . '/ViewAllCVs',
        'Edit Personal Info' => $config['site_url'] . '/Edit/personalInfo',
        'Edit Educational Info' => $config['site_url'] . '/Edit/eduInfo',
        'Edit Technical Info' => $config['site_url'] . '/Edit/techInfo',
        'Edit Image' => $config['site_url'] . '/Edit/image',
        'View Own CV' => $config['site_url'] . '/summary/' . $_SESSION['userId'],
    );
}
