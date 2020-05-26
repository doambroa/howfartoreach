<?php
use Migrations\AbstractSeed;

/**
 * CarsUsers seed.
 */
class CarsUsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 20000; $i++){ //ojo, los ids de cars y users tienen que estar ordenados

            $tipoConduccion = $faker->randomElement($array = array ('Eco','Normal','Sport'));

            if($tipoConduccion == 'Normal'){
                $consumoCiudad      = $faker->randomFloat(3, 3.5, 13);
                $consumoAutopista   = $faker->randomFloat(3, 3, $consumoCiudad+1);
                $combinado          = $faker->randomFloat(3, $consumoAutopista, $consumoCiudad);
            } else if($tipoConduccion == 'Eco'){
                $consumoCiudad      = $faker->randomFloat(3, 3, 10);
                $consumoAutopista   = $faker->randomFloat(3, 3, $consumoCiudad);
                $combinado          = $faker->randomFloat(3, $consumoAutopista, $consumoCiudad);
            } else if ($tipoConduccion == 'Sport'){
                $consumoCiudad      = $faker->randomFloat(3, 5, 20);
                $consumoAutopista   = $faker->randomFloat(3, 3, $consumoCiudad+2);
                $combinado          = $faker->randomFloat(3, $consumoAutopista, $consumoCiudad+1);
            }


            $data[] = [
                'car_id' => $faker->numberBetween($min = 1, 1021),
                'user_id'  => $faker->numberBetween($min = 1, 10005),
                'consumoCiudad'      => $consumoCiudad,
                'consumoAutopista'   => $consumoAutopista,
                'combinado'      => $combinado,
                'tipoConduccion' => $tipoConduccion
            ];
        }

        $table = $this->table('cars_users');
        $table->insert($data)->save();
    }
}