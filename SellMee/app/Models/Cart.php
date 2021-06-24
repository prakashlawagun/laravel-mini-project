<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\User;

class Cart extends Model
{
    use HasFactory;
    protected $fillable=['item','price','user_id','item_id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function getItem(){
        return $this->belongsTo(Item::class,'item_id');
    }
}
