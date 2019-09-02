<?php

namespace App\DataFixtures;

use App\Entity\Cheese;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CheeseFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $csv = fopen(dirname(__FILE__).'/Resources/cheese_data.csv', 'r');

        $manager->getConnection()->getConfiguration()->setSQLLogger(null);

        $i = 0;
        while (!feof($csv)) {
            $line = fgetcsv($csv, 1000, ";");

            $cheese = new Cheese();
            $cheese->setArea($line[0]);
            $cheese->setName($line[1]);
            $cheese->setFrenchWikipedia($line[2]);
            $cheese->setEnglishWikipedia($line[3]);
            $cheese->setImage($line[4]);
            $cheese->setMilk($line[5]);
            $cheese->setGeoShape($line[6]);
            $cheese->setGeoPoint($line[7]);

            $manager->persist($cheese);

            if ($i % 25 == 0) {
                $manager->flush();
                $manager->clear();
            }

            $i = $i + 1;
        }

        fclose($csv);

        $manager->flush();
    }
}
