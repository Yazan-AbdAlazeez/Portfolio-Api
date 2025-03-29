<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_id',
        'title',
        'description',
        'image_path',
        'link',
    ];

    public function portfolio() { return $this->belongsTo(Portfolio::class); }

    public function getImageUrlAttribute(){
        if($this->image_path){
            return url("$this->image_path");
        }
        return null;
    }
}
