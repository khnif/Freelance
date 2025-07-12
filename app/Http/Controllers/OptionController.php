<?php

namespace App\Http\Controllers;
use App\Models\Gig;
use App\Models\Option;
use App\Models\Thumbnail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $gig = Gig::find($id);
        return view('option.create',compact('gig'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $option = new Option();
        $option->name = $request->name;
        $option->description = $request->description;
        $option->price = $request->price;
        $option->gig_id = $request->gig_id;
        $option->save();
        return redirect()->route('option.create',['id'=>$request->gig_id]);
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
        $gig = Gig::with('option')->findOrFail($id);
        return view('option.edit', compact('gig'));
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
        foreach ($request->option_ids as $index => $optionId) {
            $option = Option::findOrFail($optionId);
            $option->name = $request->names[$index];
            $option->description = $request->descriptions[$index];
            $option->price = $request->prices[$index];
            $option->deadline = $request->deadlines[$index];
            $option->save();
        }
        return redirect()->route('thumbnail.edit', $id)->with('success', 'Options updated successfully.');
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
