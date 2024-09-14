<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * BillOfQuantityHistory is entity of table bill_of_quantity_history. You can join this entity to other entity using annotation JoinColumn. 
 * Don't forget to add "use" statement if the entity is outside the namespace.
 * Visit https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="bill_of_quantity_history")
 */
class BillOfQuantityHistory extends MagicObject
{
	/**
	 * Bill Of Quantity ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.IDENTITY)
	 * @NotNull
	 * @Column(name="bill_of_quantity_history_id", type="bigint(20)", length=20, nullable=false, extra="auto_increment")
	 * @Label(content="Bill Of Quantity History ID")
	 * @var integer
	 */
	protected $billOfQuantityHistoryId;

    /**
	 * Bill Of Quantity ID
	 * 
	 * @Column(name="bill_of_quantity_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Bill Of Quantity ID")
	 * @var integer
	 */
	protected $billOfQuantityId;
	
	/**
	 * Parent Boq
	 * 
	 * @JoinColumn(name="bill_of_quantity_id", referenceColumnName="bill_of_quantity_id")
	 * @Label(content="Parent Boq")
	 * @var BillOfQuantityMin
	 */
	protected $billOfQuantity;

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
	 * Parent ID
	 * 
	 * @Column(name="parent_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Parent ID")
	 * @var integer
	 */
	protected $parentId;

	/**
	 * Parent Boq
	 * 
	 * @JoinColumn(name="parent_id", referenceColumnName="bill_of_quantity_id")
	 * @Label(content="Parent Boq")
	 * @var BillOfQuantityMin
	 */
	protected $parentBoq;

	/**
	 * Level
	 * 
	 * @Column(name="level", type="int(11)", length=11, nullable=true)
	 * @Label(content="Level")
	 * @var integer
	 */
	protected $level;

	/**
	 * Nama
	 * 
	 * @Column(name="nama", type="varchar(255)", length=255, nullable=true)
	 * @Label(content="Nama")
	 * @var string
	 */
	protected $nama;

	/**
	 * Satuan
	 * 
	 * @Column(name="satuan", type="varchar(50)", length=50, nullable=true)
	 * @Label(content="Satuan")
	 * @var string
	 */
	protected $satuan;

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
	 * Harga
	 * 
	 * @Column(name="harga", type="float", nullable=true)
	 * @Label(content="Harga")
	 * @var double
	 */
	protected $harga;

	/**
	 * Sort Order
	 * 
	 * @Column(name="sort_order", type="int(11)", length=11, nullable=true)
	 * @Label(content="Sort Order")
	 * @var integer
	 */
	protected $sortOrder;

	/**
	 * Admin Buat
	 * 
	 * @Column(name="admin_buat", type="bigint(20)", length=20, nullable=true, updatable=false)
	 * @Label(content="Admin Buat")
	 * @var integer
	 */
	protected $adminBuat;

	/**
	 * Admin Ubah
	 * 
	 * @Column(name="admin_ubah", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Admin Ubah")
	 * @var integer
	 */
	protected $adminUbah;

	/**
	 * Waktu Buat
	 * 
	 * @Column(name="waktu_buat", type="timestamp", length=19, nullable=true, updatable=false, extra="on update CURRENT_TIMESTAMP")
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
	 * IP Buat
	 * 
	 * @Column(name="ip_buat", type="varchar(50)", length=50, nullable=true, updatable=false)
	 * @Label(content="IP Buat")
	 * @var string
	 */
	protected $ipBuat;

	/**
	 * IP Ubah
	 * 
	 * @Column(name="ip_ubah", type="varchar(50)", length=50, nullable=true)
	 * @Label(content="IP Ubah")
	 * @var string
	 */
	protected $ipUbah;

	/**
	 * Aktif
	 * 
	 * @NotNull
	 * @Column(name="aktif", type="tinyint(4)", length=4, default_value="1", nullable=false)
	 * @DefaultColumn(value="1")
	 * @Label(content="Aktif")
	 * @var integer
	 */
	protected $aktif;

}