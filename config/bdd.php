<?php
$bdd = new PDO('mysql:host=localhost;dbname=film', 'root', '');
$bdd->exec('SET CHARACTER SET utf8');

setlocale (LC_TIME, 'fr_FR.utf8','fra');