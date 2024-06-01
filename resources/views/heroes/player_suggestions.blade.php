@extends('master/master')
@section('content')
    <h1>Hero Suggestions for Player</h1>

    @if (count($playerHeroSuggestions) > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Hero</th>
                        <th>Games Played</th>
                        <th>Wins</th>
                        <th>Win Rate</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($playerHeroSuggestions as $suggestion)
                    <tr>
                        <td>{{ $suggestion['hero']->name }}</td>
                        <td>{{ $suggestion['games'] }}</td>
                        <td>{{ $suggestion['win'] }}</td>
                        <td>{{ $suggestion['win_rate'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>No data available for this player.</p>
    @endif
@stop
