<?php

namespace App\Http\Controllers;

use App\Models\User;

class RevenueShareController extends Controller
{
    public function calculate()
    {
        try {
            // get user dengan relasi ke mentor
            $users = User::with('watchTimes.class.mentor')->get();

            $result = [];
            $totalWaktuNonton = 0;

            // hitung total waktu tonton dari semua user
            foreach ($users as $user) {
                foreach ($user->watchTimes as $watchTime) {
                    $totalWaktuNonton += $watchTime->watch_duration;
                }
            }

            if ($totalWaktuNonton > 0) {
                foreach ($users as $user) {
                    foreach ($user->watchTimes as $watchTime) {
                        // kalkulasi persentase waktu tonton untuk setiap kelas
                        $percentage = ($watchTime->watch_duration / $totalWaktuNonton) * 100;

                        // kalkulasi pembagian pendapatan berdasarkan persentase
                        $revenueShare = round(($percentage / 100) * $watchTime->class->mentor->revenue);

                        // simpan ke dalam array result
                        $result[] = [
                            'mentor' => $watchTime->class->mentor->makeHidden(['created_at', 'updated_at']),
                            'class_name' => $watchTime->class->name,
                            'watch_duration' => $watchTime->watch_duration,
                            'revenue_share' => $revenueShare
                        ];
                    }
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Success get revenue share',
                'data' => $result
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
