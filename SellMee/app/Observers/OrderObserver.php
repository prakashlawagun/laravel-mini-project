<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\User;
use App\Models\Item;
use App\Notifications\OrderNotification;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        //
        $plan = Order::findOrFail($order->id);

        $item = Item::findOrFail($plan->item_id);
        $item->available_item = $item->available_item - $plan->quantity;
        $item->update();
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        //
        
        $plan = Order::findOrFail($order->id);

        if($plan->status == 'Canceled')
        {
            $user = User::findOrFail($plan->user_id);
            $data['name'] = $plan->item;
            $data['quantity'] = $plan->quantity;

            $user->notify(new OrderNotification($data));

            $item = Item::findOrFail($plan->item_id);
            $item->available_item = $item->available_item + $plan->quantity;
            $item->update();
        }
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}


