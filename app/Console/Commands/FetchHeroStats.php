<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Hero;

class FetchHeroStats extends Command
{
    protected $signature = 'fetch:herostats';
    protected $description = 'Fetch hero stats from OpenDota API';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $response = Http::get('https://api.opendota.com/api/herostats');
        $heroes = $response->json();

        foreach ($heroes as $hero) {
            Hero::updateOrCreate(
                ['name' => $hero['localized_name']],
                [
                    'pro_pick' => $hero['pro_pick'] ?? 0,
                    'pro_ban' => $hero['pro_ban'] ?? 0,
                    'win_rate' => $hero['pro_win'] / max($hero['pro_pick'], 1)
                ]
            );
        }

        $this->info('Hero stats fetched successfully!');
    }
}
