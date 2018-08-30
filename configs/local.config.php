<?php

use lib\Config;

// DB Config
Config::write('db.host',        'localhost');
Config::write('db.port',        '3309');
Config::write('db.basename',    'inlislite_ub_db');
Config::write('db.user',        'root');
Config::write('db.password',    '');

// Project Config
Config::write('path', 'http://localhost/slimMVC');