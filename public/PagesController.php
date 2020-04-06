<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class PagesController extends Controller
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
        $pages = Page::all();
        return view('pages.index')->with('pages', $pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
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
            'title' => 'required|unique:pages',
            'slug' => 'required|unique:pages',
            'page_image' => 'image|nullable|max:1999'
        ]);

         // Handle File Upload
         if($request->hasFile('page_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('page_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('page_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('page_image')->storeAs('http://ads-site.epizy.com/ads-site/storage/app/public/page_images', $fileNameToStore);
        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }

        $page = new Page();
        $page->title = $request->input('title');
        $page->text = $request->input('text');
        $page->slug = $request->input('slug');
        $page->page_image = $fileNameToStore;

        $page->save();
        return redirect('/pages')->with('success', 'Page Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return view('pages.show')->withPage($page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('pages.edit')->withPage($page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $validatedData = $this->validate($request, [
            'title'         => 'required|min:3|max:255',
            'text'         => 'required|min:3|max:255',
            'slug'          => 'required|min:3|max:255|unique:pages,id,' . $page->slug,
            'page_image' => 'image|nullable|max:1999'
        ]);
    
        $validatedData['slug'] = Str::slug($validatedData['slug'], '-');
        

         // Handle File Upload
         if($request->hasFile('page_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('page_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('page_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('page_image')->storeAs('http://ads-site.epizy.com/ads-site/storage/app/public/page_images', $fileNameToStore);
        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }
        
        if($request->hasFile('page_image') && $page->page_image == 'noimage.png'){
            $page->page_image = $fileNameToStore;
        }
        elseif($request->hasFile('page_image') && $page->page_image != 'noimage.png'){
            Storage::delete('http://ads-site.epizy.com/ads-site/storage/app/public/page_images/'.$page->page_image);
            $page->page_image = $fileNameToStore;
        }

        $page->text = $request->input('text');

        $page->update($validatedData);
        return redirect()->route('pages.index', $page)->with('success', 'Page is updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        if($page->page_image == 'noimage.png')
        {
            $page->delete();
            return redirect('/pages')->withPage($page)->with('success', 'Page deleted!');
        }
        else{
            Storage::delete('http://ads-site.epizy.com/ads-site/storage/app/public/page_images/'.$page->page_image);
            $page->delete();
            return redirect('/pages')->with('success', 'Page deleted!');
        }
    }
}
