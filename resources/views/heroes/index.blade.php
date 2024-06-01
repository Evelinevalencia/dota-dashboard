@extends('master/master')
@section('content')
<h1 class="my-4">Dota Hero Stats Dashboard</h1>

<div class="row">
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card bg-primary text-white shadow">
            <div class="card-body">
                <h5 class="card-title">Total Heroes</h5>
                <p class="card-text">{{ $heroes->count() }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card bg-success text-white shadow">
            <div class="card-body">
                <h5 class="card-title">Top Picked Hero</h5>
                <p class="card-text">{{ $heroes->sortByDesc('pro_pick')->first()->name }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card bg-danger text-white shadow">
            <div class="card-body">
                <h5 class="card-title">Top Banned Hero</h5>
                <p class="card-text">{{ $heroes->sortByDesc('pro_ban')->first()->name }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card bg-warning text-white shadow">
            <div class="card-body">
                <h5 class="card-title">Highest Win Rate</h5>
                <p class="card-text">{{ $heroes->sortByDesc('win_rate')->first()->name }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Hero Win Rate Chart</h6>
            </div>
            <div class="card-body">
                <canvas id="winRateChart"></canvas>
            </div>
            <div class="d-flex justify-content-center">
                {{ $stats->links() }}
            </div>
        </div>
    </div>
</div>


<script>
    var ctx = document.getElementById('winRateChart').getContext('2d');
    var winRateChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($stats->pluck('name')) !!},
            datasets: [{
                label: 'Win Rate',
                data: {!! json_encode($stats->pluck('win_rate')) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@stop
