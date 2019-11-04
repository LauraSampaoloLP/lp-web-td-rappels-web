<?php

class Director extends Person {


    /**
     * Director constructor.
     */
    public function __construct($id, $lastname, $firstname, $birthDate, $biography)
    {
        parent::__construct($id, $lastname, $firstname, $birthDate, $biography);
    }

    public static function getAllDirectors() {
        require 'config/bdd.php';
        $realsInfosQuery = $bdd->prepare('
            SELECT DISTINCT moviehasperson.idPerson, person.firstname, person.lastname, picture.path, moviehasperson.role, person.birthDate, person.biography
            FROM person, moviehasperson, personhaspicture, picture
            WHERE role = ?
            AND person.id = moviehasperson.idPerson
            AND person.id = personhaspicture.idPerson
            AND personhaspicture.idPicture = picture.id
            ORDER BY lastname ASC
        ');
        $realsInfosQuery->execute(array('real'));
        $allDirectors = array();
        while($real = $realsInfosQuery->fetch()) {
            array_push($allDirectors, new Director($real['idPerson'], $real['lastname'], $real['firstname'], $real['birthDate'], $real['biography']));
        }
        return $allDirectors;
    }

    public static function getDirectorByIdmovie($idMovie) {
        require 'config/bdd.php';
        $realsInfosQuery = $bdd->prepare('
            SELECT *
            FROM person, moviehasperson, personhaspicture, picture
            WHERE idMovie = ?
            AND role = ?
            AND person.id = moviehasperson.idPerson
            AND person.id = personhaspicture.idPerson
            AND personhaspicture.idPicture = picture.id
        ');
        $realsInfosQuery->execute(array($idMovie, 'real'));
        $real = $realsInfosQuery->fetch();
        $Director = new Director($real['idPerson'], $real['lastname'], $real['firstname'], $real['birthDate'], $real['biography']);
        return $Director;
    }
}