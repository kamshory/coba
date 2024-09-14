<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * SupervisorMin is entity of table supervisor. You can join this entity to other entity using annotation JoinColumn. 
 * Visit https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="supervisor")
 */
class SupervisorMin extends MagicObject
{
	/**
	 * Supervisor ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.IDENTITY)
	 * @NotNull
	 * @Column(name="supervisor_id", type="bigint(20)", length=20, nullable=false, extra="auto_increment")
	 * @Label(content="Supervisor ID")
	 * @var integer
	 */
	protected $supervisorId;

	/**
	 * Nip
	 * 
	 * @NotNull
	 * @Column(name="nip", type="varchar(30)", length=30, nullable=false)
	 * @Label(content="NIP")
	 * @var string
	 */
	protected $nip;

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
	 * Password
	 * 
	 * @Column(name="password", type="varchar(50)", length=50, nullable=true)
	 * @Label(content="Password")
	 * @var string
	 */
	protected $password;

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
	 * Waktu Terakhir Aktif
	 * 
	 * @Column(name="waktu_terakhir_aktif", type="timestamp", length=19, nullable=true)
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