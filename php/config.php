<?php
    $db = new PDO('mysql:host=mysql.labranet.jamk.fi;dbname=L9406_1;charset=utf8', 'L9406', 'F5zR83eXe9gic5d0SueY9K3c3clhGSfp');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>