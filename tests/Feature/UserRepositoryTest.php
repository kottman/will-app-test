<?php

namespace Tests\Feature;

use App\Models\User;
use App\Repositories\UserRepository;
use App\ValueObjects\ConstantObjects\Roles;
use App\ValueObjects\Structs\ProviderUserInfoStruct;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Tests\CreatesApplication;
use Tests\DatabaseTestCase;

class UserRepositoryTest extends DatabaseTestCase
{
    use CreatesApplication;
    use WithFaker;

    public const ADMIN_EMAIL = 'someadmin@acompany.com';
    public const ADMIN_DOMAIN = 'cloudasta.com';
    public const ADMIN_NAME_PART = 'QA';

    public function setUp(): void
    {
        parent::setUp();

        Config::set('admin-role-criteria.email', static::ADMIN_EMAIL);
        Config::set('admin-role-criteria.domain', static::ADMIN_DOMAIN);
        Config::set('admin-role-criteria.name_part', static::ADMIN_NAME_PART);
    }

    /**
     * @dataProvider emailProvider
     */
    public function testCreatedUserHasRole(array $adminFields, bool $isAdmin): void
    {
        UserRepository::storeFromProvider($this->getStruct($adminFields));
        $user = User::firstOrFail();

        $this->assertEquals($isAdmin, $user->hasRole(Roles::ROLE_ADMIN));
    }

    public function emailProvider(): array
    {
        return [
            'non admin' => [
                [
                    'email' => 'a@gmail.com',
                    'hd' => 'dasta.com',
                    'name' => 'a',
                ],
                false,
            ],
            'admin with email' => [
                [
                    'email' => static::ADMIN_EMAIL,
                    'hd' => '',
                    'name' => 'a',
                ],
                true,
            ],
            'admin with name' => [
                [
                    'email' => 'a@gmail.com',
                    'hd' => '',
                    'name' => 'a' . static::ADMIN_NAME_PART,
                ],
                true,
            ],
            'admin with domain' => [
                [
                    'email' => 'a@gmail.com',
                    'hd' => static::ADMIN_DOMAIN,
                    'name' => 'a',
                ],
                true,
            ],
        ];
    }

    protected function getStruct(array $adminFields): ProviderUserInfoStruct
    {
        $struct = new ProviderUserInfoStruct();

        $struct->name = $adminFields['name'];
        $struct->given_name = $this->faker->firstName;
        $struct->family_name = $this->faker->lastName;
        $struct->email = $adminFields['email'];
        $struct->hd = $adminFields['hd'];
        $struct->locale = Str::random(5);
        $struct->google_id = $this->faker->randomNumber(5);
        $struct->picture = $this->faker->url;
        $struct->email_verified = $this->faker->boolean;

        return $struct;
    }
}
