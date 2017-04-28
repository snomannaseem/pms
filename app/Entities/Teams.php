<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Teams
 *
 * @ORM\Table(name="teams")
 * @ORM\Entity
 */
class Teams
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
 * @ORM\Column(name="name", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
 */
private $name;

/**
 * @var string
 *
 * @ORM\Column(name="status", type="string", length=10, precision=0, scale=0, nullable=true, unique=false)
 */
private $status;

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
 * @ORM\OneToMany(targetEntity="TeamResources", mappedBy="team")
 * @ORM\JoinColumn(name="id", referencedColumnName="team_id", nullable=false)
	 */
protected $team_resources;


/**
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
public function getTeamResources()
{
	return $this->team_resources;
}

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
 * Set name
 *
 * @param string $name
 *
 * @return Teams
 */
public function setName($name)
{
$this->name = $name;

return $this;
}

/**
 * Get name
 *
 * @return string
 */
public function getName()
{
return $this->name;
}

/**
 * Set status
 *
 * @param string $status
 *
 * @return Teams
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
 * @return Teams
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
 * @return Teams
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
 * @return Teams
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
 * @return Teams
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
 * Set deletedBy
 *
 * @param integer $deletedBy
 *
 * @return Teams
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
 * @return Teams
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
}

