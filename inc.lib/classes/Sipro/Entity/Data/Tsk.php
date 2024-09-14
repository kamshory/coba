<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * Tsk is entity of table tsk. You can join this entity to other entity using annotation JoinColumn. 
 * Don't forget to add "use" statement if the entity is outside the namespace.
 * Visit https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="tsk")
 */
class Tsk extends MagicObject
{
	/**
	 * Tsk ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.IDENTITY)
	 * @NotNull
	 * @Column(name="tsk_id", type="bigint(20)", length=20, nullable=false, extra="auto_increment")
	 * @Label(content="TSK ID")
	 * @var integer
	 */
	protected $tskId;

	/**
	 * Nama
	 * 
	 * @Column(name="nama", type="varchar(100)", length=100, nullable=true)
	 * @Label(content="Nama")
	 * @var string
	 */
	protected $nama;

	/**
	 * Umk ID
	 * 
	 * @Column(name="umk_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="UMK ID")
	 * @var integer
	 */
	protected $umkId;

	/**
	 * Umk
	 * 
	 * @JoinColumn(name="umk_id", referenceColumnName="umk_id")
	 * @Label(content="UMK")
	 * @var Umk
	 */
	protected $umk;

	/**
	 * Alamat
	 * 
	 * @Column(name="alamat", type="varchar(200)", length=200, nullable=true)
	 * @Label(content="Alamat")
	 * @var string
	 */
	protected $alamat;

	/**
	 * Telepon
	 * 
	 * @Column(name="telepon", type="varchar(20)", length=20, nullable=true)
	 * @Label(content="Telepon")
	 * @var string
	 */
	protected $telepon;

	/**
	 * Faksimili
	 * 
	 * @Column(name="faksimili", type="varchar(20)", length=20, nullable=true)
	 * @Label(content="Faksimili")
	 * @var string
	 */
	protected $faksimili;

	/**
	 * Email
	 * 
	 * @Column(name="email", type="varchar(100)", length=100, nullable=true)
	 * @Label(content="Email")
	 * @var string
	 */
	protected $email;

	/**
	 * Website
	 * 
	 * @Column(name="website", type="varchar(100)", length=100, nullable=true)
	 * @Label(content="Website")
	 * @var string
	 */
	protected $website;

	/**
	 * Provinsi
	 * 
	 * @Column(name="provinsi", type="varchar(100)", length=100, nullable=true)
	 * @Label(content="Provinsi")
	 * @var string
	 */
	protected $provinsi;

	/**
	 * Kabupaten
	 * 
	 * @Column(name="kabupaten", type="varchar(100)", length=100, nullable=true)
	 * @Label(content="Kabupaten")
	 * @var string
	 */
	protected $kabupaten;

	/**
	 * Kecamatan
	 * 
	 * @Column(name="kecamatan", type="varchar(100)", length=100, nullable=true)
	 * @Label(content="Kecamatan")
	 * @var string
	 */
	protected $kecamatan;

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
	 * IP Buat
	 * 
	 * @Column(name="ip_buat", type="varchar(45)", length=45, nullable=true, updatable=false)
	 * @Label(content="IP Buat")
	 * @var string
	 */
	protected $ipBuat;

	/**
	 * IP Ubah
	 * 
	 * @Column(name="ip_ubah", type="varchar(45)", length=45, nullable=true)
	 * @Label(content="IP Ubah")
	 * @var string
	 */
	protected $ipUbah;

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
	 * Aktif
	 * 
	 * @Column(name="aktif", type="tinyint(1)", length=1, default_value="1", nullable=true)
	 * @DefaultColumn(value="1")
	 * @Label(content="Aktif")
	 * @var boolean
	 */
	protected $aktif;

}