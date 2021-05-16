<?php
<<<<<<< HEAD
namespace App\Tests\Repository;

use App\Entity\Users;
=======
namespace App\tests;

use App\Entity\User;
>>>>>>> 38a5de9cba407e0ac89385af2018942a8f0eb885
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testSearchByName()
    {
        $user = $this->entityManager
<<<<<<< HEAD
            ->getRepository(Users::class)
=======
            ->getRepository(User::class)
>>>>>>> 38a5de9cba407e0ac89385af2018942a8f0eb885
            ->findOneBy(['email' => 'antoine@demo.fr'])
        ;

        $this->assertSame(1, $user->getId());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}