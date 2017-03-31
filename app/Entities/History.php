<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * History
 *
 * @ORM\Table(name="history", indexes={@ORM\Index(name="fk_history_issue", columns={"issue_id"})})
 * @ORM\Entity
 */
class History
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
 * @ORM\Column(name="comment", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
 */
private $comment;

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

