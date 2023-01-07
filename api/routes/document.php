<?php

use App\Models\Document;

$router->get("documents/{hash}", function ($hash) {

    $document = Document::where("name", $hash)->first();
    if ($document) {
        return file_get_contents($document->real_path);
    }
});

