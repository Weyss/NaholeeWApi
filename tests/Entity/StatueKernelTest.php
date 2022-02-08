<?php

namespace App\Tests\Entity;

use App\Entity\Statue;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class StatueKernelTest extends KernelTestCase
{
    /**
     * Créé un nouveau Film
     */
    public function getEntity(): Statue
    {
        return (new Statue())->setStatue("A voir");
    }

    /**
     * Assert pour les erreurs et envoye des messages si c'est le cas
     */
    public function assertErrors(int $number, Statue $statue): void
    {
        self::bootKernel();
        $errors = static::getContainer()->get(ValidatorInterface::class)->validate($statue);
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
    public function testValidEntity()
    {
        $this->assertErrors(0, $this->getEntity());
    }

    /**
     * Test si le titre est vide
     */
    public function testInvalidBlankTitle(){
        $this->assertErrors(1, $this->getEntity()->setStatue(""));
    }

    /**
     * Test si le titre ne dépasse pas le nombre de caratères
     */
    public function testInvalidLengthTitle(){
        $this->assertErrors(1, $this->getEntity()->setStatue("
            Lorem ipsum dolor sit amet. Non voluptates inventore aut eveniet repudiandae ut omnis dolorem! 
            Ad aliquam reprehenderit eos voluptas aspernatur aut voluptatem amet?
            Ea quis minus sed harum similique ad modi sint a assumenda tempore et temporibus omnis ut sint nisi ad iusto provident. 
        "));
    }

    /**
     * Test si le titre n'est pas une chaîne de caractère
     */
    public function testInvalidTypeTitle(){
        $this->assertIsNotString(192304);
    }
}
