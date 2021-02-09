<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentOne = Payment::create([
            'from_card_id' => Card::find(1)->id,
            'to_card_id' => Card::find(2)->id,
            'description' => 'Переказ',
            'status' => 'Успiшно',
            'total' => '100'
        ]);
        $paymentTwo = Payment::create([
            'from_card_id' => Card::find(1)->id,
            'to_card_id' => Card::find(2)->id,
            'description' => 'Переказ',
            'status' => 'Успiшно',
            'total' => '200'
        ]);
        $paymentThree = Payment::create([
            'from_card_id' => Card::find(1)->id,
            'to_card_id' => Card::find(2)->id,
            'description' => 'Переказ',
            'status' => 'Успiшно',
            'total' => '349'
        ]);
    }
}
