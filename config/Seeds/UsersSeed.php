<?php
use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    public function run()
    {
        $hasher = new DefaultPasswordHasher();
        $password = $hasher->hash('password');

        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 10000; $i++)
        {
            $data[] = [
                'login'   => $faker->unique()->userName,
                'password'   => $password,
                'mail'      => $faker->unique()->email,
                'age'       => $faker->numberBetween($min = 16, $max = 60),
                'role'      => "user",
                'sex'       => $faker->randomElement($array = array ('male','female'))
            ];
        }

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}