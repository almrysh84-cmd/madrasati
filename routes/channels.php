<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Admin (User) channel
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Teacher channel
Broadcast::channel('App.Models.Teacher.{id}', function ($teacher, $id) {
    return (int) $teacher->id === (int) $id;
});

// Student channel
Broadcast::channel('App.Models.Student.{id}', function ($student, $id) {
    return (int) $student->id === (int) $id;
});

// Parent channel
Broadcast::channel('App.Models.My_Parent.{id}', function ($parent, $id) {
    return (int) $parent->id === (int) $id;
});

// Public notifications channel (for announcements broadcast to all)
Broadcast::channel('notifications.{guard}.{id}', function ($user, $guard, $id) {
    $guardUser = auth($guard)->user();
    return $guardUser && (int) $guardUser->id === (int) $id;
});
