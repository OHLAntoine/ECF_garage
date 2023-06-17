<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Création du profile Admin pour Vincent Parrot
        $admin = new User($this->passwordHasher);
        $admin->setEmail('vincent.parrot@gmail.com')->setPassword("vincentparrot")->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        $manager->flush();

        // Création d'un compte employé fictif
        $employe = new User($this->passwordHasher);
        $employe->setEmail('employe@gmail.com')->setPassword("jesuisemploye");
        $manager->persist($employe);
        $manager->flush();

        // Ajout de quelques Post
        $audi = new Car();
        $audi->setTitle('Audi presque neuve')->setPrice(15000)->setImage('audi.avif')->setCirculationDate(2018)->setKm(40000);
        $manager->persist($audi);
        $manager->flush();

        $bmw = new Car();
        $bmw->setTitle('BMW rétro')->setPrice(12000)->setImage('bmw-648da1badd604.avif')->setCirculationDate(2001)->setKm(220000);
        $manager->persist($bmw);
        $manager->flush();

        $chevrolet = new Car();
        $chevrolet->setTitle('Chevrolet vintage')->setPrice(8000)->setImage('Chevrolet.avif')->setCirculationDate(1998)->setKm(240000);
        $manager->persist($chevrolet);
        $manager->flush();

        $honda = new Car();
        $honda->setTitle('Honda récente')->setPrice(9950)->setImage('honda.avif')->setCirculationDate(2020)->setKm(110000);
        $manager->persist($honda);
        $manager->flush();

    }
}
