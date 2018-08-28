<?php

return [
  'routes' => [
    ['name' => 'pubPage#getByToken', 'url' => '/s/{token}', 'verb' => 'GET'],
    ['name' => 'privatePage#getByPath', 'url' => '/files/{path}', 'verb' => 'GET',
      'requirements' => array('path' => '.+')],
  ]
];
