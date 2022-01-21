<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Film;
use App\Entity\Tv;
use App\Entity\Statue;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i=0; $i<2; $i++){
            $statue = (new Statue())
                ->setStatue('Statue'.$i);
                
            $manager->persist($statue);

            for($j=0; $j<1; $j++){
                $film = (new Film())
                    ->setTitle($faker->word())
                    ->setIdFilmTmdb(rand(1, 500))
                    ->setStatue($statue);
                    
                $manager->persist($film);

                $tv = (new Tv())
                        ->setTitle($faker->word())
                        ->setIdTvTmdb(rand(1, 500))
                        ->setStatue($statue);

                $manager->persist($tv);
            }
        }
        $manager->flush();
    }
}
