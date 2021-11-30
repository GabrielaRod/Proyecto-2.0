<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateNotificationRequest;


class NotificationsController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('notifications_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notifications = Notification::all();

        return view('notifications.index', compact('notifications'));
    }

    public function show($id)
    {
        //abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notification = DB::table('notifications')
            ->where('id', $id)
            ->first();

        if ($notification) {
            $notification->Read == 1;
            return redirect($notification->data['link']);
        }
    }

    public function updateNotifications(Request $request)
    {  
        //dd($request[]);

       foreach ($request->notifications as $notification) {

            

            DB::table('notifications')
            ->where('id', $notification["id"])
            ->update(['Read' => 1]);

        }

        //return $request;
        
    }

    public function unreadNotifications(){

        $notifications = DB::table('notifications')
            ->where('Read', false)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

            return $notifications;
    }
}
