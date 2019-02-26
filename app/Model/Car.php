<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Car extends Model {
    protected $table = 'cars';
    protected $fillable = [
        'name',
        'description',
        'model',
        'date'
    ];

    protected $casts = [
        'date' => 'Timestamp'
    ];

    public $timestamps = false;
}