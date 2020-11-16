<?php

namespace App\Models\ChatBot;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;

class ApiToken extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'chatbot_api_tokens';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['secret'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
