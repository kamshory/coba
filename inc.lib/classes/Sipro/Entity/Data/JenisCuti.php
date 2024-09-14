<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * JenisCuti is entity of table jenis_cuti. You can join this entity to other entity using annotation JoinColumn. 
 * Visit https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="jenis_cuti")
 */
class JenisCuti extends MagicObject
{
	/**
	 * Jenis Cuti ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.IDENTITY)
	 * @NotNull
	 * @Column(name="jenis_cuti_id", type="bigint(20)", length=20, nullable=false, extra="auto_increment")
	 * @Label(content="Jenis Cuti ID")
	 * @var integer
	 */
	protected $jenisCutiId;

	/**
	 * Nama
	 * 
	 * @Column(name="nama", type="varchar(50)", length=50, nullable=true)
	 * @Label(content="Nama")
	 * @var string
	 */
	protected $nama;

	/**
	 * Keterangan
	 * 
	 * @Column(name="keterangan", type="text", nullable=true)
	 * @Label(content="Keterangan")
	 * @var string
	 */
	protected $keterangan;

	/**
	 * Lambang
	 * 
	 * @Column(name="lambang", type="varchar(2)", length=2, nullable=true)
	 * @Label(content="Lambang")
	 * @var string
	 */
	protected $lambang;

	/**
	 * Dibayar
	 * 
	 * @Column(name="dibayar", type="tinyint(1)", length=1, default_value="1", nullable=true)
	 * @DefaultColumn(value="1")
	 * @Label(content="Dibayar")
	 * @var boolean
	 */
	protected $dibayar;

	/**
	 * Berhubungan Proyek
	 * 
	 * @NotNull
	 * @Column(name="berhubungan_proyek", type="tinyint(1)", length=1, nullable=false)
	 * @Label(content="Berhubungan Proyek")
	 * @var boolean
	 */
	protected $berhubunganProyek;

	/**
	 * Kuota
	 * 
	 * @NotNull
	 * @Column(name="kuota", type="int(11)", length=11, nullable=false)
	 * @Label(content="Kuota")
	 * @var integer
	 */
	protected $kuota;

	/**
	 * Sort Order
	 * 
	 * @Column(name="sort_order", type="int(11)", length=11, default_value="1", nullable=true)
	 * @DefaultColumn(value="1")
	 * @Label(content="Sort Order")
	 * @var integer
	 */
	protected $sortOrder;

	/**
	 * Default Data
	 * 
	 * @Column(name="default_data", type="tinyint(1)", length=1, nullable=true)
	 * @Label(content="Default Data")
	 * @var boolean
	 */
	protected $defaultData;

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