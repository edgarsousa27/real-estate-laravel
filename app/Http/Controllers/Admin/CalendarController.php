<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalendarEvents;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CalendarController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Calendar');
    }

    public function json()
    {
        $EventData = CalendarEvents::all()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start_date . ($event->start_time ? 'T' . $event->start_time : ''),
                'end' => $event->end_date ? $event->end_date . ($event->end_time ? 'T' . $event->end_time : '') : null,
                'allDay' => $event->all_day,
                'url' => $event->url,
                'color' => $event->important ? '#e3342f' : '#38c172',
                'description' => $event->description,
                'extendedProps' => [
                    'important' => $event->important,
                    'more_days' => $event->more_days
                ]
            ];
        });


        return response()->json($EventData);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        #
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'all_day' => ['boolean'],
            'more_days' => ['boolean', 'nullable'],
            'important' => ['boolean', 'nullable'],
            'start_date' => ['required', 'date'],
            'start_time' => ['date_format:H:i', 'nullable'],
            'end_date' => ['date', 'nullable'],
            'end_time' => ['date_format:H:i', 'after:start_time', 'nullable'],
            'url' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'color' => ['nullable', 'string'],
        ]);

        CalendarEvents::create($validator);

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
