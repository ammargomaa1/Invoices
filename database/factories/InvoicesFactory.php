<?php

namespace Database\Factories;

use App\Models\Invoices;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoicesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoices::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'invoice_number'=>$this->faker->unique()->numberBetween(1000,10000),
            'invoice_date'=>$this->faker->date('Y-m-d', 'now'),
            'due_date'=>$this->faker->date('Y-m-d', 'now'),
            'product'=>$this->faker->word,
            'section'=>$this->faker->word,
            'discount'=>$this->faker->numberBetween(1,20),
            'rate_vat'=>$this->faker->randomFloat(0,2),
            'value_vat'=>$this->faker->numberBetween(0,50),
            'total'=>$this->faker->numberBetween(100,10000),
            'status'=>$this->faker->boolean(),
            'value_status'=>$this->faker->numberBetween(1,500),
            'note'=>$this->faker->paragraph(3),
            'user'=>$this->faker->name
                        //
        ];
    }
}
