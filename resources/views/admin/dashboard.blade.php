<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="min-h-screen p-6" style="background-color: #FFEDD5;">
    <h1 class="text-3xl mb-6 text-yellow-600 font-bold">ADMIN DASHBOARD</h1>
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-yellow-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <h2 class="text-xl font-bold text-orange-600">Users</h2>
            <p class="text-4xl font-bold">{{ $userCount }}</p>
        </div>
        <div class="bg-yellow-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <h2 class="text-xl font-bold text-orange-600">Lockers</h2>
            <p class="text-4xl font-bold">{{ $lockerCount }}</p>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div class="bg-white p-6 rounded-lg shadow-lg mb-4">
            <h2 class="text-2xl font-bold mb-2">User Analytics (Hourly)</h2>
            <canvas id="userAnalyticsHourly"></canvas>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg mb-4">
            <h2 class="text-2xl font-bold mb-2">User Analytics (Daily)</h2>
            <canvas id="userAnalyticsDaily"></canvas>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg mb-4">
            <h2 class="text-2xl font-bold mb-2">User Analytics (Monthly)</h2>
            <canvas id="userAnalyticsMonthly"></canvas>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg mb-4">
            <h2 class="text-2xl font-bold mb-2">User Analytics (Yearly)</h2>
            <canvas id="userAnalyticsYearly"></canvas>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg mb-4">
            <h2 class="text-2xl font-bold mb-2">Locker Analytics (Hourly)</h2>
            <canvas id="lockerAnalyticsHourly"></canvas>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg mb-4">
            <h2 class="text-2xl font-bold mb-2">Locker Analytics (Daily)</h2>
            <canvas id="lockerAnalyticsDaily"></canvas>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg mb-4">
            <h2 class="text-2xl font-bold mb-2">Locker Analytics (Monthly)</h2>
            <canvas id="lockerAnalyticsMonthly"></canvas>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg mb-4">
            <h2 class="text-2xl font-bold mb-2">Locker Analytics (Yearly)</h2>
            <canvas id="lockerAnalyticsYearly"></canvas>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg mb-4">
            <h2 class="text-2xl font-bold mb-2">Period Comparison (Hourly)</h2>
            <canvas id="periodComparisonHourly"></canvas>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg mb-4">
            <h2 class="text-2xl font-bold mb-2">Period Comparison (Daily)</h2>
            <canvas id="periodComparisonDaily"></canvas>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg mb-4">
            <h2 class="text-2xl font-bold mb-2">Period Comparison (Monthly)</h2>
            <canvas id="periodComparisonMonthly"></canvas>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg mb-4">
            <h2 class="text-2xl font-bold mb-2">Period Comparison (Yearly)</h2>
            <canvas id="periodComparisonYearly"></canvas>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg mb-4">
            <h2 class="text-2xl font-bold mb-2">User and Locker Distribution (Monthly)</h2>
            <canvas id="userLockerDistributionMonthly"></canvas>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg mb-4">
            <h2 class="text-2xl font-bold mb-2">User and Locker Distribution (Daily)</h2>
            <canvas id="userLockerDistributionDaily"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    fetch('{{ route('admin.analytics') }}')
        .then(response => response.json())
        .then(data => {
            const createChart = (elementId, chartData, label) => {
                const ctx = document.getElementById(elementId).getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: chartData.map(item => `${item.year}-${String(item.month).padStart(2, '0')}-${String(item.day).padStart(2, '0')} ${String(item.hour).padStart(2, '0')}:00`),
                        datasets: [{
                            label: label,
                            data: chartData.map(item => item.users || item.lockers),
                            borderColor: 'rgba(255, 159, 64, 1)',
                            borderWidth: 2,
                            fill: false,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                display: true,
                                title: {
                                    display: true,
                                    text: 'Time'
                                }
                            },
                            y: {
                                display: true,
                                title: {
                                    display: true,
                                    text: 'Count'
                                }
                            }
                        }
                    }
                });
            };

            // User Analytics Charts
            createChart('userAnalyticsHourly', data.userAnalyticsHourly, 'Users per Hour');
            createChart('userAnalyticsDaily', data.userAnalyticsDaily, 'Users per Day');
            createChart('userAnalyticsMonthly', data.userAnalyticsMonthly, 'Users per Month');
            createChart('userAnalyticsYearly', data.userAnalyticsYearly, 'Users per Year');

            // Locker Analytics Charts
            createChart('lockerAnalyticsHourly', data.lockerAnalyticsHourly, 'Lockers per Hour');
            createChart('lockerAnalyticsDaily', data.lockerAnalyticsDaily, 'Lockers per Day');
            createChart('lockerAnalyticsMonthly', data.lockerAnalyticsMonthly, 'Lockers per Month');
            createChart('lockerAnalyticsYearly', data.lockerAnalyticsYearly, 'Lockers per Year');

            // Period Comparison Charts
            createChart('periodComparisonHourly', data.userAnalyticsHourly.concat(data.lockerAnalyticsHourly), 'Users and Lockers per Hour');
            createChart('periodComparisonDaily', data.userAnalyticsDaily.concat(data.lockerAnalyticsDaily), 'Users and Lockers per Day');
            createChart('periodComparisonMonthly', data.userAnalyticsMonthly.concat(data.lockerAnalyticsMonthly), 'Users and Lockers per Month');
            createChart('periodComparisonYearly', data.userAnalyticsYearly.concat(data.lockerAnalyticsYearly), 'Users and Lockers per Year');

            // Pie Chart for User and Locker Distribution (Monthly)
            const ctxPieMonthly = document.getElementById('userLockerDistributionMonthly').getContext('2d');
            new Chart(ctxPieMonthly, {
                type: 'pie',
                data: {
                    labels: data.userLockerPercentage.map(item => `Month ${item.month}`),
                    datasets: [{
                        label: 'Users',
                        data: data.userLockerPercentage.map(item => item.users),
                        backgroundColor: 'rgba(255, 159, 64, 0.6)',
                    }, {
                        label: 'Lockers',
                        data: data.lockerPercentage.map(item => item.lockers),
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'User and Locker Distribution (Monthly)'
                        }
                    }
                }
            });

            // Pie Chart for User and Locker Distribution (Daily)
            const ctxPieDaily = document.getElementById('userLockerDistributionDaily').getContext('2d');
            new Chart(ctxPieDaily, {
                type: 'pie',
                data: {
                    labels: data.userLockerDailyPercentage.map(item => `Day ${item.day}`),
                    datasets: [{
                        label: 'Users',
                        data: data.userLockerDailyPercentage.map(item => item.users),
                        backgroundColor: 'rgba(255, 159, 64, 0.6)',
                    }, {
                        label: 'Lockers',
                        data: data.lockerDailyPercentage.map(item => item.lockers),
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'User and Locker Distribution (Daily)'
                        }
                    }
                }
            });
        });
});
</script>
@endsection
