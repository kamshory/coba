<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * BukuHarian is entity of table buku_harian. You can join this entity to other entity using annotation JoinColumn. 
 * Don't forget to add "use" statement if the entity is outside the namespace.
 * @link https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @package Sipro\Entity\Data
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="buku_harian")
 */
class BukuHarian extends MagicObject
{
	/**
	 * Buku Harian ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.IDENTITY)
	 * @NotNull
	 * @Column(name="buku_harian_id", type="bigint(20)", length=20, nullable=false, extra="auto_increment")
	 * @Label(content="Buku Harian ID")
	 * @var integer
	 */
	protected $bukuHarianId;

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
	 * Tanggal
	 * 
	 * @Column(name="tanggal", type="date", nullable=true)
	 * @Label(content="Tanggal")
	 * @var string
	 */
	protected $tanggal;

	/**
	 * Permasalahan
	 * 
	 * @Column(name="permasalahan", type="longtext", nullable=true)
	 * @Label(content="Permasalahan")
	 * @var string
	 */
	protected $permasalahan;

	/**
	 * Rekomendasi
	 * 
	 * @Column(name="rekomendasi", type="longtext", nullable=true)
	 * @Label(content="Rekomendasi")
	 * @var string
	 */
	protected $rekomendasi;

	/**
	 * C 00
	 * 
	 * @Column(name="c_00", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 00")
	 * @var string
	 */
	protected $c00;

	/**
	 * C 01
	 * 
	 * @Column(name="c_01", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 01")
	 * @var string
	 */
	protected $c01;

	/**
	 * C 02
	 * 
	 * @Column(name="c_02", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 02")
	 * @var string
	 */
	protected $c02;

	/**
	 * C 03
	 * 
	 * @Column(name="c_03", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 03")
	 * @var string
	 */
	protected $c03;

	/**
	 * C 04
	 * 
	 * @Column(name="c_04", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 04")
	 * @var string
	 */
	protected $c04;

	/**
	 * C 05
	 * 
	 * @Column(name="c_05", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 05")
	 * @var string
	 */
	protected $c05;

	/**
	 * C 06
	 * 
	 * @Column(name="c_06", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 06")
	 * @var string
	 */
	protected $c06;

	/**
	 * C 07
	 * 
	 * @Column(name="c_07", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 07")
	 * @var string
	 */
	protected $c07;

	/**
	 * C 08
	 * 
	 * @Column(name="c_08", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 08")
	 * @var string
	 */
	protected $c08;

	/**
	 * C 09
	 * 
	 * @Column(name="c_09", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 09")
	 * @var string
	 */
	protected $c09;

	/**
	 * C 10
	 * 
	 * @Column(name="c_10", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 10")
	 * @var string
	 */
	protected $c10;

	/**
	 * C 11
	 * 
	 * @Column(name="c_11", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 11")
	 * @var string
	 */
	protected $c11;

	/**
	 * C 12
	 * 
	 * @Column(name="c_12", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 12")
	 * @var string
	 */
	protected $c12;

	/**
	 * C 13
	 * 
	 * @Column(name="c_13", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 13")
	 * @var string
	 */
	protected $c13;

	/**
	 * C 14
	 * 
	 * @Column(name="c_14", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 14")
	 * @var string
	 */
	protected $c14;

	/**
	 * C 15
	 * 
	 * @Column(name="c_15", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 15")
	 * @var string
	 */
	protected $c15;

	/**
	 * C 16
	 * 
	 * @Column(name="c_16", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 16")
	 * @var string
	 */
	protected $c16;

	/**
	 * C 17
	 * 
	 * @Column(name="c_17", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 17")
	 * @var string
	 */
	protected $c17;

	/**
	 * C 18
	 * 
	 * @Column(name="c_18", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 18")
	 * @var string
	 */
	protected $c18;

	/**
	 * C 19
	 * 
	 * @Column(name="c_19", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 19")
	 * @var string
	 */
	protected $c19;

	/**
	 * C 20
	 * 
	 * @Column(name="c_20", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 20")
	 * @var string
	 */
	protected $c20;

	/**
	 * C 21
	 * 
	 * @Column(name="c_21", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 21")
	 * @var string
	 */
	protected $c21;

	/**
	 * C 22
	 * 
	 * @Column(name="c_22", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 22")
	 * @var string
	 */
	protected $c22;

	/**
	 * C 23
	 * 
	 * @Column(name="c_23", type="char(1)", length=1, nullable=true)
	 * @Label(content="C 23")
	 * @var string
	 */
	protected $c23;

	/**
	 * Ktsk ID
	 * 
	 * @Column(name="ktsk_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="KTSK ID")
	 * @var integer
	 */
	protected $ktskId;

	/**
	 * Ktsk
	 * 
	 * @JoinColumn(name="ktsk_id", referenceColumnName="ktsk_id")
	 * @Label(content="KTSK")
	 * @var Ktsk
	 */
	protected $ktsk;

	/**
	 * Acc Ktsk
	 * 
	 * @Column(name="acc_ktsk", type="int(11)", length=11, nullable=true)
	 * @Label(content="Acc Ktsk")
	 * @var integer
	 */
	protected $accKtsk;

	/**
	 * Waktu Acc Ktsk
	 * 
	 * @Column(name="waktu_acc_ktsk", type="timestamp", length=19, nullable=true)
	 * @Label(content="Waktu Acc Ktsk")
	 * @var string
	 */
	protected $waktuAccKtsk;

	/**
	 * Koordinator ID
	 * 
	 * @Column(name="koordinator_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Koordinator ID")
	 * @var integer
	 */
	protected $koordinatorId;

	/**
	 * Koordinator
	 * 
	 * @JoinColumn(name="koordinator_id", referenceColumnName="supervisor_id")
	 * @Label(content="Koordinator")
	 * @var SupervisorMin
	 */
	protected $koordinator;

	/**
	 * Acc Koordinator
	 * 
	 * @Column(name="acc_koordinator", type="int(11)", length=11, nullable=true)
	 * @Label(content="Acc Koordinator")
	 * @var integer
	 */
	protected $accKoordinator;

	/**
	 * Waktu Acc Koordinator
	 * 
	 * @Column(name="waktu_acc_koordinator", type="timestamp", length=19, nullable=true)
	 * @Label(content="Waktu Acc Koordinator")
	 * @var string
	 */
	protected $waktuAccKoordinator;

	/**
	 * Komentar Ktsk
	 * 
	 * @Column(name="komentar_ktsk", type="longtext", nullable=true)
	 * @Label(content="Komentar Ktsk")
	 * @var string
	 */
	protected $komentarKtsk;

	/**
	 * Komentar Koordinator
	 * 
	 * @Column(name="komentar_koordinator", type="longtext", nullable=true)
	 * @Label(content="Komentar Koordinator")
	 * @var string
	 */
	protected $komentarKoordinator;

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