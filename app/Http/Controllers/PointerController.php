<?php

namespace App\Http\Controllers;

use App\Models\Pointer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PointerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pointer = Pointer::query();
        $pointer->where('name', 'like', '%'.request('q').'%');
        $pointers = $pointer->paginate(25);

        return view('pointer.index', compact('pointers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pointer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'address'       => 'nullable|string|max:255',
            'latitude'      => 'required|numeric',
            'longitude'     => 'required|numeric',

            'price_sp95'    => 'nullable|regex:/^\d{1,3}(?:[.,]\d{3})*(?:[.,]\d{2})$/|max:10',
            'price_e85'     => 'nullable|regex:/^\d{1,3}(?:[.,]\d{3})*(?:[.,]\d{2})$/|max:10',
            'price_sp98'    => 'nullable|regex:/^\d{1,3}(?:[.,]\d{3})*(?:[.,]\d{2})$/|max:10',
            'price_gazole'  => 'nullable|regex:/^\d{1,3}(?:[.,]\d{3})*(?:[.,]\d{2})$/|max:10',

        ]);
        $pointer = new Pointer();
        $pointer->name          = $request->input('name');
        $pointer->address       = $request->input('address');
        $pointer->latitude      = $request->input('latitude');
        $pointer->longitude     = $request->input('longitude');

        $pointer->sp95    = $request->input('price_sp95');
        $pointer->e85     = $request->input('price_e85');
        $pointer->sp98    = $request->input('price_sp98');
        $pointer->Gazoil  = $request->input('price_gazole');

        $pointer->creator_id    = Auth::id();

        $pointer->save();
        return redirect()->route('dashboard', $pointer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pointer $pointer)
    {
        return view('pointer.show', compact('pointer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pointer $pointer)
    {
        return view('pointer.edit', compact('pointer'));
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
        //
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
