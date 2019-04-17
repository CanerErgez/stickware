<?php

namespace Stickware\Models;

use Illuminate\Database\Eloquent\Model;

class StickwareUserPoint extends Model
{
    protected $table = 'stickware_user_point';

    protected $fillable = ['userId','pointCount','reason'];
}
