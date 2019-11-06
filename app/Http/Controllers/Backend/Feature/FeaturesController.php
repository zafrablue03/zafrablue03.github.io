<?php

namespace App\Http\Controllers\Backend\Feature;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Feature;

class FeaturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $features = Feature::get();

        return view('pages.backend.feature.index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.backend.feature.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  =>  'required|min:3|max:80',
        ]);

        Feature::create($request->except('_token'));

        if ($request->get('action') == 'save') {
            return redirect()->route('features.index')->withSuccess('A new Feature has been added!');
        } elseif ($request->get('action') == 'continue') {
            return redirect()->route('features.create')->withSuccess('A new Feature has been added!');
        }
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
    public function edit(Feature $feature)
    {
        return view('pages.backend.feature.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feature $feature)
    {
        $request->validate([
            'name'  =>  'required|min:3|max:80',
        ]);

        $feature->update($request->except('_token'));

        if ($request->get('action') == 'save') {
            return redirect()->route('features.index')->withSuccess('Feature has been updated!');
        } elseif ($request->get('action') == 'continue') {
            return redirect()->route('features.edit', $feature->id)->withSuccess('Feature has been updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feature $feature)
    {
        $feature->delete();
        return redirect()->route('features.index')->withSuccess('Feature has been successfully deleted!');
    }
}
