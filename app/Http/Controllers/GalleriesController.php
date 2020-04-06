<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Ad;
use App\Gallery;

//use App\Http\Requests\UploadRequest;


class GalleriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    public function uploadForm($id)
    {
        $ad = Ad::find($id);
        return view('galleries.upload_form')->with('ad', $ad);
    }

    public function uploadSubmit(Request $request, $id)
    {
        $ad = Ad::find($id);

        //$ad = Ad::find($request->all());
        foreach ($request->photos as $photo) {
              // Handle File Upload
          if($photo){
            // Get filename with the extension
            $filenameWithExt = $photo->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $photo->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $photo->storeAs('public/photos', $fileNameToStore);
        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }
        //$filename = $photo->store('public/photos');
            Gallery::create([
                'ad_id' => $ad->id,
                'filename' => $fileNameToStore
            ]);
        }
        return view('ads.show')->with('ad', $ad);
    }

    public function show($id)
    {
        $gallery = Gallery::find($id);
        return view('galleries.show')->with('gallery', $gallery);
    }
    public function destroy($id)
    {
        $gallery = Gallery::find($id);

        if($gallery->filename == 'noimage.png')
        {
            $gallery->delete();
            return redirect('ads/'.$gallery->ad_id)->with('success', 'Photo deleted!');
        }
        else
        {
            Storage::delete('public/photos/'.$gallery->filename);
            $gallery->delete();
            return redirect('ads/'.$gallery->ad_id)->with('success', 'Photo deleted!');
        }
    }
}
