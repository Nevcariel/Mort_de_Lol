<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Categorie;
use App\Entity\Blague;
use App\Entity\Commentaire;
use App\Entity\Note;
use Doctrine\Bundle\FixturesBundle\Fixture; 
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class AppFixtures extends Fixture 
{ 
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager) 
    {  
        $courte = new Categorie();
        $courte->setLibelle("Courte");
        $manager->persist($courte);

        $Longue = new Categorie();
        $Longue->setLibelle("Longue");
        $manager->persist($Longue);

        $Femmes = new Categorie();
        $Femmes->setLibelle("Femmes");
        $manager->persist($Femmes);

        $Travail = new Categorie();
        $Travail->setLibelle("Travail");
        $manager->persist($Travail);

        $Animaux = new Categorie();
        $Animaux->setLibelle("Animaux");
        $manager->persist($Animaux);

        $Handicap = new Categorie();
        $Handicap->setLibelle("Handicap");
        $manager->persist($Handicap);

        $Monsieur = new Categorie();
        $Monsieur->setLibelle("Monsieur et Madame...");
        $manager->persist($Monsieur);

        $Toc = new Categorie();
        $Toc->setLibelle("Toc Toc...");
        $manager->persist($Toc);

        $Maladie = new Categorie();
        $Maladie->setLibelle("Maladie");
        $manager->persist($Maladie);

        $Maladie = new Categorie();
        $Maladie->setLibelle("Blonde");
        $manager->persist($Maladie);

        $Pervers = new Categorie();
        $Pervers->setLibelle("Pervers");
        $manager->persist($Pervers);

        $Belges = new Categorie();
        $Belges->setLibelle("Belges");
        $manager->persist($Belges);

        $Pays = new Categorie();
        $Pays->setLibelle("Pays");
        $manager->persist($Pays);

        $Religion = new Categorie();
        $Religion->setLibelle("Religion");
        $manager->persist($Religion);

        $manager->flush();

        $admin = new User();
        $admin->setUsername("admin");
        $admin->setEmail("admin@mortdelol.fr");
        $password = $this->encoder->encodePassword($admin, 'admin');
        $admin->setPlainPassword($password);
        $admin->setPassword($password);
        $manager->persist($admin);
        
        
        $jean = new User();
        $jean->setUsername("jean");
        $jean->setEmail("jean@mortdelol.fr");
        $password = $this->encoder->encodePassword($jean, 'jean');
        $jean->setPlainPassword($password);
        $jean->setPassword($password);
        $manager->persist($jean);
        
        $paul = new User();
        $paul->setUsername("paul");
        $paul->setEmail("paul@mortdelol.fr");
        $password = $this->encoder->encodePassword($paul, 'paul');
        $paul->setPlainPassword($password);
        $paul->setPassword($password);
        $manager->persist($paul);

        $manager->flush();
        
        $blague1 = new Blague();
        $blague1->setTitre("C'est l'histoire du ptit dej, vous la connaissez ?");
        $blague1->setContenu("Pas de bol.");
        $blague1->setUser($admin);
        $blague1->addCategory($courte);
        $manager->persist($blague1);
        
        $blague2 = new Blague();
        $blague2->setTitre("C'est l'histoire de l'eunuque décapité.");
        $blague2->setContenu("Une histoire sans queue ni tête.");
        $blague2->setUser($admin);
        $blague2->addCategory($courte);
        $manager->persist($blague2);
        
        $blague3 = new Blague();
        $blague3->setTitre("C'est l'histoire du nain aux 26 enfant.");
        $blague3->setContenu("Elle est courte mais elle est bonne.");
        $blague3->setUser($jean);
        $blague3->addCategory($courte);
        $blague3->addCategory($Handicap);
        $manager->persist($blague3);
        
        $blague4 = new Blague();
        $blague4->setTitre("C'est l'histoire d'un pingouin qui respire par les fesses.");
        $blague4->setContenu("Un jour il s'assoit et il meurt.");
        $blague4->setUser($jean);
        $blague4->addCategory($courte);
        $blague4->addCategory($Animaux);
        $manager->persist($blague4);

        $blague5 = new Blague();
        $blague5->setTitre("Qu'est ce qui est vert,se déplace sous l'eau, et fair buzzzzz ?");
        $blague5->setContenu("Un chou marin ruche.");
        $blague5->setUser($paul);
        $blague5->addCategory($courte);
        $blague5->addCategory($Pays);
        $manager->persist($blague5);
        
        $manager->flush();
        
        $commentaire = new Commentaire();
        $commentaire->setUser($admin);
        $commentaire->setBlague($blague1);
        $commentaire->setContenu("Trop marrant !");
        $manager->persist($commentaire);
        
        $commentaire2 = new Commentaire();
        $commentaire2->setUser($jean);
        $commentaire2->setBlague($blague3);
        $commentaire2->setContenu("Génial !");
        $manager->persist($commentaire2);
        
        $commentaire3 = new Commentaire();
        $commentaire3->setUser($paul);
        $commentaire3->setBlague($blague5);
        $commentaire3->setContenu("Mdr");
        $manager->persist($commentaire3);
        
        $manager->flush();
        
        $note = new Note();
        $note->setNote(4);
        $note->setUser($admin);
        $note->setBlague($blague1);
        $manager->persist($note);
        
        $manager->flush();
        
    }

}