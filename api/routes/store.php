<?php
// Route Group Security
$router->group([
  "prefix" => "store",
  "namespace" => "Store",
], function () use ($router) {
  resource("store", "Store", $router);
  resource("product", "Product", $router);

  documentable("store", "StoreController", $router);
  placeable("store", "StoreController", $router);
});
