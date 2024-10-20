<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * JenisPerjalananDinas is entity of table jenis_perjalanan_dinas. You can join this entity to other entity using annotation JoinColumn. 
 * @link https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @package Sipro\Entity\Data
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="jenis_perjalanan_dinas")
 */
class JenisPerjalananDinas extends MagicObject
{
	/**
	 * Jenis Perjalanan Dinas ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.IDENTITY)
	 * @NotNull
	 * @Column(name="jenis_perjalanan_dinas_id", type="bigint(20)", length=20, nullable=false, extra="auto_increment")
	 * @Label(content="Jenis Perjalanan Dinas ID")
	 * @var integer
	 */
	protected $jenisPerjalananDinasId;

	/**
	 * Nama
	 * 
	 * @Column(name="nama", type="varchar(100)", length=100, nullable=true)
	 * @Label(content="Nama")
	 * @var string
	 */
	protected $nama;

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