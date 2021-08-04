<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Admin
 *
 * @property int $IDAdmin
 * @property string $NamaAdmin
 * @property string $Password
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin query()
 */
	class Admin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Dokter
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Dokter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dokter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dokter query()
 */
	class Dokter extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Obat
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Obat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Obat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Obat query()
 */
	class Obat extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Oxygen
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Oxygen newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Oxygen newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Oxygen query()
 */
	class Oxygen extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Pasien
 *
 * @property string $IDPasien
 * @property string $NamaPasien
 * @property string $NoHP
 * @property string $Alamat
 * @property int|null $Usia
 * @property string|null $JenisKelamin
 * @property string|null $GolonganDarah
 * @property string|null $RhesusDarah
 * @property string|null $TanggalLahir
 * @property string|null $FotoKTP
 * @property string|null $Penanggung
 * @property string|null $NoHPPenanggung
 * @property string|null $IDPenanggung
 * @property string|null $StatusPenanggung
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien query()
 */
	class Pasien extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Pinjam
 *
 * @property int $IDTrPinjam
 * @property string $IDPasien
 * @property int|null $IDOxy
 * @property string|null $TglKirim
 * @property string|null $TglKembali
 * @property int|null $IDAdmin
 * @property string $Sumber
 * @property string $Gejala
 * @property int|null $Saturasi
 * @property string|null $TanggalSwab
 * @property string|null $BuktiSwab
 * @property string|null $KonsumsiObat
 * @property string $PernahBerobat
 * @property string $KetersediaanTabung
 * @property string $Status
 * @property string|null $BuktiSaturasi
 * @property string $JenisPinjaman
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjam query()
 */
	class Pinjam extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Telemedicine
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Telemedicine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Telemedicine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Telemedicine query()
 */
	class Telemedicine extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TelemedicineDetail
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TelemedicineDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TelemedicineDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TelemedicineDetail query()
 */
	class TelemedicineDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 */
	class User extends \Eloquent {}
}

