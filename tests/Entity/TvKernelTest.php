<?php

namespace App\Tests\Entity;

use App\Entity\Tv;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TvKernelTest extends KernelTestCase
{
    /**
     * Créé un nouveau Tv
     */
    public function getTv(): Tv
    {
        return (new Tv)->setTitle("Rugal")
                        ->setIdTvTmdb(192304)
                        ->setCountry('French');
    }

    /**
     * Assert pour les erreurs et envoye des messages si c'est le cas
     */
    public function assertErrors(int $number, Tv $tv): void
    {
        self::bootKernel();
        $errors = static::getContainer()->get(ValidatorInterface::class)->validate($tv);
        $messages = [];
        /** @var ConstraintViolation $error */
        foreach($errors as $error){
            $messages[] = $error->getPropertyPath() . '=>' . $error->getMessage();
        }
        $this->assertCount($number, $errors, implode(',', $messages));
    }

    /**
     * Test de la validité de l'entitée
     */
    public function testValidFilm()
    {
        $this->assertErrors(0, $this->getTv());
    }

    /**
     * Test si le titre est vide
     */
    public function testInvalidBlankTitle(){
        $this->assertErrors(1, $this->getTv()->setTitle(""));
    }

    /**
     * Test si le titre n'est pas une chaîne de caractère
     */
    public function testInvalidTypeTitle(){
        $this->assertIsNotString($this->getTv()->setTitle(192304));
    }

    /**
     * Test si le titre ne dépasse pas le nombre de caratères
     */
    public function testInvalidLengthTitle(){
        $this->assertErrors(1, $this->getTv()->setTitle("
            Lorem ipsum dolor sit amet. Non voluptates inventore aut eveniet repudiandae ut omnis dolorem! 
            Ad aliquam reprehenderit eos voluptas aspernatur aut voluptatem amet?
            Ea quis minus sed harum similique ad modi sint a assumenda tempore et temporibus omnis ut sint nisi ad iusto provident. 
            Qui excepturi ducimus quo molestiae inventore ea nulla minima ad impedit quia in Quis doloribus rem amet rerum.
            Ad maiores reprehenderit qui temporibus aspernatur est impedit quia sit aliquid dolores. 
            Non galisum dignissimos et suscipit omnis in natus quos At vero blanditiis in praesentium magni ea necessitatibus earum. 
            33 velit magnam et aliquid repudiandae sit placeat odio eos architecto neque. 
            Ea natus laborum nam rerum minima et deserunt temporibus sit tenetur quod.
        "));
    }

    /**
     * Test si le titre n'est pas un chiffre ou un nombre
     */
    public function testInvalidTypeIdTmdb(){
        $this->assertIsNotInt('The Witcher');
    }

     /**
     * Test si le pays est vide
     */
    public function testInvalidBlankCountry(){
        $this->assertErrors(0, $this->getTv()->setCountry(""));
    }

    /**
     * Test si le pays n'est pas une chaîne de caractère
     */
    public function testInvalidTypeCountry(){
        $this->assertIsNotString($this->getTv()->setCountry(192304));
    }

    /**
     * Test si le pays ne dépasse pas le nombre de caratères
     */
    public function testInvalidLengthCountry(){
        $this->assertErrors(1, $this->getTv()->setCountry("
            Lorem ipsum dolor sit amet. Non voluptates inventore aut eveniet repudiandae ut omnis dolorem! 
            Ad aliquam reprehenderit eos voluptas aspernatur aut voluptatem amet?
            Ea quis minus sed harum similique ad modi sint a assumenda tempore et temporibus omnis ut sint nisi ad iusto provident. 
            Qui excepturi ducimus quo molestiae inventore ea nulla minima ad impedit quia in Quis doloribus rem amet rerum.
            Ad maiores reprehenderit qui temporibus aspernatur est impedit quia sit aliquid dolores. 
            Non galisum dignissimos et suscipit omnis in natus quos At vero blanditiis in praesentium magni ea necessitatibus earum. 
            33 velit magnam et aliquid repudiandae sit placeat odio eos architecto neque. 
            Ea natus laborum nam rerum minima et deserunt temporibus sit tenetur quod.
        "));
    }
}
