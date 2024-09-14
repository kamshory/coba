<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * Pesan is entity of table pesan. You can join this entity to other entity using annotation JoinColumn. 
 * Don't forget to add "use" statement if the entity is outside the namespace.
 * Visit https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="pesan")
 */
class Pesan extends MagicObject
{
	/**
	 * Pesan ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.IDENTITY)
	 * @NotNull
	 * @Column(name="pesan_id", type="bigint(20)", length=20, nullable=false, extra="auto_increment")
	 * @Label(content="Pesan ID")
	 * @var integer
	 */
	protected $pesanId;

	/**
	 * Pengirim User ID
	 * 
	 * @Column(name="pengirim_user_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Pengirim User ID")
	 * @var integer
	 */
	protected $pengirimUserId;

	/**
	 * Pengirim User
	 * 
	 * @JoinColumn(name="pengirim_user_id", referenceColumnName="user_id")
	 * @Label(content="Pengirim User")
	 * @var UserMin
	 */
	protected $pengirimUser;

	/**
	 * Pengirim Supervisor ID
	 * 
	 * @Column(name="pengirim_supervisor_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Pengirim Supervisor ID")
	 * @var integer
	 */
	protected $pengirimSupervisorId;

	/**
	 * Pengirim Supervisor
	 * 
	 * @JoinColumn(name="pengirim_supervisor_id", referenceColumnName="supervisor_id")
	 * @Label(content="Pengirim Supervisor")
	 * @var SupervisorMin
	 */
	protected $pengirimSupervisor;

	/**
	 * Penerima User ID
	 * 
	 * @Column(name="penerima_user_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Penerima User ID")
	 * @var integer
	 */
	protected $penerimaUserId;

	/**
	 * Penerima User
	 * 
	 * @JoinColumn(name="penerima_user_id", referenceColumnName="user_id")
	 * @Label(content="Penerima User")
	 * @var UserMin
	 */
	protected $penerimaUser;

	/**
	 * Penerima Supervisor ID
	 * 
	 * @Column(name="penerima_supervisor_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Penerima Supervisor ID")
	 * @var integer
	 */
	protected $penerimaSupervisorId;

	/**
	 * Penerima Supervisor
	 * 
	 * @JoinColumn(name="penerima_supervisor_id", referenceColumnName="supervisor_id")
	 * @Label(content="Penerima Supervisor")
	 * @var SupervisorMin
	 */
	protected $penerimaSupervisor;

	/**
	 * Subjek
	 * 
	 * @Column(name="subjek", type="varchar(100)", length=100, nullable=true)
	 * @Label(content="Subjek")
	 * @var string
	 */
	protected $subjek;

	/**
	 * Isi
	 * 
	 * @Column(name="isi", type="longtext", nullable=true)
	 * @Label(content="Isi")
	 * @var string
	 */
	protected $isi;

	/**
	 * Dibaca
	 * 
	 * @Column(name="dibaca", type="tinyint(1)", length=1, nullable=true)
	 * @Label(content="Dibaca")
	 * @var boolean
	 */
	protected $dibaca;

	/**
	 * Salinan
	 * 
	 * @Column(name="salinan", type="tinyint(1)", length=1, nullable=true)
	 * @Label(content="Salinan")
	 * @var boolean
	 */
	protected $salinan;

	/**
	 * Tautan Pesan
	 * 
	 * @Column(name="tautan_pesan", type="varchar(40)", length=40, nullable=true)
	 * @Label(content="Tautan Pesan")
	 * @var string
	 */
	protected $tautanPesan;

	/**
	 * Waktu Buat
	 * 
	 * @Column(name="waktu_buat", type="datetime", length=19, nullable=true)
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
	 * Waktu Baca
	 * 
	 * @Column(name="waktu_baca", type="datetime", length=19, nullable=true)
	 * @Label(content="Waktu Baca")
	 * @var string
	 */
	protected $waktuBaca;

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
	 * Aktif
	 * 
	 * @Column(name="aktif", type="tinyint(1)", length=1, default_value="1", nullable=true)
	 * @DefaultColumn(value="1")
	 * @Label(content="Aktif")
	 * @var boolean
	 */
	protected $aktif;

}