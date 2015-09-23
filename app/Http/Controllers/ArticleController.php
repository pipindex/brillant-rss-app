<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;



class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rawData = \App\Providers\RssFeedProvider::getFeed();
        $data = [];
        foreach ($rawData as $key => $item) {
            $itemarray = [];
            $itemarray['title'] = (string)($item->xpath('.//title')[0]);
            $itemarray['link'] = (string)($item->xpath('.//link')[0]);
            $itemarray['date'] = (string)($item->xpath('.//pubDate')[0]);
            $itemarray['author'] = (string)($item->xpath('.//dc:creator')[0]);
            $itemarray['category'] = (string)($item->xpath('.//category')[0]);
            $itemarray['description'] = html_entity_decode((string)($item->xpath('.//description')[0]));
            $itemarray['likeCount'] = $this->getFacebookCount($itemarray['link']);
            $data[] = $itemarray; // add item to the array
        }

        return view('welcome', ['articles'=>$data]);
    }


    public function getFacebookCount($link) {


        $facebookRequest = "https://api.facebook.com/method/links.getStats?urls=" . $link . "&format=json";

        $client = new \GuzzleHttp\Client([ 'base_uri' => $facebookRequest,'timeout'  => 2.0,]);

        $response = $client->get('')->getBody()->getContents();

        return json_decode($response)[0]->total_count;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
