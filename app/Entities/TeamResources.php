<?php


namespace App\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * TeamResources
 *
 * @ORM\Table(name="team_resources", indexes={@ORM\Index(name="fk_team_resources_team_id", columns={"team_id"}), @ORM\Index(name="fk_team_resources_user_id", columns={"user_id"}), @ORM\Index(name="fk_team_resources_role_id", columns={"role_id"})})
 * @ORM\Entity
 */
class TeamResources
{
/**
 * @var integer
 *
 * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
 * @ORM\Id
 * @ORM\GeneratedValue(strategy="IDENTITY")
 */
private $id;

/**
 * @var integer
 *
 * @ORM\Column(name="created_by", type="integer", precision=0, scale=0, nullable=false, unique=false)
 */
private $createdBy;

/**
 * @var \DateTime
 *
 * @ORM\Column(name="created_on", type="datetime", precision=0, scale=0, nullable=false, unique=false)
 */
private $createdOn;

/**
 * @var integer
 *
 * @ORM\Column(name="deleted_by", type="integer", precision=0, scale=0, nullable=true, unique=false)
 */
private $deletedBy;

/**
 * @var \DateTime
 *
 * @ORM\Column(name="deleted_on", type="datetime", precision=0, scale=0, nullable=true, unique=false)
 */
private $deletedOn;

/**
 * @var \Roles
 *
 * @ORM\ManyToOne(targetEntity="Roles")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=true)
 * })
 */
private $role;

/**
 * @var \Teams
 *
 * @ORM\ManyToOne(targetEntity="Teams")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="team_id", referencedColumnName="id", nullable=true)
 * })
 */
private $team;

/**
 * @var \Users
 *
 * @ORM\ManyToOne(targetEntity="Users")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
 * })
 */
private $user;


/**
 * Get id
 *
 * @return integer
 */
public function getId()
{
return $this->id;
}

/**
 * Set createdBy
 *
 * @param integer $createdBy
 *
 * @return TeamResources
 */
public function setCreatedBy($createdBy)
{
$this->createdBy = $createdBy;

return $this;
}

/**
 * Get createdBy
 *
 * @return integer
 */
public function getCreatedBy()
{
return $this->createdBy;
}

/**
 * Set createdOn
 *
 * @param \DateTime $createdOn
 *
 * @return TeamResources
 */
public function setCreatedOn($createdOn)
{
$this->createdOn = $createdOn;

return $this;
}

/**
 * Get createdOn
 *
 * @return \DateTime
 */
public function getCreatedOn()
{
return $this->createdOn;
}

/**
 * Set deletedBy
 *
 * @param integer $deletedBy
 *
 * @return TeamResources
 */
public function setDeletedBy($deletedBy)
{
$this->deletedBy = $deletedBy;

return $this;
}

/**
 * Get deletedBy
 *
 * @return integer
 */
public function getDeletedBy()
{
return $this->deletedBy;
}

/**
 * Set deletedOn
 *
 * @param \DateTime $deletedOn
 *
 * @return TeamResources
 */
public function setDeletedOn($deletedOn)
{
$this->deletedOn = $deletedOn;

return $this;
}

/**
 * Get deletedOn
 *
 * @return \DateTime
 */
public function getDeletedOn()
{
return $this->deletedOn;
}

/**
 * Set role
 *
 * @param \Roles $role
 *
 * @return TeamResources
 */
public function setRole(\Roles $role = null)
{
$this->role = $role;

return $this;
}

/**
 * Get role
 *
 * @return \Roles
 */
public function getRole()
{
return $this->role;
}

/**
 * Set team
 *
 * @param \Teams $team
 *
 * @return TeamResources
 */
public function setTeam(\Teams $team = null)
{
$this->team = $team;

return $this;
}

/**
 * Get team
 *
 * @return \Teams
 */
public function getTeam()
{
return $this->team;
}

/**
 * Set user
 *
 * @param \Users $user
 *
 * @return TeamResources
 */
public function setUser(\Users $user = null)
{
$this->user = $user;

return $this;
}

/**
 * Get user
 *
 * @return \Users
 */
public function getUser()
{
return $this->user;
}
}

