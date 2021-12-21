<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;

    protected $table = 'patients';
    protected $fillable = ['name','phone','alamat','status_id','tanggal_masuk','tanggal_keluar'];

    public function status(){
        return $this->belongsTo(Status::class);
    }
}
