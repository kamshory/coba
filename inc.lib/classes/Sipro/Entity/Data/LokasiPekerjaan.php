<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * LokasiPekerjaan is entity of table lokasi_pekerjaan. You can join this entity to other entity using annotation JoinColumn. 
 * Don't forget to add "use" statement if the entity is outside the namespace.
 * Visit https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="lokasi_pekerjaan")
 */
class LokasiPekerjaan extends MagicObject
{
	/**
	 * Lokasi Pekerjaan ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.IDENTITY)
	 * @NotNull
	 * @Column(name="lokasi_pekerjaan_id", type="bigint(20)", length=20, nullable=false, extra="auto_increment")
	 * @Label(content="Lokasi Pekerjaan ID")
	 * @var integer
	 */
	protected $lokasiPekerjaanId;

	/**
	 * Pekerjaan ID
	 * 
	 * @Column(name="pekerjaan_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Pekerjaan ID")
	 * @var integer
	 */
	protected $pekerjaanId;

	/**
	 * Buku Harian ID
	 * 
	 * @Column(name="buku_harian_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Buku Harian ID")
	 * @var integer
	 */
	protected $bukuHarianId;

	/**
	 * Lokasi Proyek ID
	 * 
	 * @Column(name="lokasi_proyek_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Lokasi Proyek ID")
	 * @var integer
	 */
	protected $lokasiProyekId;

	/**
	 * Latitude
	 * 
	 * @Column(name="latitude", type="double", nullable=true)
	 * @Label(content="Latitude")
	 * @var double
	 */
	protected $latitude;

	/**
	 * Longitude
	 * 
	 * @Column(name="longitude", type="double", nullable=true)
	 * @Label(content="Longitude")
	 * @var double
	 */
	protected $longitude;

	/**
	 * Altitude
	 * 
	 * @Column(name="altitude", type="double", nullable=true)
	 * @Label(content="Altitude")
	 * @var double
	 */
	protected $altitude;

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