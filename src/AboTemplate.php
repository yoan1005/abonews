<?php

namespace Yoan1005\Abonews;

use Illuminate\Database\Eloquent\Model;

class AboTemplate extends Model
{
    protected $table = "abo_templates";
    protected $fillable = ['id', 'lang_id', 'text', 'html', 'from_name', 'from_email', 'subject'];

    public function merge_fields($obj, $key){
     $html = $this->{$key};
     foreach ($obj as $key => $value) {
       $html = str_replace('[['.$key.']]', $value, $html);

     }
     return $html;
    }

}
