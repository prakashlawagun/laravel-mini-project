<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Item extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $fillable =['name','available_item','price_per'];

  public function orders(){
      return $this->hasMany(Order::class,'item_id');
  }
}
