<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\PublicController;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class UserController extends PublicController
{
    public function show(string $id)
    {
        if ($id == 0 || $id == null) {
            return redirect()->route('login');
        }
        else {
            $current_user = auth()->user();
            $user = User::where('id', $id)->first();
            if ($current_user->id == $user->id) {
                $orders = Order::where('user_id', $user->id)->get();
                $orderQuantity = Order::where('user_id', $user->id)->count();
                return view("public.users.show", compact('user', 'orderQuantity', 'orders'));
            }
            else {
                return redirect()->route('login');
            }
        }
    }
}
