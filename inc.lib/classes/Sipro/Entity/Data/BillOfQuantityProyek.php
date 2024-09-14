<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * BillOfQuantityProyek is entity of table bill_of_quantity_proyek. You can join this entity to other entity using annotation JoinColumn. 
 * Don't forget to add "use" statement if the entity is outside the namespace.
 * Visit https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="bill_of_quantity_proyek")
 */
class BillOfQuantityProyek extends MagicObject
{
	/**
	 * Bill Of Quantity Proyek ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.IDENTITY)
	 * @NotNull
	 * @Column(name="bill_of_quantity_proyek_id", type="bigint(20)", length=20, nullable=false, extra="auto_increment")
	 * @Label(content="Bill Of Quantity Proyek ID")
	 * @var integer
	 */
	protected $billOfQuantityProyekId;

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
	 * Buku Harian ID
	 * 
	 * @Column(name="buku_harian_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Buku Harian ID")
	 * @var integer
	 */
	protected $bukuHarianId;

	/**
	 * Buku Harian
	 * 
	 * @JoinColumn(name="buku_harian_id", referenceColumnName="buku_harian_id")
	 * @Label(content="Buku Harian")
	 * @var BukuHarianMin
	 */
	protected $bukuHarian;

	/**
	 * Bill Of Quantity ID
	 * 
	 * @Column(name="bill_of_quantity_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Bill Of Quantity ID")
	 * @var integer
	 */
	protected $billOfQuantityId;

	/**
	 * Bill Of Quantity
	 * 
	 * @JoinColumn(name="bill_of_quantity_id", referenceColumnName="bill_of_quantity_id")
	 * @Label(content="Bill Of Quantity")
	 * @var BillOfQuantityMin
	 */
	protected $billOfQuantity;

	/**
	 * Volume
	 * 
	 * @Column(name="volume", type="float", nullable=true)
	 * @Label(content="Volume")
	 * @var double
	 */
	protected $volume;

	/**
	 * Volume Proyek
	 * 
	 * @Column(name="volume_proyek", type="float", nullable=true)
	 * @Label(content="Volume Proyek")
	 * @var double
	 */
	protected $volumeProyek;

	/**
	 * Waktu Buat
	 * 
	 * @Column(name="waktu_buat", type="timestamp", length=19, nullable=true, updatable=false)
	 * @Label(content="Waktu Buat")
	 * @var string
	 */
	protected $waktuBuat;

	/**
	 * Waktu Ubah
	 * 
	 * @Column(name="waktu_ubah", type="timestamp", length=19, nullable=true)
	 * @Label(content="Waktu Ubah")
	 * @var string
	 */
	protected $waktuUbah;

	/**
	 * Supervisor Buat
	 * 
	 * @Column(name="supervisor_buat", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Supervisor Buat")
	 * @var integer
	 */
	protected $supervisorBuat;

	/**
	 * Pembuat
	 * 
	 * @JoinColumn(name="supervisor_buat", referenceColumnName="supervisor_id")
	 * @Label(content="Pembuat")
	 * @var SupervisorMin
	 */
	protected $pembuat;

	/**
	 * Supervisor Ubah
	 * 
	 * @Column(name="supervisor_ubah", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Supervisor Ubah")
	 * @var integer
	 */
	protected $supervisorUbah;

	/**
	 * Pengubah
	 * 
	 * @JoinColumn(name="supervisor_ubah", referenceColumnName="supervisor_id")
	 * @Label(content="Pengubah")
	 * @var SupervisorMin
	 */
	protected $pengubah;

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