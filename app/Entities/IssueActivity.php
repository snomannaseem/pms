<?php
namespace App\Entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * IssueActivity
 *
 * @ORM\Table(name="issue_activity")
 * @ORM\Entity
 */
class IssueActivity
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
 * @ORM\Column(name="issue_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
 */
private $issueId;

/**
 * @var integer
 *
 * @ORM\Column(name="user_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
 */
private $userId;

/**
 * @var \DateTime
 *
 * @ORM\Column(name="start_time", type="datetime", precision=0, scale=0, nullable=false, unique=false)
 */
private $startTime;

/**
 * @var \DateTime
 *
 * @ORM\Column(name="stop_time", type="datetime", precision=0, scale=0, nullable=true, unique=false)
 */
private $stopTime;

/**
 * @var integer
 *
 * @ORM\Column(name="seconds_elapsed", type="integer", precision=0, scale=0, nullable=false, unique=false)
 */
private $secondsElapsed;


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
 * Set issueId
 *
 * @param integer $issueId
 *
 * @return IssueActivity
 */
public function setIssueId($issueId)
{
$this->issueId = $issueId;

return $this;
}

/**
 * Get issueId
 *
 * @return integer
 */
public function getIssueId()
{
return $this->issueId;
}

/**
 * Set userId
 *
 * @param integer $userId
 *
 * @return IssueActivity
 */
public function setUserId($userId)
{
$this->userId = $userId;

return $this;
}

/**
 * Get userId
 *
 * @return integer
 */
public function getUserId()
{
return $this->userId;
}

/**
 * Set startTime
 *
 * @param \DateTime $startTime
 *
 * @return IssueActivity
 */
public function setStartTime($startTime)
{
$this->startTime = $startTime;

return $this;
}

/**
 * Get startTime
 *
 * @return \DateTime
 */
public function getStartTime()
{
return $this->startTime;
}

/**
 * Set stopTime
 *
 * @param \DateTime $stopTime
 *
 * @return IssueActivity
 */
public function setStopTime($stopTime)
{
$this->stopTime = $stopTime;

return $this;
}

/**
 * Get stopTime
 *
 * @return \DateTime
 */
public function getStopTime()
{
return $this->stopTime;
}

/**
 * Set secondsElapsed
 *
 * @param integer $secondsElapsed
 *
 * @return IssueActivity
 */
public function setSecondsElapsed($secondsElapsed)
{
$this->secondsElapsed = $secondsElapsed;

return $this;
}

/**
 * Get secondsElapsed
 *
 * @return integer
 */
public function getSecondsElapsed()
{
return $this->secondsElapsed;
}
}

