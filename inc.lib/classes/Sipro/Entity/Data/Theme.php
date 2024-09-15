<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * Theme is entity of table theme. You can join this entity to other entity using annotation JoinColumn. 
 * Don't forget to add "use" statement if the entity is outside the namespace.
 * Visit https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="theme")
 */
class Theme extends MagicObject
{
	/**
	 * Theme ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.UUID)
	 * @NotNull
	 * @Column(name="theme_id", type="varchar(45)", length=45, nullable=false)
	 * @Label(content="Theme ID")
	 * @var string
	 */
	protected $themeId;

	/**
	 * Nama
	 * 
	 * @NotNull
	 * @Column(name="nama", type="varchar(45)", length=45, nullable=false)
	 * @Label(content="Nama")
	 * @var string
	 */
	protected $nama;

	/**
	 * Default Data
	 * 
	 * @Column(name="default_data", type="tinyint(1)", length=1, nullable=true)
	 * @Label(content="Default Data")
	 * @var boolean
	 */
	protected $defaultData;

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
	 * Aktif
	 * 
	 * @NotNull
	 * @Column(name="aktif", type="tinyint(1)", length=1, default_value="1", nullable=false)
	 * @DefaultColumn(value="1")
	 * @Label(content="Aktif")
	 * @var boolean
	 */
	protected $aktif;

}