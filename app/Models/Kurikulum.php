<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    use HasFactory;

    protected $fillable = [
        "guru_id",
        "kelas",
        "tahun_ajaran",
    ];

    public function guru()
    {
        return $this->hasOne(User::class, "id", "guru_id");
    }
}
