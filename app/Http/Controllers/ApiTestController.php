<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

class ApiTestController extends Controller
{
    public function test(Request $request)
    {
        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);

        $calendarId = env('GOOGLE_CALENDAR_ID');

        $event = new Google_Service_Calendar_Event(array(
            //タイトル
            'summary' => $request->input('summary'),
            'start' => array(
                // 開始日時
                'dateTime' => date('c', strtotime($request->input('start_date'))),
                'timeZone' => 'Asia/Tokyo',
            ),
            'end' => array(
                // 終了日時
                'dateTime' => date('c', strtotime($request->input('end_date'))),
                'timeZone' => 'Asia/Tokyo',
            ),
        ));

        $service->events->insert($calendarId, $event);
        return "イベントを追加しました";
    }

    private function getClient()
    {
        $client = new Google_Client();

        //アプリケーション名
        $client->setApplicationName('GoogleCalendarAPIのテスト');
        //権限の指定
        $client->setScopes(Google_Service_Calendar::CALENDAR_EVENTS);
        //JSONファイルの指定
        $client->setAuthConfig(storage_path('app/api-key/calendar-432114-28a55ba789c6.json'));

        return $client;
    }
}
