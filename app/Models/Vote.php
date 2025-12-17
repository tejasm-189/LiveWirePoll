<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = ['option_id', 'poll_id'];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }
}
