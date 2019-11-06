<?php

namespace App\Http\Controllers\Backend\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Traits\UploadTrait;
use App\Course;
use App\Type;
use File;

class CourseController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::get();

        return view('pages.backend.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::pluck('name','id');
        return view('pages.backend.courses.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    
    public function store(Request $request)
    {
        $request->request->add(['slug' => str_slug($request->name)]);
        $request->validate([
            'name'          =>  'required|min:2',
            'slug'          =>  'required|unique:courses',
            'description'   =>  'required|min:2|max:50',
            'type_id'       =>  'required',
            'image'         =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=25,max_width=1000',
        ]);

        $course = new Course();

        $course->upload($request);

        if($request->get('action') == 'save') {
            return redirect()->route('courses.index')->withSuccess('Course Successfully created!');
        }elseif ($request->get('action') == 'continue') {
            return redirect()->route('courses.create')->withSuccess('Course Successfully created!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('pages.backend.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $types = Type::pluck('name','id');
        return view('pages.backend.courses.edit', compact('course', 'types'));
    }

    public function update(Request $request, Course $course)
    {
        $request->request->add(['slug' => str_slug($request->name)]);
        
        $request->validate([
            'name'          =>  'required|min:2',
            'slug'          =>  'required|unique:courses,slug,' .$course->id,
            'description'   =>  'required|min:2|max:50',
            'type_id'       =>  'required',
            'image'         =>  'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=25,max_width=1000',
        ]);

        $img_arr = [];

        if(request()->has('image'))
        {
            $image = $request->file('image');
            $name = str_random(25).'_'.time();
            $folder = '/uploads/courses/';
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $course->uploadImage($course,$image,$folder,'public', $name);
            array_push($img_arr, ['image' => $filePath]);
        }

        $course->update(array_merge([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'type_id' => $request->type_id
            ],
            $img_arr[0] ?? []
        ));

        if($request->get('action') == 'save') {
            return redirect()->route('courses.index')->withSuccess('Course Successfully updated!');
        }elseif ($request->get('action') == 'continue') {
            return redirect()->route('courses.edit', $course->slug)->withSuccess('Course Successfully updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        if(Course::whereImage($course->image)->exists()){
            File::delete(public_path($course->image));
        }
        $course->delete();

        return response()->json('Course successfully deleted!');
    }
}
