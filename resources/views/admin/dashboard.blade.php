@extends('layouts.app')

@section('content')
<div class="min-h-screen p-6" style="background-color: #FFEDD5;">
    <h1 class="text-3xl font-bold mb-6 text-yellow-600">Dashboard</h1>

    <div class="bg-white shadow-md rounded-lg p-8">
        <h3 class="text-2xl font-semibold mb-6 text-yellow-600">User Comparison</h3>
        <div class="relative w-full max-w-3xl mx-auto">
            <canvas id="userComparisonChart" style="height: 400px;"></canvas>
        </div>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-md flex flex-col items-center">
                <svg class="w-12 h-12 mb-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.209 0 4-1.791 4-4s-1.791-4-4-4-4 1.791-4 4 1.791 4 4 4zm0 2c-2.673 0-8 1.334-8 4v2h16v-2c0-2.666-5.327-4-8-4zm8.5 5.668c.837-.47 1.5-1.35 1.5-2.335 0-1.573-1.5-2.625-3.417-3.182-.304.15-.65.265-1.033.342.007.022.012.045.019.068 2.214.782 3.431 1.742 3.431 2.772 0 .9-.687 1.675-1.718 2.079.053.083.111.158.158.256.032.063.049.13.07.199zm-16 0c.021-.069.038-.136.07-.199.047-.098.105-.173.158-.256-1.031-.404-1.718-1.179-1.718-2.079 0-1.03 1.217-1.99 3.431-2.772.007-.023.012-.046.019-.068-.383-.077-.729-.192-1.033-.342-1.917.557-3.417 1.609-3.417 3.182 0 .985.663 1.865 1.5 2.335.058.032.118.055.178.083.03.014.061.022.092.033.036.013.072.029.109.041z"/>
                </svg>
                <p class="text-xl font-semibold">Total Users</p>
                <p class="text-4xl mt-2 font-bold" id="totalUsers">{{ $totalUserCount }}</p>
            </div>
            <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-md flex flex-col items-center">
                <svg class="w-12 h-12 mb-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 2h8a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2m0 2v16h8V4zm2 9h2v4h-2zm0-7h4v1.5h-4zm0 3h4v1.5h-4z" />
                </svg>
                <p class="text-xl font-semibold">Total Lockers</p>
                <p class="text-4xl mt-2 font-bold" id="totalLockers">{{ $totalLockerCount }}</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const deliveryUserCount = parseInt({!! json_encode($deliveryUserCount) !!});
    const storageUserCount = parseInt({!! json_encode($storageUserCount) !!});

    const ctx = document.getElementById('userComparisonChart').getContext('2d');

    const userComparisonChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Delivery Users', 'Storage Users'],
            datasets: [{
                label: 'Users',
                data: [deliveryUserCount, storageUserCount],
                backgroundColor: ['rgba(255, 165, 0, 0.8)', 'rgba(0, 51, 153, 0.8)'],
                borderColor: ['rgba(255, 165, 0, 1)', 'rgba(0, 51, 153, 1)'],
                borderWidth: 3,
                barThickness: 50
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        font: {
                            size: 14
                        }
                    },
                    grid: {
                        color: 'rgba(200, 200, 200, 0.3)'
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 14
                        }
                    },
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleFont: {
                        size: 16,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 14
                    },
                    footerFont: {
                        size: 12
                    },
                    footerMarginTop: 8
                }
            }
        }
    });
</script>
@endsection
