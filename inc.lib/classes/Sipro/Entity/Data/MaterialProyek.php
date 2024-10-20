<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * MaterialProyek is entity of table material_proyek. You can join this entity to other entity using annotation JoinColumn. 
 * Don't forget to add "use" statement if the entity is outside the namespace.
 * @link https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @package Sipro\Entity\Data
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="material_proyek")
 */
class MaterialProyek extends MagicObject
{
	/**
	 * Material Proyek ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.IDENTITY)
	 * @NotNull
	 * @Column(name="material_proyek_id", type="bigint(20)", length=20, nullable=false, extra="auto_increment")
	 * @Label(content="Material Proyek ID")
	 * @var integer
	 */
	protected $materialProyekId;

	/**
	 * Pekerjaan ID
	 * 
	 * @Column(name="pekerjaan_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Pekerjaan ID")
	 * @var integer
	 */
	protected $pekerjaanId;

	/**
	 * Material ID
	 * 
	 * @Column(name="material_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Material ID")
	 * @var integer
	 */
	protected $materialId;

	/**
	 * Material
	 * 
	 * @JoinColumn(name="material_id", referenceColumnName="material_id")
	 * @Label(content="Material")
	 * @var Material
	 */
	protected $material;

	/**
	 * Jumlah
	 * 
	 * @Column(name="jumlah", type="float", nullable=true)
	 * @Label(content="Jumlah")
	 * @var double
	 */
	protected $jumlah;

	/**
	 * Proyek ID
	 * 
	 * @Column(name="proyek_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Proyek ID")
	 * @var integer
	 */
	protected $proyekId;

	/**
	 * Proyek
	 * 
	 * @JoinColumn(name="proyek_id", referenceColumnName="proyek_id")
	 * @Label(content="Proyek")
	 * @var ProyekMin
	 */
	protected $proyek;

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