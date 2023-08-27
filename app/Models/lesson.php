<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lesson extends Model
{
    use HasFactory;
    //
    /**
     * 
     * the attribute that are mass assignable
     * 
     *  @var array
     */
        protected $fillable=[

            'user_id','title','body'
        ];
        public function user(){

            return $this->belongsTo(User::class );   
        }
        public function tags(){

            return $this->belongsToMany(Tag::class ,'lesson_tags');
        }

    
}
