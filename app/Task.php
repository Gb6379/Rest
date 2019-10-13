<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Task extends Model
{
    //

   

    protected $fillable = [
        'title',
        'description',
        'due_at',
        'is_completed',
        'user_id'
    ];

    protected $casts = [
        
        'due_at' => 'datetime',
        'is_completed' => 'boolean',
    ];

    

    public function user()
    {
        //return to whom the task`s assigned at
        return $this->belongsTo(User::class, 'user_id');
    }

}
