<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Locker;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $userCount = User::count();
        $lockerCount = Locker::count();
        return view('admin.dashboard', compact('userCount', 'lockerCount'));
    }

    public function analytics()
    {
        // User Analytics Data
        $userAnalyticsHourly = User::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('DAY(created_at) as day'),
            DB::raw('HOUR(created_at) as hour'),
            DB::raw('COUNT(*) as users')
        )->groupBy('year', 'month', 'day', 'hour')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->orderBy('day', 'asc')
        ->orderBy('hour', 'asc')
        ->get();

        $userAnalyticsDaily = User::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('DAY(created_at) as day'),
            DB::raw('COUNT(*) as users')
        )->groupBy('year', 'month', 'day')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->orderBy('day', 'asc')
        ->get();

        $userAnalyticsMonthly = User::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as users')
        )->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

        $userAnalyticsYearly = User::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as users')
        )->groupBy('year')
        ->orderBy('year', 'asc')
        ->get();

        // Locker Analytics Data
        $lockerAnalyticsHourly = Locker::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('DAY(created_at) as day'),
            DB::raw('HOUR(created_at) as hour'),
            DB::raw('COUNT(*) as lockers')
        )->groupBy('year', 'month', 'day', 'hour')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->orderBy('day', 'asc')
        ->orderBy('hour', 'asc')
        ->get();

        $lockerAnalyticsDaily = Locker::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('DAY(created_at) as day'),
            DB::raw('COUNT(*) as lockers')
        )->groupBy('year', 'month', 'day')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->orderBy('day', 'asc')
        ->get();

        $lockerAnalyticsMonthly = Locker::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as lockers')
        )->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

        $lockerAnalyticsYearly = Locker::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as lockers')
        )->groupBy('year')
        ->orderBy('year', 'asc')
        ->get();

        // Pie Chart Data
        $userLockerPercentage = User::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as users')
        )->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();

        $lockerPercentage = Locker::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as lockers')
        )->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();

        // Daily Distribution Data
        $userLockerDailyPercentage = User::select(
            DB::raw('DAY(created_at) as day'),
            DB::raw('COUNT(*) as users')
        )->groupBy('day')
        ->orderBy('day', 'asc')
        ->get();

        $lockerDailyPercentage = Locker::select(
            DB::raw('DAY(created_at) as day'),
            DB::raw('COUNT(*) as lockers')
        )->groupBy('day')
        ->orderBy('day', 'asc')
        ->get();

        return response()->json([
            'userAnalyticsHourly' => $userAnalyticsHourly,
            'userAnalyticsDaily' => $userAnalyticsDaily,
            'userAnalyticsMonthly' => $userAnalyticsMonthly,
            'userAnalyticsYearly' => $userAnalyticsYearly,
            'lockerAnalyticsHourly' => $lockerAnalyticsHourly,
            'lockerAnalyticsDaily' => $lockerAnalyticsDaily,
            'lockerAnalyticsMonthly' => $lockerAnalyticsMonthly,
            'lockerAnalyticsYearly' => $lockerAnalyticsYearly,
            'userLockerPercentage' => $userLockerPercentage,
            'lockerPercentage' => $lockerPercentage,
            'userLockerDailyPercentage' => $userLockerDailyPercentage,
            'lockerDailyPercentage' => $lockerDailyPercentage,
        ]);
    }
}
