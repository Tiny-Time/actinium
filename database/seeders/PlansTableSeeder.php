<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $plans = [
            [
                'name' => 'Basic Plan',
                'slug' => 'basic-plan',
                'description' => 'Get 10 free tokens monthly to use on our platform.',
                'stripe_price_id' => '',
                'price' => 0.00,
                'tokens' => 10,
                'type' => 'free',
                'group_id' => null,
                'status' => true,
            ],
            [
                'name' => 'Pro Plan',
                'slug' => 'pro-plan-monthly',
                'description' => 'Get 100 tokens monthly to use on our platform.',
                'stripe_price_id' => 'price_1PUojFHgTxWEluLa8spD4L2m',
                'price' => 12.00,
                'tokens' => 100,
                'type' => 'monthly',
                'group_id' => null,
                'status' => true,
            ],
            [
                'name' => 'Pro Plan',
                'slug' => 'pro-plan-yearly',
                'description' => 'Get 100 tokens monthly to use on our platform.',
                'stripe_price_id' => 'price_1PUok9HgTxWEluLaBnsLsZli',
                'price' => 100.00,
                'tokens' => 100,
                'type' => 'yearly',
                'group_id' => 2,
                'status' => true,
            ],
            [
                'name' => 'Extra Token',
                'slug' => 'extra-token',
                'description' => 'Purchase extra tokens to use on our platform.',
                'stripe_price_id' => 'price_1PUogMHgTxWEluLaQkIbs2Vi',
                'price' => 15.00,
                'tokens' => 100,
                'type' => 'extra_token',
                'group_id' => null,
                'status' => true,
            ],
            [
                'name' => 'Lifetime Plan',
                'slug' => 'lifetime-plan',
                'description' => 'Get 100 tokens monthly to use on our platform.',
                'stripe_price_id' => 'price_1PUolBHgTxWEluLaNy3II1Xv',
                'price' => 500.00,
                'tokens' => 100,
                'type' => 'lifetime',
                'group_id' => null,
                'status' => true,
            ],
        ];

        foreach ($plans as $plan) {
            DB::table('plans')->updateOrInsert(
                ['slug' => $plan['slug']],
                array_merge($plan, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
