<?php

$db = new PDO('mysql:host=localhost;dbname=sapphire;', 'sapphire_admin', '8F9KDsJ5pDcKYxJT');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
