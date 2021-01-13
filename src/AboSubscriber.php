<?php
namespace Yoan1005\Abonews;

use Illuminate\Database\Eloquent\Model;

class AboSubscriber extends Model
{
    protected $table = "abo_subscribers";
    protected $fillable = ['id', 'lang_id', 'email', 'subscribe'];


}
