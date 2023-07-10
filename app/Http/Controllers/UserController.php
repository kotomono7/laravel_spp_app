<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Models\User as User;

class UserController extends Controller
{
    private $viewIndex = 'user_index';
    private $viewCreate = 'user_form';
    private $viewEdit = 'user_form';
    // private $viewShow = 'user_show';

    private $routePrefix = 'user';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = User::where('role', '=', 'OPERATOR')->latest()->paginate(50);
        return view('operator.' . $this->viewIndex, $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'model' => new User(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'SIMPAN'
        ];

        return view('operator.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'role' => 'required|in:ADMIN,WALI,OPERATOR',
            'password' => 'required'
        ]);

        $requestData['password'] = bcrypt($requestData['password']);
        $requestData['email_verified_at'] = now();
        $requestData['updated_at'] = null;

        User::create($requestData);
        flash('Data berhasil disimpan')->success();

        // return back();
        return redirect()->route($this->routePrefix . '.index');
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
        $data = [
            'model' => User::findOrFail($id),
            'method' => 'PUT',
            'route' => [$this->routePrefix . '.update', $id],
            'button' => 'UBAH'
        ];

        return view('operator.' . $this->viewEdit, $data);
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
        $requestData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'phone' => 'required|unique:users,phone,' . $id,
            'role' => 'required|in:ADMIN,WALI,OPERATOR',
            'password' => 'nullable'
        ]);

        $requestData['updated_at'] = now();
        $model = User::findOrFail($id);

        if ($requestData['password'] == "")
        {
            unset($requestData['password']);
        } else
        {
            $requestData['password'] = bcrypt($requestData['password']);
        }

        $model->fill($requestData);
        $model->save();
        flash('Data berhasil diubah')->success();

        return redirect()->route($this->routePrefix . '.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = User::findOrFail($id);

        if ($model->email == 'operator@localhost.dev')
        {
            flash('Data tidak dapat dihapus')->error();
            return back();
        }

        $model->delete();
        flash('Data berhasil dihapus');

        return back();
    }
}
