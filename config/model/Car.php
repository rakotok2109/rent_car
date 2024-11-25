
<?php
//  Class model for Car with attributr id, brand , model, kilometrage, description, vitesse, year, image and idOwner 
class Car
{
    private $id;
    private $brand;
    private $model;
    private $kilometrage;
    private $description;
    private $vitesse;
    private $year;
    private $image;
    private $idOwner;

    public function __construct($id = null, $brand, $model, $kilometrage, $description, $vitesse, $year, $image, $idOwner = null)
    {
        $this->id = $id;
        $this->brand = $brand;
        $this->model = $model;
        $this->kilometrage = $kilometrage;
        $this->description = $description;
        $this->vitesse = $vitesse;
        $this->year = $year;
        $this->image = $image;
        $this->idOwner = $idOwner;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getBrand()
    {
        return $this->brand;
    }
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    public function getmodel()
    {
        return $this->model;

    }
    public function setModel($model)
    {
        $this->model = $model;
    }

    public function getKilometrage()
    {
        return $this->kilometrage;
    }
    public function setKilometrage($kilometrage)
    {
        $this->kilometrage = $kilometrage;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getVitesse()
    {
        return $this->vitesse;
    }
    public function setVitesse($vitesse)
    {
        $this->vitesse = $vitesse;
    }

    public function getYear()
    {
        return $this->year;
    }
    public function setYear($year)
    {
        $this->year = $year;
    }

    public function getImage()
    {
        return $this->image;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getIdOwner()
    {
        return $this->idOwner;
    }
    public function setIdOwner($idOwner)
    {
        $this->idOwner = $idOwner;
    }
}