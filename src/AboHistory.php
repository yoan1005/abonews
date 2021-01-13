<?php

namespace Yoan1005\Abonews;

use Illuminate\Database\Eloquent\Model;

class AboHistory extends Model
{
    protected $table = "abo_historys";
    protected $fillable = [
      'template_id','lang_id','to_email','to_name','from_email',
      'from_name','subject','html','sended_at','send_info'
    ];


}
