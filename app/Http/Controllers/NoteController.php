<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Note;
use App\Repositories\Repository;

class NoteController extends Controller
{

    protected $model;

    /**
     * NoteController constructor.
     * Uses auth middleware to limit access for non logged in users.
     */
    public function __construct(Note $note)
    {

        $this->middleware('auth.basic.once')->except('index');

        $this->model = New Repository($note);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return $this->model->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Http\Response
     */
    public function store(CreateNoteRequest $form)
    {

        return $this->model->create(request()->only($this->model->getModel()->fillable));
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function show($id)
    {

        return $this->model->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNoteRequest $form
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(UpdateNoteRequest $form, $id)
    {

        $this->model->update(request()->only($this->model->getModel()->fillable), $id);

        return $this->model->getModel()->find($id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return int
     */
    public function destroy($id)
    {

        return $this->model->delete($id);
    }
}
