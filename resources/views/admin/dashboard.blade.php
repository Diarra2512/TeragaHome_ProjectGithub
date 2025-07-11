@extends('layouts.admin')

@section('content')
<style>
    body {
        background-color: #f8f5f0;
    }

    .dashboard-admin {
        padding: 30px;
    }

    .dashboard-admin h2 {
        color: #3d4b2e;
        font-weight: bold;
        margin-bottom: 30px;
    }

    .card {
        background-color: #f0f4ed;
        border: none;
        border-left: 5px solid #3d4b2e;
        color: #333;
        transition: all 0.3s ease;
        border-radius: 15px;
    }

    .card:hover {
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        transform: translateY(-3px);
    }

    .card h3 {
        font-size: 2.2rem;
        font-weight: bold;
        color: #3d4b2e;
    }

    .card p {
        font-size: 1rem;
        color: #6b6b6b;
    }

    canvas {
        background-color: #fff;
        border-radius: 15px;
        padding: 15px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
</style>

<div class="dashboard-admin">
    <h2>Statistiques</h2>

    <div class="row mb-5">
        <div class="col-md-4 mb-3">
            <div class="card text-center p-4">
                <h3>{{ $nbUsers }}</h3>
                <p>Utilisateurs enregistrés</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-center p-4">
                <h3>{{ $nbProperties }}</h3>
                <p>Annonces publiées</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-center p-4">
                <h3>{{ $nbRequests }}</h3>
                <p>Demandes reçues</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <canvas id="userChart" height="300"></canvas>
        </div>
        <div class="col-md-6 mb-4">
            <canvas id="requestChart" height="300"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const userCtx = document.getElementById('userChart');
    new Chart(userCtx, {
        type: 'doughnut',
        data: {
            labels: ['Utilisateurs', 'Annonces'],
            datasets: [{
                data: [{{ $nbUsers }}, {{ $nbProperties }}],
                backgroundColor: ['#6c8e50', '#c4c4c4'],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    const requestCtx = document.getElementById('requestChart');
    new Chart(requestCtx, {
        type: 'bar',
        data: {
            labels: ['Demandes'],
            datasets: [{
                label: 'Nombre de demandes',
                data: [{{ $nbRequests }}],
                backgroundColor: '#6c8e50',
                borderRadius: 8,
                barThickness: 40
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endpush
