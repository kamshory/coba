<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * GaleriProyek is entity of table galeri_proyek. You can join this entity to other entity using annotation JoinColumn. 
 * Don't forget to add "use" statement if the entity is outside the namespace.
 * Visit https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="galeri_proyek")
 */
class GaleriProyek extends MagicObject
{
	/**
	 * Galeri Proyek ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.IDENTITY)
	 * @NotNull
	 * @Column(name="galeri_proyek_id", type="bigint(20)", length=20, nullable=false, extra="auto_increment")
	 * @Label(content="Galeri Proyek ID")
	 * @var integer
	 */
	protected $galeriProyekId;

	/**
	 * Proyek ID
	 * 
	 * @Column(name="proyek_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Proyek ID")
	 * @var integer
	 */
	protected $proyekId;

	/**
	 * Proyek
	 * 
	 * @JoinColumn(name="proyek_id", referenceColumnName="proyek_id")
	 * @Label(content="Proyek")
	 * @var ProyekMin
	 */
	protected $proyek;

	/**
	 * Lokasi Proyek ID
	 * 
	 * @Column(name="lokasi_proyek_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Lokasi Proyek ID")
	 * @var integer
	 */
	protected $lokasiProyekId;

	/**
	 * Lokasi Proyek
	 * 
	 * @JoinColumn(name="lokasi_proyek_id", referenceColumnName="lokasi_proyek_id")
	 * @Label(content="Lokasi Proyek")
	 * @var LokasiProyekMin
	 */
	protected $lokasiProyek;

	/**
	 * Buku Harian ID
	 * 
	 * @Column(name="buku_harian_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Buku Harian ID")
	 * @var integer
	 */
	protected $bukuHarianId;

	/**
	 * Buku Harian
	 * 
	 * @JoinColumn(name="buku_harian_id", referenceColumnName="buku_harian_id")
	 * @Label(content="Buku Harian")
	 * @var BukuHarianMin
	 */
	protected $bukuHarian;

	/**
	 * Pekerjaan ID
	 * 
	 * @Column(name="pekerjaan_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Pekerjaan ID")
	 * @var integer
	 */
	protected $pekerjaanId;

	/**
	 * Pekerjaan
	 * 
	 * @JoinColumn(name="pekerjaan_id", referenceColumnName="pekerjaan_id")
	 * @Label(content="Pekerjaan")
	 * @var PekerjaanMin
	 */
	protected $pekerjaan;

	/**
	 * Supervisor ID
	 * 
	 * @Column(name="supervisor_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Supervisor ID")
	 * @var integer
	 */
	protected $supervisorId;

	/**
	 * Supervisor
	 * 
	 * @JoinColumn(name="supervisor_id", referenceColumnName="supervisor_id")
	 * @Label(content="Supervisor")
	 * @var SupervisorMin
	 */
	protected $supervisor;

	/**
	 * Nama
	 * 
	 * @Column(name="nama", type="varchar(100)", length=100, nullable=true)
	 * @Label(content="Nama")
	 * @var string
	 */
	protected $nama;

	/**
	 * File
	 * 
	 * @Column(name="file", type="varchar(255)", length=255, nullable=true)
	 * @Label(content="File")
	 * @var string
	 */
	protected $file;

	/**
	 * Md5
	 * 
	 * @Column(name="md5", type="varchar(32)", length=32, nullable=true)
	 * @Label(content="Md5")
	 * @var string
	 */
	protected $md5;

	/**
	 * Deskripsi
	 * 
	 * @Column(name="deskripsi", type="longtext", nullable=true)
	 * @Label(content="Deskripsi")
	 * @var string
	 */
	protected $deskripsi;

	/**
	 * Width
	 * 
	 * @NotNull
	 * @Column(name="width", type="int(11)", length=11, default_value="1", nullable=false)
	 * @DefaultColumn(value="1")
	 * @Label(content="Width")
	 * @var integer
	 */
	protected $width;

	/**
	 * Height
	 * 
	 * @NotNull
	 * @Column(name="height", type="int(11)", length=11, default_value="1", nullable=false)
	 * @DefaultColumn(value="1")
	 * @Label(content="Height")
	 * @var integer
	 */
	protected $height;

	/**
	 * Exif
	 * 
	 * @Column(name="exif", type="longtext", nullable=true)
	 * @Label(content="Exif")
	 * @var string
	 */
	protected $exif;

	/**
	 * Latitude
	 * 
	 * @Column(name="latitude", type="double", nullable=true)
	 * @Label(content="Latitude")
	 * @var double
	 */
	protected $latitude;

	/**
	 * Longitude
	 * 
	 * @Column(name="longitude", type="double", nullable=true)
	 * @Label(content="Longitude")
	 * @var double
	 */
	protected $longitude;

	/**
	 * Altitude
	 * 
	 * @Column(name="altitude", type="double", nullable=true)
	 * @Label(content="Altitude")
	 * @var double
	 */
	protected $altitude;

	/**
	 * Admin Buat
	 * 
	 * @Column(name="admin_buat", type="bigint(20)", length=20, nullable=true, updatable=false)
	 * @Label(content="Admin Buat")
	 * @var integer
	 */
	protected $adminBuat;

	/**
	 * Pembuat
	 * 
	 * @JoinColumn(name="admin_buat", referenceColumnName="user_id")
	 * @Label(content="Pembuat")
	 * @var User
	 */
	protected $pembuat;

	/**
	 * Admin Ubah
	 * 
	 * @Column(name="admin_ubah", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Admin Ubah")
	 * @var integer
	 */
	protected $adminUbah;

	/**
	 * Pengubah
	 * 
	 * @JoinColumn(name="admin_ubah", referenceColumnName="user_id")
	 * @Label(content="Pengubah")
	 * @var User
	 */
	protected $pengubah;

	/**
	 * Waktu Buat
	 * 
	 * @Column(name="waktu_buat", type="timestamp", length=19, nullable=true, updatable=false)
	 * @Label(content="Waktu Buat")
	 * @var string
	 */
	protected $waktuBuat;

	/**
	 * Waktu Ubah
	 * 
	 * @Column(name="waktu_ubah", type="timestamp", length=19, nullable=true)
	 * @Label(content="Waktu Ubah")
	 * @var string
	 */
	protected $waktuUbah;

	/**
	 * Waktu Foto
	 * 
	 * @Column(name="waktu_foto", type="timestamp", length=19, nullable=true)
	 * @Label(content="Waktu Foto")
	 * @var string
	 */
	protected $waktuFoto;

	/**
	 * IP Buat
	 * 
	 * @Column(name="ip_buat", type="varchar(50)", length=50, nullable=true, updatable=false)
	 * @Label(content="IP Buat")
	 * @var string
	 */
	protected $ipBuat;

	/**
	 * IP Ubah
	 * 
	 * @Column(name="ip_ubah", type="varchar(50)", length=50, nullable=true)
	 * @Label(content="IP Ubah")
	 * @var string
	 */
	protected $ipUbah;

	/**
	 * Aktif
	 * 
	 * @Column(name="aktif", type="tinyint(1)", length=1, default_value="1", nullable=true)
	 * @DefaultColumn(value="1")
	 * @Label(content="Aktif")
	 * @var boolean
	 */
	protected $aktif;

}