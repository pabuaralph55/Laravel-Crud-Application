<?php

namespace App\Http\Controllers;

use App\Models\DataRecord;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DataRecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataRecords = DataRecord::all();
        return view('data_records.index', compact('dataRecords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('data_records.create');

        $errorMessage = session('errorMessage');
        return view('data_records.create', compact('errorMessage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:data_records1',
        ]);

        DataRecord::create($validatedData);
        return redirect()->route('data_records.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataRecord  $dataRecord
     * @return \Illuminate\Http\Response
     */
    public function show(DataRecord $dataRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataRecord  $dataRecord
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataRecord = DataRecord::findOrFail($id);
        return view('data_records.edit', compact('dataRecord'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataRecord  $dataRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $rules = [
        'name' => 'required',
        'address' => 'required',
        'city' => 'required',
        'state' => 'required',
        'zip' => 'required',
        'phone' => 'required',
        'email' => [
            'required',
            'email',
            Rule::unique('data_records1')->ignore($id),
        ],
    ];
        
    $validatedData = $request->validate($rules);
        
    $dataRecord = DataRecord::find($id);
    $dataRecord->update($validatedData);
    return redirect()->route('data_records.index');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataRecord  $dataRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataRecord = DataRecord::findOrFail($id);
        $dataRecord->delete();
        return redirect()->route('data_records.index')->with('deleteSuccess', 'Record deleted successfully.');
    }

    public function search(Request $request)
    {
        $searchField = $request->input('searchField');
        $searchValue = $request->input('searchValue');

        $dataRecords = DataRecord::where($searchField, 'like', '%' . $searchValue . '%')->get();
        return view('data_records.index', compact('dataRecords'));
    }
}
