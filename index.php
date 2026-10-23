<?php

use Symfony\Component\HttpFoundation\Response;

require_once __DIR__.'/init.php';
require_once __DIR__.'/src/Database.php';

$name = $request->query->get('name', 'World');

$db = new Database();

$db->createPhotosTable();

$photo = $db->getPhoto(3)->photo;

$picturePath = '/database/Photos/' . $photo;


$response = new Response(sprintf('Hello %s',htmlspecialchars($name, ENT_QUOTES, 'UTF-8')));
$response->send();

?>

<img src="<?= $picturePath ?>" width="400" alt="London">