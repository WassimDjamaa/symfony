<?php
namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class QuestionsControllerTest extends WebTestCase
{
    public function testVisitingWhileNotLoggedIn()
    {
        $client = static::createClient();
       
        $client->request('GET', '/questions/');
        $this->assertResponseRedirects();
    }

    public function testVisitingWhileLoggedIn()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);

        // retrieve the test user
        $testUser = $userRepository->findOneByEmail('antoine@demo.fr');

        // simulate $testUser being logged in
        $client->loginUser($testUser);

        // test e.g. the profile page
        $client->request('GET', '/questions/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Mes questions');
        
    }
}