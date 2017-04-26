<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectsResources
 *
 * @ORM\Table(name="projects_resources", indexes={@ORM\Index(name="fk_resources_user_id", columns={"user_id"}), @ORM\Index(name="fk_resources_project_id", columns={"project_id"})})
 * @ORM\Entity
 */
class ProjectsResources
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
 * @var \Projects
 *
 * @ORM\ManyToOne(targetEntity="Projects")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="project_id", referencedColumnName="id", nullable=true)
 * })
 */
private $project;

/**
	 * @ORM\ManyToOne(targetEntity="Users", inversedBy="projects_resources")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
	 */
protected $user;


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
 * @return ProjectsResources
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
 * @return ProjectsResources
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
 * @return ProjectsResources
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
 * @return ProjectsResources
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
 * Set project
 *
 * @param \Projects $project
 *
 * @return ProjectsResources
 */
public function setProject(\Projects $project = null)
{
$this->project = $project;

return $this;
}

/**
 * Get project
 *
 * @return \Projects
 */
public function getProject()
{
return $this->project;
}

/**
 * Set user
 *
 * @param \Users $user
 *
 * @return ProjectsResources
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

