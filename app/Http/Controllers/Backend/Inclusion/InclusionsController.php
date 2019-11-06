<?php

namespace App\Http\Controllers\Backend\Inclusion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inclusion;
use App\Feature;

class InclusionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inclusions = Inclusion::get();

        return view('pages.backend.inclusion.index', compact('inclusions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $features = Feature::pluck('name', 'id');
        return view('pages.backend.inclusion.create', compact('features'));
    }


    public function checkSlug($slug)
    {
        return Inclusion::where('slug', $slug)->exists();
    }

    public function checkName($name)
    {
        return Inclusion::where('name', $name)->exists();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        if ( ($this->checkName($request->name)) ) {
            return redirect()->back()->withError('Feature name already exists!');
        }

        $request->request->add(['slug' => str_slug($request->name)]);

        $request->validate([
            'name'      =>  'required|min:3|max:30',
            'slug'      =>  'required|unique:inclusions'
        ]);

        Inclusion::create($request->except('_token'))->features()->attach($request->feature);

        if ($request->get('action') == 'save') {
            return redirect()->route('inclusions.index')->withSuccess('A new set of Inclusion has been added!');
        } elseif ($request->get('action') == 'continue') {
            return redirect()->route('inclusions.create')->withSuccess('A new set of Inclusion has been added!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Inclusion $inclusion)
    {
        return view('pages.backend.inclusion.show', compact('inclusion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Inclusion $inclusion)
    {
        $features = Feature::pluck('name', 'id');
        return view('pages.backend.inclusion.edit', compact('inclusion', 'features'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inclusion $inclusion)
    {
        if ($request->status) {
            $active = Inclusion::whereIsActive(true)->pluck('id');
                Inclusion::whereIn('id', $active)->update([
                    'is_active' => false,
                ]);
                $inclusion->is_active = true;
                $inclusion->save();
            return redirect()->route('inclusions.index')->withSuccess('Set of Inclusion has been successfully updated!');
        }
        
        $request->request->add(['slug' => str_slug($request->name)]);

        $request->validate([
            'name'      =>  'required|min:3|max:30',
            'slug'      =>  'required|unique:inclusions,slug,'.$inclusion->id
        ]);

        $inclusion->update($request->except('_token'));

        $inclusion->features()->sync($request->feature);

        if ($request->get('action') == 'save') {
            return redirect()->route('inclusions.index')->withSuccess('Set of Inclusion has been successfully updated!');
        } elseif ($request->get('action') == 'continue') {
            return redirect()->route('inclusions.edit', $inclusion->slug)->withSuccess('Set of Inclusion has been successfully updated!');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inclusion $inclusion)
    {
        $inclusion->delete();
        return response()->json('Inclusion successfully deleted!');
        // return redirect()->route('inclusions.index')->withSuccess('Set of inclusion has been successfully deleted!');
    }
}
