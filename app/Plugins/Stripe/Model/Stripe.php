<?php

namespace App\Plugins\Stripe\Model;

use Illuminate\Database\Eloquent\Model;

class Stripe extends Model
{
    protected $table = 'stripe';

    protected $fillable = ['image_url', 'processing_fee','base_currency', 'supported_currencies'];
}
