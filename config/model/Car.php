
<?php
class Car implements JsonSerializable
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
    private $prix;
    private $ville;
    private $disponibilite;

    public function __construct($brand, $model, $kilometrage, $description, $vitesse, $year, $image, $idOwner, $prix, $ville, $disponibilite=1, $id = null)
    {        
        $this->brand = $brand;
        $this->model = $model;
        $this->kilometrage = $kilometrage;
        $this->description = $description;
        $this->vitesse = $vitesse;
        $this->year = $year;
        $this->image = $image;
        $this->idOwner = $idOwner;
        $this->prix = $prix;
        $this->ville = $ville;
        $this->disponibilite = $disponibilite;
        $this->id = (int)$id;
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

    public function getModel()
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
    public function getPrix()
    {
        return $this->prix;
    }
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }
    public function getVille()
    {
        return $this->ville;
    }
    public function setVille($ville)
    {
        $this->ville = $ville;
    }
    public function getDisponibilite()
    {
        return $this->disponibilite;
    }
    public function setDisponibilite($disponibilite)
    {
        $this->disponibilite = $disponibilite;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'brand' => $this->brand,
           'model' => $this->model,
            'kilometrage' => $this->kilometrage,
            'description' => $this->description,
            'vitesse' => $this->vitesse,
            'year' => $this->year,
            'image' => $this->image,
            'idOwner' => $this->idOwner,
            'prix' => $this->prix,
            'ville' => $this->ville,
            'disponibilite' => $this->disponibilite
        ];
    }
}