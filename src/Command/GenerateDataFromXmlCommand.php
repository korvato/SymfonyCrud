<?php

namespace App\Command;

use App\Entity\Product;
use App\Entity\Order;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateDataFromXmlCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:create-data-xml';

    protected function configure()
    {
        $this
        ->setDescription('Creates data from xml file.')
        ->setHelp('This command allows you to create a data from xml...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $xml = simplexml_load_file("data.xml");

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->flush();

        foreach ($xml->children() as $row) {

            $orders = $row->orders;
            foreach ($orders as $x) {
                $user = new User();
                $user->setFirstname($x->user->firstname);
                $user->setLastname($x->user->lastname);
                $user->setEmail($x->user->email);
                $user->setStreet($x->user->adress->street);
                $user->setZip($x->user->adress->zip);
                $user->setCity($x->user->adress->city);
                $entityManager->persist($user);

                $order = new Order();
                $order->setId($x->id);
                $order->setMarketplace($x->marketplace);
                $order->setCreated_at($x->created_at);
                $entityManager->persist($order);


                $produit = new Product();
                $produit->setLabel($x->label);
                $produit->setPrice($x->price);
                $produit->setRef($x->ref);
                $produit->setUser($user);
                $produit->setOrder($order);
                $entityManager->persist($produit);
            }  
        }  

        $output->writeln([
        'saving in data base from file data.xml',
        '============',
        '',
        ]);

        return 0;
    }
}