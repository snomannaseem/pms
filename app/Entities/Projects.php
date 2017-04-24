<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projects
 *
 * @ORM\Table(name="projects", indexes={@ORM\Index(name="fk_projects_team_id", columns={"team_id"})})
 * @ORM\Entity
 */
class Projects
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
 * @var string
 *
 * @ORM\Column(name="title", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
 */
private $title;

/**
 * @var string
 *
 * @ORM\Column(name="description", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
 */
private $description;

/**
 * @var integer
 *
 * @ORM\Column(name="est_time", type="integer", precision=0, scale=0, nullable=true, unique=false)
 */
private $estTime;

/**
 * @var \DateTime
 *
 * @ORM\Column(name="est_deadline", type="datetime", precision=0, scale=0, nullable=true, unique=false)
 */
private $estDeadline;

/**
 * @var string
 *
 * @ORM\Column(name="status", type="string", length=30, precision=0, scale=0, nullable=true, unique=false)
 */
private $status;

/**
 * @var integer
 *
 * @ORM\Column(name="created_by", type="integer", precision=0, scale=0, nullable=true, unique=false)
 */
private $createdBy;

/**
 * @var \DateTime
 *
 * @ORM\Column(name="created_on", type="datetime", precision=0, scale=0, nullable=true, unique=false)
 */
private $createdOn;

/**
 * @var integer
 *
 * @ORM\Column(name="updated_by", type="integer", precision=0, scale=0, nullable=true, unique=false)
 */
private $updatedBy;

/**
 * @var \DateTime
 *
 * @ORM\Column(name="updated_on", type="datetime", precision=0, scale=0, nullable=true, unique=false)
 */
private $updatedOn;

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
 * Get id
 *
 * @return integer
 */
public function getId()
{
return $this->id;
}

/**
 * Set title
 *
 * @param string $title
 *
 * @return Projects
 */
public function setTitle($title)
{
$this->title = $title;

return $this;
}

/**
 * Get title
 *
 * @return string
 */
public function getTitle()
{
return $this->title;
}

/**
 * Set description
 *
 * @param string $description
 *
 * @return Projects
 */
public function setDescription($description)
{
$this->description = $description;

return $this;
}

/**
 * Get description
 *
 * @return string
 */
public function getDescription()
{
return $this->description;
}

/**
 * Set estTime
 *
 * @param integer $estTime
 *
 * @return Projects
 */
public function setEstTime($estTime)
{
$this->estTime = $estTime;

return $this;
}

/**
 * Get estTime
 *
 * @return integer
 */
public function getEstTime()
{
return $this->estTime;
}

/**
 * Set estDeadline
 *
 * @param \DateTime $estDeadline
 *
 * @return Projects
 */
public function setEstDeadline($estDeadline)
{
$this->estDeadline = $estDeadline;

return $this;
}

/**
 * Get estDeadline
 *
 * @return \DateTime
 */
public function getEstDeadline()
{
return $this->estDeadline;
}

/**
 * Set status
 *
 * @param string $status
 *
 * @return Projects
 */
public function setStatus($status)
{
$this->status = $status;

return $this;
}

/**
 * Get status
 *
 * @return string
 */
public function getStatus()
{
return $this->status;
}

/**
 * Set createdBy
 *
 * @param integer $createdBy
 *
 * @return Projects
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
 * @return Projects
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
 * Set updatedBy
 *
 * @param integer $updatedBy
 *
 * @return Projects
 */
public function setUpdatedBy($updatedBy)
{
$this->updatedBy = $updatedBy;

return $this;
}

/**
 * Get updatedBy
 *
 * @return integer
 */
public function getUpdatedBy()
{
return $this->updatedBy;
}

/**
 * Set updatedOn
 *
 * @param \DateTime $updatedOn
 *
 * @return Projects
 */
public function setUpdatedOn($updatedOn)
{
$this->updatedOn = $updatedOn;

return $this;
}

/**
 * Get updatedOn
 *
 * @return \DateTime
 */
public function getUpdatedOn()
{
return $this->updatedOn;
}

/**
 * Set team
 *
 * @param \Teams $team
 *
 * @return Projects
 */
public function setTeam(Teams $team = null)
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
}

