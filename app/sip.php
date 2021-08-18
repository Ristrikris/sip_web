<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use catatan;
use dosen;
use khs;
use mahasiswa;
use perwalian;
use transkrip;


class sip extends Model
{
    protected $table = array(
        'dosen', 'catatan', 'mahasiswa', 'khs', 'perwalian', 'transkrip'
    );
}
