<?php

namespace App\Http\Requests;

use App\Note;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;

class UpdateNoteRequest extends FormRequest
{

    protected $note;
    /**
     * Determine if the user is authorized to make this request
     * By looking at NotePolicy class
     *
     * @return bool
     */
    public function authorize()
    {

        $this->note = Note::find($this->route('note'));

        return Gate::allows('update', $this->note);
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @return void
     *
     *
     */
    public function failedAuthorization()
    {

        throw new HttpResponseException(response()->json(['message' => 'You are not authorized to edit this Note.'], 429));

    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'min:1|max:50',
            'note' => 'nullable|max:1000'
        ];
    }

}
