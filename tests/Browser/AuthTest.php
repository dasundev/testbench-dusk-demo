<?php

namespace Dasundev\TestbenchDuskDemo\Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Orchestra\Testbench\Attributes\WithMigration;
use Orchestra\Testbench\Dusk\TestCase;
use Orchestra\Testbench\Factories\UserFactory;
use PHPUnit\Framework\Attributes\Test;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    #[Test]
    #[WithMigration]
    public function can_authenticate_user()
    {
        $user = UserFactory::new()->create();

        $this->assertEquals('test-env', env('TEST_KEY'));

        $this->browse(static fn (Browser $browser) => $browser
            ->loginAs($user, 'web')
            ->pause(10000)
            ->assertAuthenticatedAs($user, 'web')
        );
    }
}
