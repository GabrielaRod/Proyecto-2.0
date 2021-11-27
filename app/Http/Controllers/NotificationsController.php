<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class NotificationsController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('notifications_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notifications = Notification::all();

        return view('notifications.index', compact('notifications'));
    }

    public function show(Notification $notification)
    {
        //abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('notifications.show', compact('notification'));
    }
}
