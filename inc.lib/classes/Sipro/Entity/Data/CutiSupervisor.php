<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * CutiSupervisor is entity of table cuti_supervisor. You can join this entity to other entity using annotation JoinColumn. 
 * Don't forget to add "use" statement if the entity is outside the namespace.
 * Visit https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="cuti_supervisor")
 */
class CutiSupervisor extends MagicObject
{
	/**
	 * Cuti Supervisor ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.IDENTITY)
	 * @NotNull
	 * @Column(name="cuti_supervisor_id", type="bigint(20)", length=20, nullable=false, extra="auto_increment")
	 * @Label(content="Cuti Supervisor ID")
	 * @var integer
	 */
	protected $cutiSupervisorId;

	/**
	 * Cuti ID
	 * 
	 * @Column(name="cuti_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Cuti ID")
	 * @var integer
	 */
	protected $cutiId;
	
	/**
	 * Cuti
	 * 
	 * @JoinColumn(name="cuti_id", referenceColumnName="cuti_id")
	 * @Label(content="Cuti")
	 * @var Cuti
	 */
	protected $cuti;

	/**
	 * Supervisor ID
	 * 
	 * @Column(name="supervisor_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Supervisor ID")
	 * @var integer
	 */
	protected $supervisorId;

	/**
	 * Supervisor
	 * 
	 * @JoinColumn(name="supervisor_id", referenceColumnName="supervisor_id")
	 * @Label(content="Supervisor")
	 * @var SupervisorMin
	 */
	protected $supervisor;

	/**
	 * Jenis Cuti ID
	 * 
	 * @Column(name="jenis_cuti_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Jenis Cuti ID")
	 * @var integer
	 */
	protected $jenisCutiId;

	/**
	 * Jenis Cuti
	 * 
	 * @JoinColumn(name="jenis_cuti_id", referenceColumnName="jenis_cuti_id")
	 * @Label(content="Jenis Cuti")
	 * @var JenisCuti
	 */
	protected $jenisCuti;

	/**
	 * Dibayar
	 * 
	 * @Column(name="dibayar", type="tinyint(1)", length=1, default_value="1", nullable=true)
	 * @DefaultColumn(value="1")
	 * @Label(content="Dibayar")
	 * @var boolean
	 */
	protected $dibayar;

	/**
	 * Tanggal
	 * 
	 * @Column(name="tanggal", type="date", nullable=true)
	 * @Label(content="Tanggal")
	 * @var string
	 */
	protected $tanggal;

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