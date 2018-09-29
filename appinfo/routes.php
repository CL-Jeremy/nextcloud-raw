<?php

return [
  'routes' => [
    ['name' => 'pubPage#getByToken', 'url' => '/s/{token}', 'verb' => 'GET'],
    ['name' => 'pubPage#getByTokenAndPath', 'url' => '/s/{token}/{path}', 'verb' => 'GET',
      'requirements' => array('path' => '.+')],
    ['name' => 'privatePage#getByPath', 'url' => '/files/{path}', 'verb' => 'GET',
      'requirements' => array('path' => '.+')],
  ]
];
