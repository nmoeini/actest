<?php

namespace App\Http\Requests;

use App\Note;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class CreateNoteRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request
     * By looking at NotePolicy class
     *
     * @return bool
     */
    public function authorize()
    {

        return Gate::allows('create', new Note());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'title' => 'required|max:50',
            'note' => 'max:1000'
        ];
    }

}
