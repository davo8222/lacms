<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Builder extends Model
{
    protected $fillable=['name', 'type', 'data', 'position'];
}
