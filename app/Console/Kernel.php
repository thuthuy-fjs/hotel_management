<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $room_numbers = DB::table('booking')
                ->join('room', 'room.id', '=', 'booking.room_id')
                ->where('booking.check_out_date', '<', now())
                ->select('number_room')
                ->get();
            foreach ($room_numbers as $room_number) {
                DB::table('room')->whereHas('bookings', function ($query) {
                    $query->where('check_out_date ', '<', now());
                })->increment('room_number', $room_number);
            }

        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
