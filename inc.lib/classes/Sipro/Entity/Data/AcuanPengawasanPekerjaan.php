<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * AcuanPengawasanPekerjaan is entity of table acuan_pengawasan_pekerjaan. You can join this entity to other entity using annotation JoinColumn. 
 * Don't forget to add "use" statement if the entity is outside the namespace.
 * @link https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @package Sipro\Entity\Data
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="acuan_pengawasan_pekerjaan")
 */
class AcuanPengawasanPekerjaan extends MagicObject
{
	/**
	 * Acuan Pengawasan Pekerjaan ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.IDENTITY)
	 * @NotNull
	 * @Column(name="acuan_pengawasan_pekerjaan_id", type="bigint(20)", length=20, nullable=false, extra="auto_increment")
	 * @Label(content="Acuan Pengawasan Pekerjaan ID")
	 * @var integer
	 */
	protected $acuanPengawasanPekerjaanId;

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
	 * Acuan Pengawasan ID
	 * 
	 * @Column(name="acuan_pengawasan_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Acuan Pengawasan ID")
	 * @var integer
	 */
	protected $acuanPengawasanId;

	/**
	 * Acuan Pengawasan
	 * 
	 * @JoinColumn(name="acuan_pengawasan_id", referenceColumnName="acuan_pengawasan_id")
	 * @Label(content="Acuan Pengawasan")
	 * @var AcuanPengawasan
	 */
	protected $acuanPengawasan;

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