<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Employee::class, 10)->create()->each(function ($emp) {
            $emp->profile()->create([
                'avatar' => 'default.png',
                'gender' => rand(0,1),
                'birthdate' => date('Y-m-d', rand(1252055681,1262055681)),
                'contact' => '09123456789',
                'user_id' => NULL,
                'emp_id' => $emp->id,
            ])->make();

            $emp->profile->address()->create([
                'number' => rand(0,100),
                'street' => 'Sto. Rosario',
                'city' => 'Angeles City',
                'state' => 'Pampanga',
                'zip' => '2009',
                'country' => 'Philippines',
                'profile_id' => $emp->profile->id
            ])->make();

            $emp->preference()->create([
                'emp_id' => $emp->id,
                'dayoff' => str_shuffle('0011000'),
                'shift' => $this->getShift(),
                'rest' => rand(8, 16)
            ])->make();
        });
    }

    public function getShift()
    {
        $shift = \App\Shift::all()->random();
        if($shift){
            return $shift->id;
        }
        return NULL;
    }
}
