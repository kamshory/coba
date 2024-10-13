<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * Periode is entity of table periode. You can join this entity to other entity using annotation JoinColumn. 
 * Don't forget to add "use" statement if the entity is outside the namespace.
 * Visit https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="periode")
 */
class Periode extends MagicObject
{
	/**
	 * Periode ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.UUID)
	 * @NotNull
	 * @Column(name="periode_id", type="varchar(6)", length=6, nullable=false)
	 * @Label(content="Periode ID")
	 * @var string
	 */
	protected $periodeId;

	/**
	 * Nama
	 * 
	 * @Column(name="nama", type="varchar(40)", length=40, nullable=true)
	 * @Label(content="Nama")
	 * @var string
	 */
	protected $nama;

}