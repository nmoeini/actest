<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Note;
use App\Repositories\Repository;
use App\Services\Service;


class NoteController extends Controller
{

    protected $model;
    protected $service;

    /**
     * NoteController constructor.
     * Uses auth middleware to limit access for non logged in users.
     *
     * @param Note $note
     */
    public function __construct(Note $note)
    {

        $this->middleware('auth.basic.once')->except('index');

        $this->model = New Repository($note);

        $this->service = new Service($this->model);
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

        return $this->service->create();
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function show($id)
    {

        return $this->service->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNoteRequest $form
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(UpdateNoteRequest $form, $id)
    {

        return $this->service->update($id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return int
     */
    public function destroy($id)
    {

        return $this->service->destroy($id);
    }
}
