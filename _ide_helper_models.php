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
 * App\Models\DonorPlasma
 *
 * @property int $IDDonor
 * @property string $IDPasien
 * @property int|null $IDAdmin
 * @property string|null $TanggalPositif
 * @property string|null $TanggalSembuh
 * @property string $Status
 * @method static \Illuminate\Database\Eloquent\Builder|DonorPlasma newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DonorPlasma newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DonorPlasma query()
 */
	class DonorPlasma extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Obat
 *
 * @property int $IDObat
 * @property string $NamaObat
 * @property string $JenisObat
 * @property int $Jumlah
 * @property string $TglInsert
 * @property string $UserInsert
 * @property string|null $TglUpdate
 * @property string|null $UserUpdate
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
 * @property int $IDOxy
 * @property string $NamaOxy
 * @property string $Jenis
 * @property string $TglInsert
 * @property string $UserInsert
 * @property string|null $TglUpdate
 * @property string|null $UserUpdate
 * @property string $Status
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
 * @property int|null $Berat
 * @property string|null $Profesi
 * @property string|null $Agama
 * @property string|null $JenisKelamin
 * @property string|null $GolonganDarah
 * @property string|null $RhesusDarah
 * @property string|null $TanggalLahir
 * @property string|null $FotoKTP
 * @property string|null $Penanggung
 * @property string|null $NoHPPenanggung
 * @property string|null $IDPenanggung
 * @property string|null $StatusPenanggung
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Telemedicine[] $konsultasi
 * @property-read int|null $konsultasi_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Pinjam[] $pinjam
 * @property-read int|null $pinjam_count
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
 * @property string $AsalPinjam
 * @property string $created_at
 * @property-read \App\Models\Pasien $pasien
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
 * @property int $IDTrTele
 * @property int|null $IDDokter
 * @property string $IDPasien
 * @property int|null $IDAdmin
 * @property string $Tanggal
 * @property string $Status
 * @property string|null $Diagnosa
 * @property string|null $Gejala
 * @property string $PernahBerobat
 * @property string|null $RiwayatPenyakit
 * @property string|null $KonsumsiObat
 * @property string|null $ButuhOksigen
 * @property string|null $ButuhOxymeter
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TelemedicineDetail[] $detail
 * @property-read int|null $detail_count
 * @property-read \App\Models\Pasien $pasien
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
 * @property int $IDTrTeleDetail
 * @property int $IDTrTele
 * @property int $IDObat
 * @property int $Qty
 * @property-read \App\Models\Obat $obat
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
 * @property int $IDUser
 * @property string $Username
 * @property string $Nama
 * @property string $Password
 * @property string|null $NoHP
 * @property string $Role
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 */
	class User extends \Eloquent {}
}

