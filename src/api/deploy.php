<?php
include('../functions.php');

if (!isset($_GET['key']) || $_GET['key'] !== get_env('deploy')['key']) {
    echo 'Invalid key';
    exit();
}

// デプロイ
$path = get_env('deploy')['path'];
$branch = get_env('deploy')['branch'];
$command = "cd {$path} && git checkout {$branch} && git pull";
exec($command, $output, $return_var);

if ($return_var === 0) {
    echo 'Deploy success';
} else {
    echo 'Deploy failed';
}