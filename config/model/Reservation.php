<?php

class Reservation {
    private $id;
    private $etat;
    private $loueur;
    private $locataire;
    private $date_depart;
    private $date_retour;

    public function __construct($id = null, $etat, $loueur, $locataire, $date_depart, $date_retour)
    {
        $this->id = $id;
        $this->etat = $etat;
        $this->loueur = $loueur;
        $this->locataire = $locataire;
        $this->date_depart = $date_depart;
        $this->date_retour = $date_retour;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEtat()
    {
        return $this->etat;
    }

    public function setEtat()
    {
        $this->etat = $etat;
    }

    public function getLoueur()
    {
        return $this->loueur;
    }

    public function setLoueur()
    {
        $this->loueur = $loueur;
    }

    public function getLocataire()
    {
        return $this->locataire;
    }

    public function setLocataire()
    {
        $this->locataire = $locataire;
    }

    public function getDate_Depart()
    {
        return $this->date_depart = $date_depart;
    }

    public function setDate_Depart()
    {
        $this->date_depart = $date_depart;
    }

    public function getDate_Retour()
    {
        return $this->date_retour = $date_retour;
    }

    public function setDate_Retour()
    {
        $this->date_retour = $date_retour;
    }

}