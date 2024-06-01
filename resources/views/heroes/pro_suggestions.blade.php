@extends('master/master')
@section('content')
    <h1>Meta Suggestions Based on Pro Pick + Ban and Win Rate</h1>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Pro Picks</th>
                    <th>Pro Bans</th>
                    <th>Win Rate</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($metaHeroes as $hero)
                        <tr>
                            <td>{{ $hero->name }}</td>
                            <td>{{ $hero->pro_pick }}</td>
                            <td>{{ $hero->pro_ban }}</td>
                            <td>{{ $hero->win_rate }}</td>
                            <td>{{ $hero->score }}</td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
@stop
