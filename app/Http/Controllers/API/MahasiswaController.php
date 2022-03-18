<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Helpers\ApiFormatter;
use Exception;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Mahasiswa::all();

        if ($data) {
            return ApiFormatter::createApi(200, 'success', $data);
        } else {
            return ApiFormatter::createApi(400, 'failed');
        }

        //
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
        try {
            //code...
            $request->validate([
                'username' => 'required',
                'address' => 'required',
            ]);


            $mahasiswa = new Mahasiswa();
            $mahasiswa->username = $request->username;
            $mahasiswa->address = $request->address;
            $mahasiswa->save();
            $data = Mahasiswa::where('id', '==', $mahasiswa->id)->get();

            if ($data) {
                return ApiFormatter::createApi(200, 'success', $data);
            } else {
                return ApiFormatter::createApi(400, 'failed');
            }


        } catch (Exception $error) { 
            return ApiFormatter::createApi(400,  $error);
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
        $data = Mahasiswa::where('id', '=', $id)->get();

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        try {
            $request->validate([
                'username' => 'required',
                'address' => 'required',
            ]); 

            $mahasiswa = Mahasiswa::findOrFail($id);  


            if ($mahasiswa) {
                $mahasiswa->username = $request->username;
                $mahasiswa->address = $request->address;
                $mahasiswa->save();

                return ApiFormatter::createApi(200, 'Success', $mahasiswa);
            } else {
                return ApiFormatter::createApi(400, 'Failed');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);

            $data = $mahasiswa->delete();

            if ($data) {
                return ApiFormatter::createApi(200, 'Success Destory data');
            } else {
                return ApiFormatter::createApi(400, 'Failed');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }
}
