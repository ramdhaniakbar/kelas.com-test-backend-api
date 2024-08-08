<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PivotSubscriptionClass extends Model
{
   use HasFactory;

   protected $table = 'pivot_subscription_classes';

   protected $dates = [
      'created_at',
      'updated_at',
   ];

   protected $fillable = [
      'subscription_id',
      'class_model_id',
      'created_at',
      'updated_at'
   ];
}
