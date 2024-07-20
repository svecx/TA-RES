<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $fillable = [
        'judul_dokumen',
        'deskripsi_dokumen',
        'kategori_dokumen',
        'validasi_dokumen',
        'tahun_dokumen',
        'dokumen_file',
        'tags',
        'view',
        'created_by',
    ];

    public function histories()
    {
        return $this->hasMany(History::class);
    }   

    public function setViewAttribute($value)
    {
        $this->attributes['view'] = is_array($value) ? implode(',', $value) : $value;
    }
}
