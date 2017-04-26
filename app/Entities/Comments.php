<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comments
 *
 * @ORM\Table(name="comments", indexes={@ORM\Index(name="fk_issue_comments", columns={"issue_id"})})
 * @ORM\Entity
 */
class Comments
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
 * @ORM\Column(name="type_id", type="integer", precision=0, scale=0, nullable=true, unique=false)
 */
private $typeId;

/**
 * @var string
 *
 * @ORM\Column(name="detail", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
 */
private $detail;

/**
 * @var boolean
 *
 * @ORM\Column(name="is_deleted", type="boolean", precision=0, scale=0, nullable=true, unique=false)
 */
private $isDeleted;

/**
 * @var integer
 *
 * @ORM\Column(name="created_by", type="integer", precision=0, scale=0, nullable=true, unique=false)
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
 * @var \Issues
 *
 * @ORM\ManyToOne(targetEntity="Issues")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="issue_id", referencedColumnName="id", nullable=true)
 * })
 */
private $issue;


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
 * Set typeId
 *
 * @param integer $typeId
 *
 * @return Comments
 */
public function setTypeId($typeId)
{
$this->typeId = $typeId;

return $this;
}

/**
 * Get typeId
 *
 * @return integer
 */
public function getTypeId()
{
return $this->typeId;
}

/**
 * Set detail
 *
 * @param string $detail
 *
 * @return Comments
 */
public function setDetail($detail)
{
$this->detail = $detail;

return $this;
}

/**
 * Get detail
 *
 * @return string
 */
public function getDetail()
{
return $this->detail;
}

/**
 * Set isDeleted
 *
 * @param boolean $isDeleted
 *
 * @return Comments
 */
public function setIsDeleted($isDeleted)
{
$this->isDeleted = $isDeleted;

return $this;
}

/**
 * Get isDeleted
 *
 * @return boolean
 */
public function getIsDeleted()
{
return $this->isDeleted;
}

/**
 * Set createdBy
 *
 * @param integer $createdBy
 *
 * @return Comments
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
 * @return Comments
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
 * @return Comments
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
 * @return Comments
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
 * @return Comments
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
 * @return Comments
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
 * Set issue
 *
 * @param \Issues $issue
 *
 * @return Comments
 */
public function setIssue(Issues $issue = null)
{
$this->issue = $issue;

return $this;
}

/**
 * Get issue
 *
 * @return \Issues
 */
public function getIssue()
{
return $this->issue;
}
}

