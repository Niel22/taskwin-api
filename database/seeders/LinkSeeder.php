<?php

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            [
                'title' => 'Telegram',
                'slug' => 'telegram',
                'url' => 'https://t.me/tradeswin', 
            ],
            [
                'title' => 'WhatsApp',
                'slug' => 'whatsapp',
                'url' => 'https://wa.me/2348012345678', 
            ],
            [
                'title' => 'Email',
                'slug' => 'email',
                'url' => 'mailto:support@tradeswin.com',
            ],
        ];

        foreach ($links as $link) {
            Link::firstOrCreate(
                ['slug' => $link['slug']],
                [
                    'title' => $link['title'],
                    'url' => $link['url'],
                ]
            );
        }
    }
}
