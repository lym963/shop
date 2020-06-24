<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TokenModel extends Model
{
    public $table="p_token";
    protected $primaryKey="token_id";
    protected $guarded=[];
    public $timestamps=false;
}
