@extends('master/master')
@section('content')
<h1>Dota Hero Stats</h1>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Pro Picks</th>
                    <th>Pro Bans</th>
                    <th>Win Rate</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($heroesstats as $hero)
                    <tr>
                        <td>{{ $hero->id }}</td>
                        <td>{{ $hero->name }}</td>
                        <td>{{ $hero->pro_pick }}</td>
                        <td>{{ $hero->pro_ban }}</td>
                        <td>{{ $hero->win_rate }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $heroesstats->links() }}
    </div>
@stop
