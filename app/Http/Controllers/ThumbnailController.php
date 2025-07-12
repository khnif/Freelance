<?php

namespace App\Http\Controllers;
use App\Models\Gig;
use App\Models\Option;
use App\Models\Thumbnail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ThumbnailController extends Controller
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
        return view('thumbnail.create', compact('gig'));
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
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images/uploads'), $imageName);

        $thumbnail = new Thumbnail();
        $thumbnail->url = '/images/uploads/' . $imageName;
        $thumbnail->gig_id = $request->gig_id;
        $thumbnail->save();
        return redirect()->route('thumbnail.create', ['id' => $request->gig_id]);
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
        $gig = Gig::with('thumbnail')->findOrFail($id);
        return view('thumbnail.edit', compact('gig'));
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
        if ($request->hasFile('thumbnail')) {
            foreach ($request->file('thumbnail') as $image) {
                $path = $image->store('thumbnails', 'public');
                Thumbnail::create([
                    'gig_id' => $id,
                    'url' => '/storage/' . $path,
                ]);
            }
        }
        return redirect()->route('gig.show', $id)->with('success', 'Thumbnails updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thumbnail = Thumbnail::findOrFail($id);

        // Optional: Hapus file fisik dari storage jika disimpan secara lokal
        $relativePath = str_replace('/storage/', '', $thumbnail->url);
        Storage::disk('public')->delete($relativePath);

        $thumbnail->delete();

        return back()->with('success', 'Thumbnail deleted successfully.');
    }
}
