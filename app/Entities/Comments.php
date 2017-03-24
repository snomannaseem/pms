<?php

namespace App\Entities;

/**
 * Comments
 */
class Comments
{
/**
 * @var integer
 */
private $id;

/**
 * @var integer
 */
private $typeId;

/**
 * @var string
 */
private $detail;

/**
 * @var boolean
 */
private $isDeleted;

/**
 * @var integer
 */
private $createdBy;

/**
 * @var \DateTime
 */
private $createdOn;

/**
 * @var integer
 */
private $updatedBy;

/**
 * @var \DateTime
 */
private $updatedOn;

/**
 * @var \Issues
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
 * Set issue
 *
 * @param \Issues $issue
 *
 * @return Comments
 */
public function setIssue(\Issues $issue = null)
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
 * Set issue
 *
 * @param \Issues $issue
 *
 * @return Comments
 */
public function setIssue(\Issues $issue = null)
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
