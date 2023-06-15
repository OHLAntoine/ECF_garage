<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: "car")]
class Car 
{
    #[ORM\Id()]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: "255")]
    private ?string $title = null;

    #[ORM\Column(type: "float")]
    private ?float $price = null;

    #[ORM\Column(type: "text")]
    private ?string $image = null;

    #[ORM\Column(type: "integer")]
    private ?int $circulationDate = null;

    #[ORM\Column(type: "integer")]
    private ?int $km = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id) : self
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getCirculationDate()
    {
        return $this->circulationDate;
    }

    public function setCirculationDate($circulationDate)
    {
        $this->circulationDate = $circulationDate;

        return $this;
    }

    public function getKm()
    {
        return $this->km;
    }

    public function setKm($km)
    {
        $this->km = $km;

        return $this;
    }
}