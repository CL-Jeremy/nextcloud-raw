<?php

return [
  'routes' => [
    ['name' => 'pubPage#getByToken', 'url' => '/s/{token}'],
    ['name' => 'pubPage#getByTokenAndPath', 'url' => '/s/{token}/{path}',
      'requirements' => array('path' => '.+')],
    ['name' => 'privatePage#getByPath', 'url' => '/u/{userId}/{path}',
      'requirements' => array('path' => '.+')],
  ]
];
