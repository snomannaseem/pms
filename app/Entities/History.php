<?php

namespace App\Entities;

/**
 * History
 */
class History
{
/**
 * @var integer
 */
private $id;

/**
 * @var string
 */
private $comment;

/**
 * @var integer
 */
private $createdBy;

/**
 * @var \DateTime
 */
private $createdOn;

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
 * Set comment
 *
 * @param string $comment
 *
 * @return History
 */
public function setComment($comment)
{
$this->comment = $comment;

return $this;
}

/**
 * Get comment
 *
 * @return string
 */
public function getComment()
{
return $this->comment;
}

/**
 * Set createdBy
 *
 * @param integer $createdBy
 *
 * @return History
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
 * @return History
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
 * Set issue
 *
 * @param \Issues $issue
 *
 * @return History
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

