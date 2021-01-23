<?php declare(strict_types = 1);

namespace App\Tests\Controller;

use App\Tests\WebTestCase;

class CommentControllerTest extends WebTestCase
{
    public function testCanCreateComment()
    {
        $client  = $this->createClient();
        $client->loginUser($this->getUserByUsername('user'));

        $entry = $this->getEntryByTitle('title');

        $crawler = $client->request('GET', $entryUrl = '/m/polityka/t/'.$entry->getId());

        $client->submit($crawler->selectButton('Gotowe')->form([
            'comment[body]' => 'przykladowa tresc',
        ]));

        self::assertResponseRedirects($entryUrl);

        $crawler = $client->followRedirect();

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('blockquote', 'przykladowa tresc');
    }
}
