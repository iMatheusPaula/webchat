<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{
    public function listMessages(User $user)
    {
        $userFrom = Auth::user()->id;
        $userTo = $user->id;

        /*
         * [from = $userFrom && to = $userTo]
         * OR
         * [from = $userTo && to = $userFrom]
         */

        $messages = Message::where(function ($query) use ($userFrom, $userTo){
            $query->where([
                'from' => $userFrom,
                'to' => $userTo
            ]);
        })->orWhere(function ($query) use ($userFrom, $userTo){
            $query->where([
                'from' => $userTo,
                'to' => $userFrom
            ]);
        })->orderBy('created_at', 'ASC')->get();

        return response()->json([
            'messages' => $messages
        ], Response::HTTP_OK,);
    }
}
