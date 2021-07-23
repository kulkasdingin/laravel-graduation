<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use Illuminate\Http\Request;
use App\Exceptions\ApiInvalidRequestData;
use Illuminate\Support\Facades\Validator;

class GraduateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $graduates = Graduate::get();

        return response()->json([
            'graduates'=>$graduates
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateRequest($request);

        $create_main_image = $request->file('foto');
        if(isset($create_main_image)) {
            $data['foto'] = $request->file('foto')->store('uploads','public');
        } else {
            unset($data['foto']);
        }

        $graduate = Graduate::create($data);

        return response()->json([
            'graduate'=>$graduate,
            'status'=>"Graduate has been created successfully"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Graduate  $graduate
     * @return \Illuminate\Http\Response
     */
    public function show(Graduate $graduate)
    {
        return response()->json([
            'graduate'=>$graduate
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Graduate  $graduate
     * @return \Illuminate\Http\Response
     */
    public function edit(Graduate $graduate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Graduate  $graduate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Graduate $graduate)
    {
        $data = $this->validateRequest($request, $graduate);

        $create_main_image = $request->file('foto');
        if(isset($create_main_image)) {
            $data['foto'] = $request->file('foto')->store('uploads','public');
        } else {
            unset($data['foto']);
        }

        $graduate->update($data);

        return response()->json([
            'graduate'=>$graduate,
            'status'=>"Graduate has been updated successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Graduate  $graduate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Graduate $graduate)
    {
        $graduate->delete();

        return response()->json([
            'graduate'=>$graduate,
            'status'=>"Graduate has been deleted successfully"
        ]);
    }

    private function validateRequest($request, $thisModel = null)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'nama_lengkap' => 'required|string',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,bmp,png|max:2000',
            'jurusan' => 'required|string',
            'gelar' => 'required|string',
            'is_lulus' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            throw (new ApiInvalidRequestData($validator->errors()));
        }

        return $validator->validated();
    }
}
