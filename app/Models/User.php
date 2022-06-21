<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "sekolah_id",
        "nama",
        "tanggal_lahir",
        "nomor_telepon",
        "alamat",
        "email",
        "password"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeRole($query, $role)
    {
        return $query->whereHas("roles", function (Builder $query) use ($role) {
            return $query->where("name", $role);
        });
    }

    public function getIsAdminAttribute()
    {
        return $this->isAdmin();
    }

    public function isAdmin()
    {
        return $this->getRoleNames()[0] == "admin";
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'user_id');
    }

    public function teached_semesters()
    {
        return $this->hasMany(Semester::class, "guru_id");
    }

    public function semesters()
    {
        return $this->belongsToMany(Semester::class, 'semester_users');
    }

    public function sekolah()
    {
        return $this->hasOne(User::class, "id", "sekolah_id");
    }

    public function hasil_quiz()
    {
        return $this->hasMany(HasilQuiz::class, "user_id", "id");
    }

    public function jawaban_tugas()
    {
        return $this->hasMany(JawabanTugas::class, "siswa_id", "id");
    }
}
