<?php

namespace Sipro\Entity\App;

use MagicApp\Entity\AppUser;
use MagicApp\Entity\AppUserLevel;

/**
 * AppUserImpl 
 * 
 * @Entity
 * @JSON(property-naming-strategy=SNAKE_CASE, prettify=false)
 * @Table(name="user")
 */
class AppUserImpl extends AppUser
{
	/**
	 * User ID
	 * 
	 * @Id
	 * @GeneratedValue(strategy=GenerationType.UUID)
	 * @Column(name="user_id", type="varchar(40)", length=40, nullable=false)
	 * @DefaultColumn(value="NULL")
	 * @Label(content="User ID")
	 * @var string
	 */
	protected $userId;

	/**
	 * Name
	 * 
	 * @NotNull
	 * @Column(name="first_name", type="varchar(40)", length=40, default_value="NULL", nullable=true)
	 * @Label(content="Name")
	 * @var string
	 */
	protected $name;


	/**
	 * Username
	 * 
	 * @NotNull
	 * @Column(name="username", type="varchar(40)", length=40, default_value="NULL", nullable=true)
	 * @Label(content="Username")
	 * @var string
	 */
	protected $username;

	/**
	 * Password
	 * 
	 * @NotNull
	 * @Column(name="password", type="varchar(100)", length=100, default_value="NULL", nullable=true)
	 * @Label(content="Password")
	 * @var string
	 */
	protected $password;

	/**
	 * User Level ID
	 * 
	 * @NotNull
	 * @Column(name="user_level_id", type="varchar(40)", length=40, default_value="NULL", nullable=true)
	 * @Label(content="User Level ID")
	 * @var string
	 */
	protected $userLevelId;

	/**
	 * KTSK ID
	 * 
	 * @NotNull
	 * @Column(name="ktsk_id", type="bigint(20)", default_value="NULL", nullable=true)
	 * @Label(content="KTSK ID")
	 * @var string
	 */
	protected $ktskId;

	/**
	 * User Level
	 * 
	 * @NotNull
	 * @JoinColumn(name="user_level_id", referenceColumnName="user_level_id")
	 * @Label(content="User Level")
	 * @var AppUserLevelImpl
	 */
	protected $userLevel;

	/**
	 * Language ID
	 * 
	 * @NotNull
	 * @Column(name="lang_id", type="varchar(10)", length=10, default_value="NULL", nullable=true)
	 * @Label(content="Language ID")
	 * @var string
	 */
	protected $languageId;

	/**
	 * Blocked
	 * 
	 * @NotNull
	 * @Column(name="blocked", type="tinyint(1)", length=1, default_value="0", nullable=true)
	 * @Label(content="Blocked")
	 * @var boolean
	 */
	protected $blocked;

	/**
	 * Active
	 * 
	 * @NotNull
	 * @Column(name="active", type="tinyint(1)", length=1, default_value="1", nullable=true)
	 * @Label(content="Active")
	 * @var boolean
	 */
	protected $active;
	
}
