<?php

namespace App\Stars\Entity;

class Star
{
    protected $id;

    protected $nom;

    protected $localisation;

    protected $userID;

    public function __construct($id, $nom, $localisation, $userID)
    {
        $this->id = $id;
        $this->localisation = $localisation;
        $this->nom = $nom;
        $this->userID = $userID;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setLocalisation($localisation)
    {
        $this->localisation = $localisation;
    }
    public function setuserID($userID)
    {
        $this->userID = $userID;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getLocalisation()
    {
        return $this->localisation;
    }
    public function getNom()
    {
        return $this->nom;
    }
    public function getuserID()
    {
        return $this->userID;
    }

    public function toArray()
    {
        $array = array();
        $array['id'] = $this->id;
        $array['nom'] = $this->nom;
        $array['localisation'] = $this->localisation;
        $array['userID'] = $this->userID;
        return $array;
    }
}
