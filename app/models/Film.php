<?php

namespace app\models;

use app\core\Model;

class Film extends Model
{
    protected $fillable = ['title', 'release_year', 'format', 'stars'];
}