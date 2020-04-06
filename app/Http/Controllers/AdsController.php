<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ad;
use App\Category;
use App\City;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class AdsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ad::orderby('created_at','desc')->paginate(10);
        return view('ads.index')->with('ads', $ads);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = [
            'Category' => Category::get()->pluck('title', 'id')
        ];
        $cities = [
            'City' => City::get()->pluck('title', 'id')
        ];
        return view('ads.create')->with('categories', $categories)->with('cities', $cities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|unique:ads',
            'price' => 'required',
            'category_id' => 'required',
            'city_id' => 'required',
            'main_image' => 'image|nullable|max:1999'
        ]);

          // Handle File Upload
          if($request->hasFile('main_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('main_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('main_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('main_image')->storeAs('public/main_images', $fileNameToStore);
        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }

        $ad = new Ad();
        $ad->title = $request->input('title');
        $ad->description = $request->input('description');
        $ad->price = $request->input('price');
        $ad->category_id = $request->input('category_id');
        $ad->city_id = $request->input('city_id');
        $ad->active = $request->input('active');
        $ad->main_image = $fileNameToStore;


        $ad->date_expired = Carbon::parse($request->date_expired);
        $request['date_expired'] = $ad->date_expired->format('Y-m-d H:i:s');
        $ad->date_created = Carbon::parse($request->date_created);
        $request['date_created'] = $ad->date_created->format('Y-m-d H:i:s');

        $ad->save();

        return redirect('/ads')->with('success', 'Ad added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ad = Ad::find($id);
        $ad->increment('views', 1);

        return view('ads.show')->with('ad', $ad);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = [
            'Category' => Category::get()->pluck('title', 'id')
        ];
        $cities = [
            'City' => City::get()->pluck('title', 'id')
        ];

        $ad = Ad::find($id);
        return view('ads.edit')->with('ad', $ad)->with('categories', $categories)->with('cities', $cities);
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
        $this->validate($request,[
            'title' => 'required',
            'category_id' => 'required',
            'city_id' => 'required',
            'main_image' => 'image|nullable|max:1999'
        ]);

          // Handle File Upload
          if($request->hasFile('main_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('main_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('main_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('main_image')->storeAs('public/main_images', $fileNameToStore);
        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }

        $ad = Ad::find($id);
        $ad->title = $request->input('title');
        $ad->description = $request->input('description');
        $ad->price = $request->input('price');
        $ad->category_id = $request->input('category_id');
        $ad->city_id = $request->input('city_id');
        $ad->active = $request->input('active');
        if($request->hasFile('main_image') && $ad->main_image == 'noimage.png'){
            $ad->main_image = $fileNameToStore;
        }
        elseif($request->hasFile('main_image') && $ad->main_image != 'noimage.png'){
            Storage::delete('public/main_images/'.$ad->main_image);
            $ad->main_image = $fileNameToStore;
        }

        $ad->date_expired = Carbon::parse($request->date_expired);
        $request['date_expired'] = $ad->date_expired->format('Y-m-d H:i:s');
        $ad->date_created = Carbon::parse($request->date_created);
        $request['date_created'] = $ad->date_created->format('Y-m-d H:i:s');

        $ad->save();
        return redirect('/ads')->with('success', 'Ad added!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ad = Ad::find($id);
        if($ad->main_image == 'noimage.png')
        {
            $ad->delete();
            return redirect('/ads')->with('success', 'Ad deleted!');
        }
        else{
            Storage::delete('public/main_images/'.$ad->main_image);
            $ad->delete();
            return redirect('/ads')->with('success', 'Ad deleted!');
        }
    }
}
