<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;

class CalendarController extends Controller
{
    public function view()
    {
        $eventos = Event::get();
        $arrayEventos = [];

        for ($i = 0; $i <  count($eventos); $i++) {
            $arrayEventos[] = [
                'title' => $eventos[$i]->summary,
                'start' => $eventos[$i]->startDateTime,
                'end' => $eventos[$i]->endDateTime
            ];
        }

        $jsonEventos = json_encode($arrayEventos);
        return view('calendar.calendar', compact('jsonEventos'));
    }
}
