<?php

class Actor extends Person {


    /**
     * Actor constructor.
     */
    public function __construct($id, $lastname, $firstname, $birthDate, $biography)
    {
        parent::__construct($id, $lastname, $firstname, $birthDate, $biography);
    }

    public static function getAllActors() {
        require 'config/bdd.php';
        $actorsInfosQuery = $bdd->prepare('
            SELECT DISTINCT moviehasperson.idPerson, person.firstname, person.lastname, picture.path, moviehasperson.role, person.birthDate, person.biography
            FROM person, moviehasperson, personhaspicture, picture
            WHERE role = ?
            AND person.id = moviehasperson.idPerson
            AND person.id = personhaspicture.idPerson
            AND personhaspicture.idPicture = picture.id
            ORDER BY lastname ASC
        ');
        $actorsInfosQuery->execute(array('actor'));
        $allActors = array();
        while($actor = $actorsInfosQuery->fetch()) {
            array_push($allActors, new Actor($actor['idPerson'], $actor['lastname'], $actor['firstname'], $actor['birthDate'], $actor['biography']));
        }
        return $allActors;
    }

    public static function getActorsByIdmovie($idMovie) {
        require 'csonfig/bdd.php';
        $actorsInfosQuery = $bdd->prepare('
            SELECT *
            FROM person, moviehasperson, personhaspicture, picture
            WHERE idMovie = ?
            AND role = ?
            AND person.id = moviehasperson.idPerson
            AND person.id = personhaspicture.idPerson
            AND personhaspicture.idPicture = picture.id
            ORDER BY lastname ASC
        ');
        $actorsInfosQuery->execute(array($idMovie, 'actor'));
        $allActors = array();
        while($actor = $actorsInfosQuery->fetch()) {
            array_push($allActors, new Actor($actor['idPerson'], $actor['lastname'], $actor['firstname'], $actor['birthDate'], $actor['biography']));
        }
        return $allActors;
    }
}