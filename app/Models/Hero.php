<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Hero extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'pro_pick',
        'pro_ban',
        'win_rate'
    ];

    public static function getTopHeroesByTier($tierCount = 8, $heroesPerTier = 10)
    {
        $heroes = self::orderBy('win_rate', 'desc')->get();
        $totalHeroes = $heroes->count();
        $heroesPerTier = min($heroesPerTier, $totalHeroes);
        $heroesByTier = [];

        for ($i = 0; $i < $tierCount; $i++) {
            $start = $i * $heroesPerTier;
            $heroesByTier[$i + 1] = $heroes->slice($start, $heroesPerTier);
        }

        return $heroesByTier;
    }
    public static function getMetaSuggestions($limit = 10)
    {
        $pickWeight = 0.4;
        $banWeight = 0.3;
        $winRateWeight = 0.3;

        $heroes = self::all()->map(function ($hero) use ($pickWeight, $banWeight, $winRateWeight) {
            $hero->score = ($hero->pro_pick * $pickWeight) +
                           ($hero->pro_ban * $banWeight) +
                           ($hero->win_rate * $winRateWeight);
            return $hero;
        });

        return $heroes->sortByDesc('score')->take($limit);
    }
    public static function getPlayerData($accountId)
    {
        $response = Http::get("https://api.opendota.com/api/players/{$accountId}/heroes");
        return $response->json();
    }

    public static function getPlayerHeroSuggestions($accountId, $limit = 10)
    {
        $playerHeroes = self::getPlayerData($accountId);
        if (empty($playerHeroes)) {
            return [];
        }

        $heroes = self::all();
        $suggestions = collect();

        foreach ($playerHeroes as $playerHero) {
            $hero = $heroes->firstWhere('id', $playerHero['hero_id']);
            if ($hero) {
                $suggestions->push([
                    'hero' => $hero,
                    'games' => $playerHero['games'],
                    'win' => $playerHero['win'],
                    'win_rate' => $playerHero['win'] / max($playerHero['games'], 1)
                ]);
            }
        }

        return $suggestions->sortByDesc('win_rate')->take($limit);
    }
}

