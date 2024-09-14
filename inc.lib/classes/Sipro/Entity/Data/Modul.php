<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * Modul is entity of table modul. You can join this entity to other entity using annotation JoinColumn. 
 * Don't forget to add "use" statement if the entity is outside the namespace.
 * Visit https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="modul")
 */
class Modul extends MagicObject
{
	/**
	 * Modul ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.IDENTITY)
	 * @NotNull
	 * @Column(name="modul_id", type="bigint(20)", length=20, nullable=false, extra="auto_increment")
	 * @Label(content="Modul ID")
	 * @var integer
	 */
	protected $modulId;

	/**
	 * Kode Modul
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.UUID)
	 * @NotNull
	 * @Column(name="kode_modul", type="varchar(45)", length=45, nullable=false)
	 * @Label(content="Kode Modul")
	 * @var string
	 */
	protected $kodeModul;

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
	 * Icon
	 * 
	 * @Column(name="icon", type="varchar(50)", length=50, nullable=true)
	 * @Label(content="Icon")
	 * @var string
	 */
	protected $icon;

	/**
	 * Grup Modul ID
	 * 
	 * @NotNull
	 * @Column(name="grup_modul_id", type="bigint(20)", length=20, nullable=false)
	 * @Label(content="Grup Modul ID")
	 * @var integer
	 */
	protected $grupModulId;

	/**
	 * Grup Modul
	 * 
	 * @JoinColumn(name="grup_modul_id", referenceColumnName="grup_modul_id")
	 * @Label(content="Grup Modul")
	 * @var GrupModul
	 */
	protected $grupModul;

	/**
	 * Menu
	 * 
	 * @NotNull
	 * @Column(name="menu", type="tinyint(1)", length=1, default_value="1", nullable=false)
	 * @DefaultColumn(value="1")
	 * @Label(content="Menu")
	 * @var boolean
	 */
	protected $menu;

	/**
	 * Url
	 * 
	 * @NotNull
	 * @Column(name="url", type="varchar(100)", length=100, nullable=false)
	 * @Label(content="Url")
	 * @var string
	 */
	protected $url;

	/**
	 * Istimewa
	 * 
	 * @NotNull
	 * @Column(name="istimewa", type="tinyint(4)", length=4, default_value="1", nullable=false)
	 * @DefaultColumn(value="1")
	 * @Label(content="Istimewa")
	 * @var integer
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
	 * @NotNull
	 * @Column(name="aktif", type="tinyint(1)", length=1, default_value="1", nullable=false)
	 * @DefaultColumn(value="1")
	 * @Label(content="Aktif")
	 * @var boolean
	 */
	protected $aktif;

}