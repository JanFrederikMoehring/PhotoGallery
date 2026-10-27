<?php

use Symfony\Component\HttpFoundation\Response;

require_once __DIR__.'/init.php';
require_once __DIR__.'/src/Database.php';

$name = $request->query->get('name', 'World');

$db = new Database();

$db->createPhotosTable();

$photo = $db->getPhoto(2)->photo;

$picturePath = '/database/Photos/' . $photo;

$filePath = __DIR__ . '/database/Photos/' . $photo;

$finfo = new finfo(FILEINFO_MIME_TYPE);
$datatype = $finfo->file($filePath);

$response = new Response(sprintf('Hello %s',htmlspecialchars($name, ENT_QUOTES, 'UTF-8')));
$response->send();

require_once __DIR__.'/layouts/Header.php';
?>

<div class="relative w-fit">
    <img class="w-[400px]" src="<?= $picturePath ?>" alt="London">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-black/30 p-4 backdrop-blur-sm">
        <p class="text-xl text-white"><?= $photo?></p>
    </div>
</div>