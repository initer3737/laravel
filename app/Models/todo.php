<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todo extends Model
{
    use HasFactory;
    protected $table='mytodo';
    protected $fillable=[
        'todo','file','file_name','updatedAt','createdAt'
    ];
}