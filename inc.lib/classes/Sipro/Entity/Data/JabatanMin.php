<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * JabatanMin is entity of table jabatan. You can join this entity to other entity using annotation JoinColumn. 
 * Visit https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="jabatan")
 */
class JabatanMin extends MagicObject
{
	/**
	 * Jabatan ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.IDENTITY)
	 * @NotNull
	 * @Column(name="jabatan_id", type="bigint(20)", length=20, nullable=false, extra="auto_increment")
	 * @Label(content="Jabatan ID")
	 * @var integer
	 */
	protected $jabatanId;

	/**
	 * Nama
	 * 
	 * @Column(name="nama", type="varchar(100)", length=100, nullable=true)
	 * @Label(content="Nama")
	 * @var string
	 */
	protected $nama;

	/**
	 * Singkatan
	 * 
	 * @Column(name="singkatan", type="varchar(20)", length=20, nullable=true)
	 * @Label(content="Singkatan")
	 * @var string
	 */
	protected $singkatan;

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