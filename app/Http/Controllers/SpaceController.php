<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Space;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SpaceController extends Controller
{


    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $spaces = Space::orderBy('created_at', 'DESC')->paginate(3);
        return view('pages.space.index', compact('spaces'));
    }

    public function browse()
    {
        return view('pages.space.browse');
    }


    public function create()
    {
        return view('pages.space.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'min:3'],
            'address' => ['required', 'min:5'],
            'description' => ['required', 'min:10'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            

        ]);
      

        $request->user()->spaces()->create($request->all());
        return redirect()->route('space.index')->with('status', 'Space created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $space = Space::findOrFail($id);
        return view('pages.space.show', compact('space'));
        return $request->all();
    }

    public function edit($id)
    {
        $space = Space::findOrFail($id);
        if ($space->user_id != request()->user()->id) {
            return redirect()->back();
        }
        return view('pages.space.edit', compact('space'));
    }


    public function update(Request $request, $id)
    {
        $space = Space::findOrFail($id);
        if ($space->user_id != request()->user()->id) {
            return redirect()->back();
        }
        $this->validate($request, [
            'title' => ['required', 'min:3'],
            'address' => ['required', 'min:5'],
            'description' => ['required', 'min:15'],
            'latitude' => ['required'],
            'longitude' => ['required'],

        ]);
        $space->update($request->all());
        return redirect()->route('space.index')->with('status', 'Space terupdate');
    }


    public function destroy($id)
    {
        $space = Space::findOrFail($id);
        if ($space->user_id != request()->user()->id) {
            return redirect()->back();
        }
        $space->delete();
        return redirect()->route('space.index')->with('status', 'Space deleted');
    }
}
