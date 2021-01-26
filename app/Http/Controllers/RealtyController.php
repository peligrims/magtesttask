<?php

namespace App\Http\Controllers;

use App\Models\Realty;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
class RealtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $realties = Realty::all()->toArray();
        return array_reverse($realties);
    }

    // add Realty
    public function add(Request $request)
    {
        $realty = new Realty([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'bedroom' => $request->input('bedroom'),
            'bathroom' => $request->input('bathroom'),
            'storey' => $request->input('storey'),
            'garage' => $request->input('garage'),

        ]);
        $realty->save();

        return response()->json('The realty successfully added');
    }

    // edit Realty
    public function edit($id)
    {
        $realty = Realty::find($id);

        return response()->json($realty);

    }
    // update Realty
    public function update($id, Request $request)
    {
        $realty= Realty::find($id);
        $realty->update($request->all());

        return response()->json('The realty successfully updated');
    }
    // delete Realty
    public function delete($id)
    {
        $realty = Realty::find($id);
        $realty->delete();

        return response()->json('The realty successfully deleted');
    }
    // Import
    public function create()
    {
        return view ('import');
    }
    public function store (Request $request)
    {
       // dd($request->all());
    }
    // Import csv file
    public function import(Request $request)
    {

        return response ()->json ([$request->all()]);
    }
}
