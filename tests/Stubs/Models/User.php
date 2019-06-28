<?php

namespace Caner\Stickware\Tests\Stubs\Models;

use Caner\Stickware\Traits\UserPointTrait;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use UserPointTrait;

}
