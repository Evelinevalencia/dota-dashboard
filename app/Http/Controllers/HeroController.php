<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;
use Illuminate\Support\Facades\Redirect;

class HeroController extends Controller
{
    public function index()
    {
        $heroes = Hero::all();
        $stats = Hero::paginate(10);
        return view('heroes.index', compact('heroes', 'stats'));
    }
    public function heroStats()
    {
        $heroesstats = Hero::paginate(10);
        return view('heroes.hero_stats', compact('heroesstats'));
    }

    public function metaSuggestions()
    {
        $heroesByTier = Hero::getTopHeroesByTier();
        return view('heroes.meta_suggestions', compact('heroesByTier'));
    }

    public function proSuggestions()
    {
        $metaHeroes = Hero::getMetaSuggestions();
        return view('heroes.pro_suggestions', compact('metaHeroes'));
    }

    public function playerSuggestions($id)
    {
        $playerHeroSuggestions = Hero::getPlayerHeroSuggestions($id);
        return view('heroes.player_suggestions', compact('playerHeroSuggestions'));
    }
    public function createplayerSuggestions(Request $request)
    {
        $playerId = $request->input('player_id');
        return redirect()->to('player/' . $playerId);
    }
}
