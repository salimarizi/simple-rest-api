<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        return view('home', compact('users'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        User::create($request->all());
        return redirect('home');
    }

    public function edit($user_id)
    {
        $user = User::find($user_id);
        return view('edit', compact('user'));
    }

    public function update(Request $request, $user_id)
    {
        $user = User::find($user_id);
        $user->update($request->all());
        return redirect('home');
    }

    public function destroy($user_id)
    {
        $user = User::find($user_id);
        $user->delete();
        return redirect('home');
    }

    public function rss(Request $request)
    {
        $news = [];
        if ($request->source != 'api') {
          $xmlString = file_get_contents('https://www.antaranews.com/rss/terkini.xml');
          $xmlObject = simplexml_load_string($xmlString);
          $json = json_encode($xmlObject);
          $array = json_decode($json);

          foreach ($array->channel->item as $value) {
            if ($request->has('search') && $request->search != '') {
              if (strpos($value->title, $request->search) !== false) {
                array_push($news, [
                  'title' => $value->title,
                  'published_date' => $value->pubDate,
                  'link' => $value->link
                ]);
              }
            }else {
              array_push($news, [
                'title' => $value->title,
                'published_date' => $value->pubDate,
                'link' => $value->link
              ]);
            }
          }
        }else {
          $url = 'http://newsapi.org/v2/top-headlines?country=id&apiKey=40e502d08a4e4ddb91a09d0a91f5fcc7';
          if ($request->has('search') && $request->search != '') {
            $url = 'https://newsapi.org/v2/everything?q='.$request->search.'&apiKey=40e502d08a4e4ddb91a09d0a91f5fcc7';
          }
          $client = new \GuzzleHttp\Client();
          $response = $client->request('GET', $url);
          $body = $response->getBody();
          $data = json_decode(fgets($body->detach()));

          foreach ($data->articles as $value) {
            array_push($news, [
              'title' => $value->title,
              'published_date' => $value->publishedAt,
              'link' => $value->url
            ]);
          }
        }

        return view('rss', compact('news'));
    }
}
