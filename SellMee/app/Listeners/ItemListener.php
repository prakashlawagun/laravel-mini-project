<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\ItemNotification;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Notification;

class ItemListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
              $newItem = Item::findOrFail($event->item->id);

        $users = User::where('id', '!=', auth()->user()->id)->get();

        $data['id'] = $newItem->id;
        $data['item_name'] = $newItem->name;

        Notification::send($users, new ItemNotification($data));
    }
}
