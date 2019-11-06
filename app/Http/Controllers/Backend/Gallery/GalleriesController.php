<?php

namespace App\Http\Controllers\Backend\Gallery;

// use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Service;
use App\ImageUpload;
use File;

class GalleriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::get();

        return view('pages.backend.gallery.index', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $request->validated();

        $imageUpload = new ImageUpload();
        $service = Service::find($request->service);

        $imageUpload->upload($request, $service);

        return redirect()->route('gallery.index')->withSuccess('Uploaded successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageUpload $image)
    {
        if(ImageUpload::whereUrl($image->url)->exists()){
            File::delete(public_path($image->url));
        }
        if(ImageUpload::whereThumbnail($image->thumbnail)->exists()){
            File::delete(public_path($image->thumbnail));
        }
        $image->delete();

        return redirect()->route('gallery.index');
    }
}
