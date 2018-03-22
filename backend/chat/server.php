<?php
require_once __DIR__ . "/../vendor/autoload.php";

// Connection à la base
require __DIR__.'/connectDb.php';

$port = 9090;
$server = new \pmill\Chat\BasicMultiRoomServer;
\pmill\Chat\BasicMultiRoomServer::run($server, $port);