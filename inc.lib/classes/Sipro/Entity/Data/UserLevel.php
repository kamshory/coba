<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * UserLevel is entity of table user_level. You can join this entity to other entity using annotation JoinColumn. 
 * Don't forget to add "use" statement if the entity is outside the namespace.
 * Visit https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="user_level")
 */
class UserLevel extends MagicObject
{
	/**
	 * User Level ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.IDENTITY)
	 * @NotNull
	 * @Column(name="user_level_id", type="bigint(20)", length=20, nullable=false, extra="auto_increment")
	 * @Label(content="User Level ID")
	 * @var integer
	 */
	protected $userLevelId;

	/**
	 * Nama
	 * 
	 * @Column(name="nama", type="varchar(20)", length=20, nullable=true)
	 * @Label(content="Nama")
	 * @var string
	 */
	protected $nama;

	/**
	 * Istimewa
	 * 
	 * @NotNull
	 * @Column(name="istimewa", type="tinyint(1)", length=1, nullable=false)
	 * @Label(content="Istimewa")
	 * @var boolean
	 */
	protected $istimewa;

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
	 * @Column(name="aktif", type="tinyint(1)", length=1, default_value="1", nullable=true)
	 * @DefaultColumn(value="1")
	 * @Label(content="Aktif")
	 * @var boolean
	 */
	protected $aktif;

}