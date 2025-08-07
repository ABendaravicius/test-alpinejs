<?php

namespace App\Http\Controllers;

class CheckoutController extends Controller
{
    public function __invoke()
    {
        $products = [
            [
                'id' => 1,
                'slug' => '1-month-plan', // Used for translations
                'order_route' => url(sprintf('order/%s', '1-month-plan')),
                'pricing' => [
                    'original_price' => 129.99,
                    'price' => 29.99,
                    'original_daily_price' => 4.33,
                    'daily_price' => 0.99,
                ],
                'default' => false,
            ],
            [
                'id' => 2,
                'slug' => '3-month-plan', // Used for translations
                'order_route' => url(sprintf('order/%s', '3-month-plan')),
                'pricing' => [
                    'original_price' => 179.97,
                    'price' => 39.97,
                    'original_daily_price' => 1.99,
                    'daily_price' => 0.44,
                ],
                'default' => true,
            ],
            [
                'id' => 3,
                'slug' => '6-month-plan', // Used for translations
                'order_route' => url(sprintf('order/%s', '6-month-plan')),
                'pricing' => [
                    'original_price' => 165.97,
                    'price' => 66.97,
                    'original_daily_price' => 0.92,
                    'daily_price' => 0.37,
                ],
                'default' => false,
            ],
        ];
        $routes = [
            'default_order_route' => collect($products)->where('default', true)->first()['order_route'],
            'privacy_policy' => url('privacy-policy'),
        ];
        $reviews = [
            [
                'name' => 'Dana',
                'age' => 37,
                'handle' => '@dana90s',
                'description' => 'I was skeptical, but this ADHD management hypnotherapy program helped me address underlying issues like low dopamine levels, stress and anxiety that were triggering my ADHD. What I love most about this plan is that it takes me only 10-15 minutes, and I feel like I\'m becoming more and more focused EVERY SINGLE DAY with no struggle.',
            ],
            [
                'name' => 'Ashley',
                'age' => 32,
                'handle' => '@adh990',
                'description' => 'ADHD is hard. Not having those patterns that are easily followed always create chaos in your life. This was my life and being always late was my worst problem I think. That\'s why I decided to try Happyo. It was easy to commit and now I\'m getting better and better every week!!',
            ],
            [
                'name' => 'Jim',
                'age' => 29,
                'handle' => '@Rollo_jims8544',
                'description' => 'Wish I had known about hypnotherapy earlier. I\'ve tried a lot of anti-ADHD programs, but nothing worked for me, because I needed to put in a lot of effort to see a result. But instead of putting in effort, I procrastinated. Happyo is different and hypnotherapy is actually a game-changer for people with ADHD because it\'s simply effortless.',
            ],
        ];

        return view('checkout', compact('products', 'routes'));
    }
}
