<?php

namespace TelegramBot\Api\Test\Types;

use TelegramBot\Api\InvalidArgumentException;
use TelegramBot\Api\Test\AbstractTypeTest;
use TelegramBot\Api\Types\User;

class UserTest extends AbstractTypeTest
{
    protected static function getType()
    {
        return User::class;
    }

    public static function getMinResponse()
    {
        return [
            'id' => 123456,
            'first_name' => 'Ilya',
        ];
    }

    public static function getFullResponse()
    {
        return [
            'id' => 123456,
            'first_name' => 'Ilya',
            'last_name' => 'Gusev',
            'username' => 'iGusev',
            'language_code' => 'en',
            'is_premium' => false,
            'added_to_attachment_menu' => false,
            'can_join_groups' => true,
            'can_read_all_group_messages' => true,
            'supports_inline_queries' => false,
            'is_bot' => false,
        ];
    }

    /**
     * @param User $item
     * @return void
     */
    protected function assertMinItem($item)
    {
        $this->assertEquals(123456, $item->getId());
        $this->assertEquals('Ilya', $item->getFirstName());

        $this->assertNull($item->getLastName());
        $this->assertNull($item->getUsername());
        $this->assertNull($item->getLanguageCode());
        $this->assertNull($item->getIsPremium());
        $this->assertNull($item->getAddedToAttachmentMenu());
        $this->assertNull($item->getCanJoinGroups());
        $this->assertNull($item->getCanReadAllGroupMessages());
        $this->assertNull($item->getSupportsInlineQueries());
        $this->assertNull($item->isBot());
    }

    /**
     * @param User $item
     * @return void
     */
    protected function assertFullItem($item)
    {
        $this->assertEquals(123456, $item->getId());
        $this->assertEquals('Ilya', $item->getFirstName());
        $this->assertEquals('Gusev', $item->getLastName());
        $this->assertEquals('iGusev', $item->getUsername());
        $this->assertEquals('en', $item->getLanguageCode());
        $this->assertEquals(false, $item->getIsPremium());
        $this->assertEquals(false, $item->getAddedToAttachmentMenu());
        $this->assertEquals(true, $item->getCanJoinGroups());
        $this->assertEquals(true, $item->getCanReadAllGroupMessages());
        $this->assertEquals(false, $item->getSupportsInlineQueries());
        $this->assertEquals(false, $item->isBot());
    }

    public function testSet64bitId()
    {
        $item = new User();
        $item->setId(2147483648);
        $this->assertEquals(2147483648, $item->getId());
    }

    public function testSetIdException()
    {
        $this->expectException(InvalidArgumentException::class);

        $item = new User();
        $item->setId('s');
    }

    public function testFromResponseException1()
    {
        $this->expectException(InvalidArgumentException::class);

        User::fromResponse([
            'last_name' => 'Gusev',
            'id' => 123456,
            'username' => 'iGusev'
        ]);
    }

    public function testFromResponseException2()
    {
        $this->expectException(InvalidArgumentException::class);

        User::fromResponse([
            'first_name' => 'Ilya',
            'last_name' => 'Gusev',
            'username' => 'iGusev'
        ]);
    }

    public function testSetAndGetFirstName()
    {
        $item = new User();
        $item->setFirstName('John');
        $this->assertEquals('John', $item->getFirstName());
    }

    public function testSetAndGetLastName()
    {
        $item = new User();
        $item->setLastName('Doe');
        $this->assertEquals('Doe', $item->getLastName());
    }

    public function testSetAndGetUsername()
    {
        $item = new User();
        $item->setUsername('johndoe');
        $this->assertEquals('johndoe', $item->getUsername());
    }

    public function testSetAndGetLanguageCode()
    {
        $item = new User();
        $item->setLanguageCode('en');
        $this->assertEquals('en', $item->getLanguageCode());
    }

    public function testSetAndGetIsBot()
    {
        $item = new User();
        $item->setIsBot(true);
        $this->assertTrue($item->isBot());
    }

    public function testSetAndGetIsPremium()
    {
        $item = new User();
        $item->setIsPremium(true);
        $this->assertTrue($item->getIsPremium());
    }

    public function testSetAndGetAddedToAttachmentMenu()
    {
        $item = new User();
        $item->setAddedToAttachmentMenu(true);
        $this->assertTrue($item->getAddedToAttachmentMenu());
    }

    public function testSetAndGetCanJoinGroups()
    {
        $item = new User();
        $item->setCanJoinGroups(true);
        $this->assertTrue($item->getCanJoinGroups());
    }

    public function testSetAndGetCanReadAllGroupMessages()
    {
        $item = new User();
        $item->setCanReadAllGroupMessages(true);
        $this->assertTrue($item->getCanReadAllGroupMessages());
    }

    public function testSetAndGetSupportsInlineQueries()
    {
        $item = new User();
        $item->setSupportsInlineQueries(true);
        $this->assertTrue($item->getSupportsInlineQueries());
    }

}
