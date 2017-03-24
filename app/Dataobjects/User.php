<?php

// Define name space
namespace App\Dataobjects;

use Doctrine\ORM\Mapping as ORM;
use App\Mappings\Users;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class User extends Users{
	
}