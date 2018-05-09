<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded=[];

    protected $with=['creator'];

    /**
     * A Note belongs to a User
     * Table notes has (one to one) relationship with users table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator() {

        return $this->belongsTo('App\User', 'user_id');
    }
}
