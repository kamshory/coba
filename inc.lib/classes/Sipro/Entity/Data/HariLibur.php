<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * HariLibur is entity of table hari_libur. You can join this entity to other entity using annotation JoinColumn. 
 * Don't forget to add "use" statement if the entity is outside the namespace.
 * Visit https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="hari_libur")
 */
class HariLibur extends MagicObject
{
	/**
	 * Hari Libur ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.IDENTITY)
	 * @NotNull
	 * @Column(name="hari_libur_id", type="bigint(20)", length=20, nullable=false, extra="auto_increment")
	 * @Label(content="Hari Libur ID")
	 * @var integer
	 */
	protected $hariLiburId;

	/**
	 * Tanggal
	 * 
	 * @Column(name="tanggal", type="date", nullable=true)
	 * @Label(content="Tanggal")
	 * @var string
	 */
	protected $tanggal;

	/**
	 * Nama
	 * 
	 * @Column(name="nama", type="varchar(50)", length=50, nullable=true)
	 * @Label(content="Nama")
	 * @var string
	 */
	protected $nama;

	/**
	 * Jenis Hari Libur ID
	 * 
	 * @Column(name="jenis_hari_libur_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Jenis Hari Libur ID")
	 * @var integer
	 */
	protected $jenisHariLiburId;

	/**
	 * Jenis Hari Libur
	 * 
	 * @JoinColumn(name="jenis_hari_libur_id", referenceColumnName="jenis_hari_libur_id")
	 * @Label(content="Jenis Hari Libur")
	 * @var JenisHariLibur
	 */
	protected $jenisHariLibur;

	/**
	 * Buka
	 * 
	 * @Column(name="buka", type="tinyint(1)", length=1, nullable=true)
	 * @Label(content="Buka")
	 * @var boolean
	 */
	protected $buka;

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