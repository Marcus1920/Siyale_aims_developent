<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
//https://laracasts.com/discuss/channels/laravel/help-is-neededd-on-idle-session-time-out
//http://www.smarttutorials.net/session-timeout-warning-popup-countdown-using-jquery-php/

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxCheck()
    {
        $maxIdleBeforeLogout  = 15 * 1;
        $maxIdleBeforeWarning = 10 * 1;
        $warningTime          = $maxIdleBeforeLogout - $maxIdleBeforeWarning;
        $lastActive           = Session::get('lastActive');
        $idleTime             = date('U') - $lastActive;


        // Warn user they will be logged out if idle for too long
        if ($idleTime > $maxIdleBeforeWarning && empty(Session::get('idleWarningDisplayed'))) {

            Session::set('idleWarningDisplayed', true);
            return 'You have ' . $warningTime . ' seconds left before you are logged out';
        }

        // Log out user if idle for too long
        if ($idleTime > $maxIdleBeforeLogout && empty(Session::get('logoutWarningDisplayed'))) {

            // *** Do stuff to log out user here

            Session::set('logoutWarningDisplayed', true);
            return 'loggedOut';
        }

        return '';
    }

    public function resetSession() {

        Session::set('lastActive',date('U'));
        Session::forget('idleWarningDisplayed');
        Session::forget('logoutWarningDisplayed');

    }

}
