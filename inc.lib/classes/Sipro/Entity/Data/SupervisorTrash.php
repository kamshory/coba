<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * SupervisorTrash is entity of table supervisor_trash. You can join this entity to other entity using annotation JoinColumn. 
 * Don't forget to add "use" statement if the entity is outside the namespace.
 * @link https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @package Sipro\Entity\Data
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="supervisor_trash")
 */
class SupervisorTrash extends MagicObject
{
	/**
	 * Supervisor Trash ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.UUID)
	 * @Column(name="supervisor_trash_id", type="varchar(40)", length=40, default_value="NULL", nullable=true)
	 * @DefaultColumn(value="NULL")
	 * @Label(content="Supervisor Trash ID")
	 * @var string
	 */
	protected $supervisorTrashId;

	/**
	 * Supervisor ID
	 * 
	 * @NotNull
	 * @Column(name="supervisor_id", type="bigint(20)", length=20, nullable=false)
	 * @Label(content="Supervisor ID")
	 * @var integer
	 */
	protected $supervisorId;

	/**
	 * Nip
	 * 
	 * @NotNull
	 * @Column(name="nip", type="varchar(30)", length=30, nullable=false)
	 * @Label(content="Nip")
	 * @var string
	 */
	protected $nip;

	/**
	 * Username
	 * 
	 * @Column(name="username", type="varchar(50)", length=50, nullable=true)
	 * @Label(content="Username")
	 * @var string
	 */
	protected $username;

	/**
	 * Password
	 * 
	 * @Column(name="password", type="varchar(50)", length=50, nullable=true)
	 * @Label(content="Password")
	 * @var string
	 */
	protected $password;

	/**
	 * Nama Depan
	 * 
	 * @Column(name="nama_depan", type="varchar(50)", length=50, nullable=true)
	 * @Label(content="Nama Depan")
	 * @var string
	 */
	protected $namaDepan;

	/**
	 * Nama Belakang
	 * 
	 * @Column(name="nama_belakang", type="varchar(50)", length=50, nullable=true)
	 * @Label(content="Nama Belakang")
	 * @var string
	 */
	protected $namaBelakang;

	/**
	 * Nama
	 * 
	 * @Column(name="nama", type="varchar(100)", length=100, nullable=true)
	 * @Label(content="Nama")
	 * @var string
	 */
	protected $nama;

	/**
	 * Koordinator
	 * 
	 * @Column(name="koordinator", type="tinyint(1)", length=1, nullable=true)
	 * @Label(content="Koordinator")
	 * @var boolean
	 */
	protected $koordinator;

	/**
	 * Jabatan ID
	 * 
	 * @Column(name="jabatan_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Jabatan ID")
	 * @var integer
	 */
	protected $jabatanId;

	/**
	 * Jabatan
	 * 
	 * @JoinColumn(name="jabatan_id", referenceColumnName="jabatan_id")
	 * @Label(content="Jabatan")
	 * @var JabatanMin
	 */
	protected $jabatan;

	/**
	 * Jenis Kelamin
	 * 
	 * @Column(name="jenis_kelamin", type="enum('L','P')", default_value="L", nullable=true)
	 * @DefaultColumn(value="L")
	 * @Label(content="Jenis Kelamin")
	 * @var string
	 */
	protected $jenisKelamin;

	/**
	 * Tempat Lahir
	 * 
	 * @Column(name="tempat_lahir", type="varchar(50)", length=50, nullable=true)
	 * @Label(content="Tempat Lahir")
	 * @var string
	 */
	protected $tempatLahir;

	/**
	 * Tanggal Lahir
	 * 
	 * @Column(name="tanggal_lahir", type="date", nullable=true)
	 * @Label(content="Tanggal Lahir")
	 * @var string
	 */
	protected $tanggalLahir;

	/**
	 * Email
	 * 
	 * @Column(name="email", type="varchar(100)", length=100, nullable=true)
	 * @Label(content="Email")
	 * @var string
	 */
	protected $email;

	/**
	 * Telepon
	 * 
	 * @Column(name="telepon", type="varchar(20)", length=20, nullable=true)
	 * @Label(content="Telepon")
	 * @var string
	 */
	protected $telepon;

	/**
	 * Tanda Tangan
	 * 
	 * @NotNull
	 * @Column(name="tanda_tangan", type="varchar(512)", length=512, nullable=false)
	 * @Label(content="Tanda Tangan")
	 * @var string
	 */
	protected $tandaTangan;

	/**
	 * Ukuran Baju
	 * 
	 * @NotNull
	 * @Column(name="ukuran_baju", type="varchar(40)", length=40, nullable=false)
	 * @Label(content="Ukuran Baju")
	 * @var string
	 */
	protected $ukuranBaju;

	/**
	 * Ukuran Sepatu
	 * 
	 * @NotNull
	 * @Column(name="ukuran_sepatu", type="varchar(40)", length=40, nullable=false)
	 * @Label(content="Ukuran Sepatu")
	 * @var string
	 */
	protected $ukuranSepatu;

	/**
	 * Auth
	 * 
	 * @Column(name="auth", type="varchar(50)", length=50, nullable=true)
	 * @Label(content="Auth")
	 * @var string
	 */
	protected $auth;

	/**
	 * Theme
	 * 
	 * @Column(name="theme", type="varchar(10)", length=10, default_value="a", nullable=true)
	 * @DefaultColumn(value="a")
	 * @Label(content="Theme")
	 * @var string
	 */
	protected $theme;

	/**
	 * Waktu Buat
	 * 
	 * @Column(name="waktu_buat", type="datetime", length=19, nullable=true, updatable=false)
	 * @Label(content="Waktu Buat")
	 * @var string
	 */
	protected $waktuBuat;

	/**
	 * Waktu Ubah
	 * 
	 * @Column(name="waktu_ubah", type="datetime", length=19, nullable=true)
	 * @Label(content="Waktu Ubah")
	 * @var string
	 */
	protected $waktuUbah;

	/**
	 * Waktu Terakhir Aktif
	 * 
	 * @Column(name="waktu_terakhir_aktif", type="datetime", length=19, nullable=true)
	 * @Label(content="Waktu Terakhir Aktif")
	 * @var string
	 */
	protected $waktuTerakhirAktif;

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
	 * IP Terakhir Aktif
	 * 
	 * @Column(name="ip_terakhir_aktif", type="varchar(50)", length=50, nullable=true)
	 * @Label(content="IP Terakhir Aktif")
	 * @var string
	 */
	protected $ipTerakhirAktif;

	/**
	 * Admin Buat
	 * 
	 * @Column(name="admin_buat", type="bigint(20)", length=20, nullable=true, updatable=false)
	 * @Label(content="Admin Buat")
	 * @var integer
	 */
	protected $adminBuat;

	/**
	 * Admin Ubah
	 * 
	 * @Column(name="admin_ubah", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Admin Ubah")
	 * @var integer
	 */
	protected $adminUbah;

	/**
	 * Blokir
	 * 
	 * @Column(name="blokir", type="tinyint(1)", length=1, nullable=true)
	 * @Label(content="Blokir")
	 * @var boolean
	 */
	protected $blokir;

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