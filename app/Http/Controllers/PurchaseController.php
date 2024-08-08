<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\WatchTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function purchase(Request $request)
    {
        DB::beginTransaction();

        try {
            // validasi request data
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|numeric|exists:users,id',
                'subscription_id' => 'required|numeric|exists:subscriptions,id'
            ]);

            // check jika validasi gagal
            if ($validator->fails()) {
                DB::rollBack();
                return response()->json([
                    'status' => 400,
                    'message' => 'Validation error',
                    'error' => $validator->messages()
                ], 400);
            }

            // inisiasi admin fee, tax, ppn etc
            $admin_fee = 2500;
            $platform_fee = 5000;
            $ppn = 10; // 10%

            // get subscription data
            $subscription = Subscription::find($request->input('subscription_id'));
            if (!$subscription) {
                DB::rollBack();
                return response()->json([
                    'status' => 404,
                    'message' => 'Error not found',
                    'error' => 'Subscripton not found'
                ], 404);
            }

            // kalkulasi pengurangan biaya 
            $ppn_amount = $subscription->price * ($ppn / 100);
            $total_deduction = $admin_fee + $platform_fee + $ppn_amount;
            $total_bill_amount = $subscription->price + $total_deduction;
            $total_net_amount = $subscription->price - $total_deduction;

            $product_detail = 'Pembelian paket ' . $subscription->name;

            // kalkulasi mentor revenue
            $classes = $subscription->classes; // get class yang berelasi ke subscription
            $mentors = $classes->pluck('mentor_id')->unique(); // Get unique mentor IDs

            // return response()->json([$classes]);

            // hitung jumlah mentor
            $mentorCount = $mentors->count();

            // kalkulasi revenue bagi per mentor
            $bagiRevenue = $total_net_amount / ($mentorCount + 1);

            // tambah revenue mentor
            foreach ($mentors as $value) {
                $mentor = Mentor::find($value);

                if ($mentor) {
                    $mentor->revenue += $bagiRevenue;
                    $mentor->save();
                }
            }

            // simpan waktu tonton user
            foreach ($classes as $class) {
                WatchTime::create([
                    'user_id' => $request->input('user_id'),
                    'class_id' => $class->id,
                    'watch_duration' => $class->duration,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

            // simpan data purchase ke table transaction
            $purchase = Transaction::create([
                'user_id' => request()->input('user_id'),
                'subscription_id' => request()->input('subscription_id'),
                'product_detail' => $product_detail,
                'admin_fee' => $admin_fee,
                'platform_fee' => $platform_fee,
                'ppn_amount' => $ppn_amount,
                'total_deduction' => $total_deduction,
                'bill_amount' => $subscription->price,
                'total_bill_amount' => $total_bill_amount,
                'total_net_amount' => $total_net_amount,
                'npat' => $bagiRevenue,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Commit the transaction
            DB::commit();

            return response()->json([
                "status" => 201,
                'message' => 'Purchase successfully!',
                'data' => $purchase
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
