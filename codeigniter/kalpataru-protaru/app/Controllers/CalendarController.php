<?php

namespace App\Controllers;

use App\Models\EventModel;

class CalendarController extends BaseController
{
    public function events()
    {
        $eventModel = new EventModel();
        $events = $eventModel->findAll();

        $startYear = date('Y', strtotime($this->request->getGet('start')));

        $formattedEvents = array_map(function($event) use ($startYear) {
            return [
                'title' => $event['title'],
                'start' => $startYear . '-' . $event['event_date'],
                'description' => $event['description'],
                'color' => $event['category'] === 'Nasional' ? '#007bff' : '#28a745'
            ];
        }, $events);

        return $this->response->setJSON($formattedEvents);
    }
}
