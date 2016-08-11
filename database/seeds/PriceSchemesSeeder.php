<?php

use Illuminate\Database\Seeder;
use App\PriceSchemes;

class PriceSchemesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('price_schemes')->delete();

        $this->createPrice(1, 20, 19, 1, 'credits', 'Credits buy price N.1');
        $this->createPrice(2, 60, 56, 3, 'credits', 'Credits buy price N.2');
        $this->createPrice(3, 100, 90, 5, 'credits', 'Credits buy price N.3');
        $this->createPrice(1, 20, 20, 1, 'vouchers', 'Voucher buy price N.1');
        $this->createPrice(2, 60, 60, 3, 'vouchers', 'Voucher buy price N.2');
        $this->createPrice(3, 100, 100, 5, 'vouchers', 'Voucher buy price N.3');

    }

    function createPrice($order, $credits, $price, $questions, $type, $comment){
        $scheme = new PriceSchemes();
        $scheme->fill([
            'order' => $order,
            'credits' => $credits,
            'price' => $price,
            'questions' => $questions,
            'type' => $type,
            'comment' => $comment
        ]);
        $scheme->save();
    }
}
