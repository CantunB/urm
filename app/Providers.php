<?php

namespace Smapac;

use Illuminate\Database\Eloquent\Model;

class Providers extends Model
{
    protected $fillable = [
        'name',
        'email',
        'rfc',
        'address',
        'phone',
        'website',
        'description',
        'provider_file',
    ];
}
