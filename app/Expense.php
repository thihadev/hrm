<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{

	protected $fillable = ["user_id", "item", "purchase_from", "date_of_purchase", "amount"];

    public function employee()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
