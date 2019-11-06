<?php

namespace App\Http\Controllers\Backend\Type;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Type;

class TypesController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::get();

        return view('pages.backend.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.backend.types.create');
    }

    public function checkSlug($slug)
    {
        return Type::where('slug', $slug)->exists();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ( ($this->checkSlug(str_slug($request->name))) ) {
            return redirect()->back()->withError('Type name already exists!');
        }
        $request->request->add(['slug' => str_slug($request->name)]);

        $request->validate([
            'name'          =>  'required|min:2',
            'description'   =>  'required|min:2|max:50',
        ]);

        Type::create($request->except('_token'));

        return redirect()->route('types.index')->withSuccess('Course Type Successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view('pages.backend.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('pages.backend.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        if ( ($this->checkSlug(str_slug($request->name))) ) {
            $request->request->add(['slug' => str_slug($request->name).' '.str_random(5)]);
        }else {
            $request->request->add(['slug' => str_slug($request->name)]);
        }

        $request->validate([
            'name'          =>  'required|min:2',
            'description'   =>  'required|min:2|max:50',
        ]);
        
        $type->update($request->except('_token'));

        return redirect()->route('types.index')->withSuccess('Course Type Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('types.index')->withSuccess('Course Type Successfully deleted!');
    }
}
