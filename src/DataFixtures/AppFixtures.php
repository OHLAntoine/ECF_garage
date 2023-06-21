<?php

namespace App\DataFixtures;

use App\Entity\Avis;
use App\Entity\Car;
use App\Entity\Planning;
use App\Entity\Service;
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

        // Ajout de quelques véhicules
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

        // Ajout de quelques services
        $revision = new Service();
        $revision->setTitle('Révision')->setDescription('Celle-ci se réalise sur différents éléments de votre voiture, dont l’identification, la direction, la visibilité, l’éclairage, la liaison au sol, la mécanique, le niveau de pollution, la carrosserie, etc');
        $manager->persist($revision);
        $manager->flush();

        $entretien = new Service();
        $entretien->setTitle('Entretien')->setDescription('Vérifications au niveau du pare-brise, des feux et des essuie-glaces, des contrôles internes et externes, niveau d\'huile et pneumatique.');
        $manager->persist($entretien);
        $manager->flush();

        $reparation = new Service();
        $reparation->setTitle('Réparation')->setDescription('Diverses qui peuvent aller de la remise en état des pneus, des plaquettes de frein, des amortisseurs et des autres organes mécaniques à la carroserie');
        $manager->persist($reparation);
        $manager->flush();

        // Ajout des horaires de la semaine
        $lundi = new Planning();
        $lundi->setDayOfTheWeek('Lundi')->setMorningStart(new \DateTime('08:45'))->setMorningEnd(new \DateTime('12:00'))->setAfternoonStart(new \DateTime('14:00'))->setAfternoonEnd(new \DateTime('18:00'));
        $manager->persist($lundi);
        $manager->flush();

        $mardi = new Planning();
        $mardi->setDayOfTheWeek('Mardi')->setMorningStart(new \DateTime('08:45'))->setMorningEnd(new \DateTime('12:00'))->setAfternoonStart(new \DateTime('14:00'))->setAfternoonEnd(new \DateTime('18:00'));
        $manager->persist($mardi);
        $manager->flush();

        $mercredi = new Planning();
        $mercredi->setDayOfTheWeek('Mercredi')->setMorningStart(new \DateTime('08:45'))->setMorningEnd(new \DateTime('12:00'))->setAfternoonStart(new \DateTime('14:00'))->setAfternoonEnd(new \DateTime('18:00'));
        $manager->persist($mercredi);
        $manager->flush();

        $jeudi = new Planning();
        $jeudi->setDayOfTheWeek('Jeudi')->setMorningStart(new \DateTime('08:45'))->setMorningEnd(new \DateTime('12:00'))->setAfternoonStart(new \DateTime('14:00'))->setAfternoonEnd(new \DateTime('18:00'));
        $manager->persist($jeudi);
        $manager->flush();

        $vendredi = new Planning();
        $vendredi->setDayOfTheWeek('Vendredi')->setMorningStart(new \DateTime('08:45'))->setMorningEnd(new \DateTime('12:00'))->setAfternoonStart(new \DateTime('14:00'))->setAfternoonEnd(new \DateTime('18:00'));
        $manager->persist($vendredi);
        $manager->flush();

        $samedi = new Planning();
        $samedi->setDayOfTheWeek('Samedi')->setMorningStart(new \DateTime('08:45'))->setMorningEnd(new \DateTime('12:00'))->setAfternoonStart(null)->setAfternoonEnd(null);
        $manager->persist($samedi);
        $manager->flush();

        $dimanche = new Planning();
        $dimanche->setDayOfTheWeek('Dimanche')->setMorningStart(null)->setMorningEnd(null)->setAfternoonStart(null)->setAfternoonEnd(null);
        $manager->persist($dimanche);
        $manager->flush();
        
        // Création de quelques avis clients
        $avis1 = new Avis();
        $avis1->setName('John Doe')->setCommentary('Très bien reçu par cette équipe de professionnel qui ont su réparer ma voiture à la perfection')->setNote(5)->setIsModerate(true);
        $manager->persist($avis1);
        $manager->flush();

        $avis2 = new Avis();
        $avis2->setName('Mr Smith')->setCommentary('Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio laboriosam iure numquam eum ducimus quas nobis consequuntur asperiores quasi nemo ratione assumenda, alias magnam porro voluptatibus, dolor maxime explicabo impedit!')->setNote(4)->setIsModerate(true);
        $manager->persist($avis2);
        $manager->flush();

        $avis3 = new Avis();
        $avis3->setName('Bob le bricoleur')->setCommentary('Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio laboriosam iure numquam eum ducimus quas nobis consequuntur asperiores quasi nemo ratione assumenda, alias magnam porro voluptatibus, dolor maxime explicabo impedit!')->setNote(3);
        $manager->persist($avis3);
        $manager->flush();

        $avis4 = new Avis();
        $avis4->setName('Optimus Prime')->setCommentary('Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio laboriosam iure numquam eum ducimus quas nobis consequuntur asperiores quasi nemo ratione assumenda, alias magnam porro voluptatibus, dolor maxime explicabo impedit!')->setNote(4)->setIsModerate(true);
        $manager->persist($avis4);
        $manager->flush();

        $avis5 = new Avis();
        $avis5->setName('Bumbelbee')->setCommentary('Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio laboriosam iure numquam eum ducimus quas nobis consequuntur asperiores quasi nemo ratione assumenda, alias magnam porro voluptatibus, dolor maxime explicabo impedit!')->setNote(5)->setIsModerate(true);
        $manager->persist($avis5);
        $manager->flush();

        $avis6 = new Avis();
        $avis6->setName('Arthur Weasley')->setCommentary('Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio laboriosam iure numquam eum ducimus quas nobis consequuntur asperiores quasi nemo ratione assumenda, alias magnam porro voluptatibus, dolor maxime explicabo impedit!')->setNote(2);
        $manager->persist($avis6);
        $manager->flush();
    }
}
