<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        $data = ['articles' => $articles];
        return view('articles.index', $data);
    }

    public function yakioni()
    {
        
        return view('articles.yakioni');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $article = new Article();
        $data = ['article' => $article];
        return view('articles.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
            'summary' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);
        $article = new Article();
        $article->user_id = \Auth::id();
        $article->title = $request->title;
        $article->status = $request->status;
        $article->tag = $request->tag;
        $article->url = $request->url;
        $article->body = $request->body;
        $article->save();

        // Google カレンダーにイベントを追加
        $this->addEventToGoogleCalendar($request);

        return redirect(route('articles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $data = ['article' => $article];
        return view('articles.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $this->authorize($article);
        $data = ['article' => $article];
        return view('articles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $this->authorize($article);
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required'
        ]);
        $article->title = $request->title;
        $article->status = $request->status;
        $article->tag = $request->tag;
        $article->url = $request->url;
        $article->body = $request->body;
        $article->save();
        return redirect(route('articles.show', $article));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $this->authorize($article);
        $article->delete();
        return redirect(route('articles.index'));
    }

    private function addEventToGoogleCalendar(Request $request)
    {
        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);

        $calendarId = env('GOOGLE_CALENDAR_ID');

        $event = new Google_Service_Calendar_Event([
            'summary' => $request->input('summary'),
            'start' => [
                'dateTime' => date('c', strtotime($request->input('start_date'))),
                'timeZone' => 'Asia/Tokyo',
            ],
            'end' => [
                'dateTime' => date('c', strtotime($request->input('end_date'))),
                'timeZone' => 'Asia/Tokyo',
            ],
        ]);

        $service->events->insert($calendarId, $event);
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
