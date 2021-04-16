<?php

namespace Tests;

use CSWeb\Galaxpay\Credentials;
use PHPUnit\Framework\TestCase;

class CredentialsTest extends TestCase
{
    public function testCredentialsInstance()
    {
        $galaxId   = 5473;
        $galaxHash = '83Mw5u8988Qj6fZqS4Z8K7LzOo1j28S706R0BeFe';

        $cred = new Credentials($galaxId, $galaxHash);
        $this->assertInstanceOf(Credentials::class, $cred);
        $this->assertEquals($galaxId, $cred->getClientId());
        $this->assertEquals($galaxHash, $cred->getClientSecret());
    }
}
