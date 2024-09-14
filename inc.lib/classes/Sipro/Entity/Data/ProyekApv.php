<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * ProyekApv is entity of table proyek_apv. You can join this entity to other entity using annotation JoinColumn. 
 * Don't forget to add "use" statement if the entity is outside the namespace.
 * Visit https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="proyek_apv")
 */
class ProyekApv extends MagicObject
{
	/**
	 * Proyek Apv ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.UUID)
	 * @Column(name="proyek_apv_id", type="varchar(40)", length=40, default_value="NULL", nullable=true)
	 * @DefaultColumn(value="NULL")
	 * @Label(content="Proyek Apv ID")
	 * @var string
	 */
	protected $proyekApvId;

	/**
	 * Proyek ID
	 * 
	 * @NotNull
	 * @Column(name="proyek_id", type="bigint(20)", length=20, nullable=false)
	 * @Label(content="Proyek ID")
	 * @var integer
	 */
	protected $proyekId;

	/**
	 * Nama
	 * 
	 * @Column(name="nama", type="varchar(200)", length=200, nullable=true)
	 * @Label(content="Nama")
	 * @var string
	 */
	protected $nama;

	/**
	 * Deskripsi
	 * 
	 * @Column(name="deskripsi", type="longtext", nullable=true)
	 * @Label(content="Deskripsi")
	 * @var string
	 */
	protected $deskripsi;

	/**
	 * Pekerjaan
	 * 
	 * @Column(name="pekerjaan", type="text", nullable=true)
	 * @Label(content="Pekerjaan")
	 * @var string
	 */
	protected $pekerjaan;

	/**
	 * Kode Lokasi
	 * 
	 * @Column(name="kode_lokasi", type="varchar(100)", length=100, nullable=true)
	 * @Label(content="Kode Lokasi")
	 * @var string
	 */
	protected $kodeLokasi;

	/**
	 * Nomor Kontrak
	 * 
	 * @Column(name="nomor_kontrak", type="varchar(100)", length=100, nullable=true)
	 * @Label(content="Nomor Kontrak")
	 * @var string
	 */
	protected $nomorKontrak;

	/**
	 * Nomor Sla
	 * 
	 * @Column(name="nomor_sla", type="varchar(100)", length=100, nullable=true)
	 * @Label(content="Nomor Sla")
	 * @var string
	 */
	protected $nomorSla;

	/**
	 * Pelaksana
	 * 
	 * @Column(name="pelaksana", type="varchar(100)", length=100, nullable=true)
	 * @Label(content="Pelaksana")
	 * @var string
	 */
	protected $pelaksana;

	/**
	 * Pemberi Kerja
	 * 
	 * @Column(name="pemberi_kerja", type="varchar(100)", length=100, nullable=true)
	 * @Label(content="Pemberi Kerja")
	 * @var string
	 */
	protected $pemberiKerja;

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
	 * @var KtskMin
	 */
	protected $ktsk;

	/**
	 * Tanggal Mulai
	 * 
	 * @Column(name="tanggal_mulai", type="date", nullable=true)
	 * @Label(content="Tanggal Mulai")
	 * @var string
	 */
	protected $tanggalMulai;

	/**
	 * Tanggal Selesai
	 * 
	 * @Column(name="tanggal_selesai", type="date", nullable=true)
	 * @Label(content="Tanggal Selesai")
	 * @var string
	 */
	protected $tanggalSelesai;

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

	/**
	 * Sort Order
	 * 
	 * @Column(name="sort_order", type="int(11)", length=11, default_value="NULL", nullable=true)
	 * @DefaultColumn(value="NULL")
	 * @Label(content="Sort Order")
	 * @var integer
	 */
	protected $sortOrder;

	/**
	 * Approval Status
	 * 
	 * @Column(name="approval_status", type="int(4)", length=4, nullable=true)
	 * @Label(content="Approval Status")
	 * @var integer
	 */
	protected $approvalStatus;

}