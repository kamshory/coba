<?php

namespace Sipro\Entity\Data;

use MagicObject\MagicObject;

/**
 * CatatanSalahLogin is entity of table catatan_salah_login. You can join this entity to other entity using annotation JoinColumn. 
 * Don't forget to add "use" statement if the entity is outside the namespace.
 * Visit https://github.com/Planetbiru/MagicObject/blob/main/tutorial.md#entity
 * 
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="catatan_salah_login")
 */
class CatatanSalahLogin extends MagicObject
{
	/**
	 * Catatan Salah Login ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.UUID)
	 * @NotNull
	 * @Column(name="catatan_salah_login_id", type="varchar(40)", length=40, nullable=false)
	 * @Label(content="Catatan Salah Login ID")
	 * @var string
	 */
	protected $catatanSalahLoginId;

	/**
	 * Grup Pengguna
	 * 
	 * @Column(name="grup_pengguna", type="varchar(40)", length=40, nullable=true)
	 * @Label(content="Grup Pengguna")
	 * @var string
	 */
	protected $grupPengguna;

	/**
	 * User ID
	 * 
	 * @Column(name="user_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="User ID")
	 * @var string
	 */
	protected $userId;

	/**
	 * User
	 * 
	 * @JoinColumn(name="user_id", referenceColumnName="user_id")
	 * @Label(content="User")
	 * @var User
	 */
	protected $user;

	/**
	 * Supervisor ID
	 * 
	 * @Column(name="supervisor_id", type="bigint(20)", length=20, nullable=true)
	 * @Label(content="Supervisor ID")
	 * @var string
	 */
	protected $supervisorId;

	/**
	 * Supervisor
	 * 
	 * @JoinColumn(name="supervisor_id", referenceColumnName="supervisor_id")
	 * @Label(content="Supervisor")
	 * @var Supervisor
	 */
	protected $supervisor;

	/**
	 * Waktu Buat
	 * 
	 * @Column(name="waktu_buat", type="timestamp", length=19, nullable=true, updatable=false)
	 * @Label(content="Waktu Buat")
	 * @var string
	 */
	protected $waktuBuat;

	/**
	 * IP Buat
	 * 
	 * @Column(name="ip_buat", type="varchar(50)", length=50, nullable=true)
	 * @Label(content="IP Buat")
	 * @var string
	 */
	protected $ipBuat;

}