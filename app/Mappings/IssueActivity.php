<?php



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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="issue_id", type="integer", nullable=false)
     */
    private $issueId;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_time", type="datetime", nullable=false)
     */
    private $startTime = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="stop_time", type="datetime", nullable=true)
     */
    private $stopTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="seconds_elapsed", type="integer", nullable=false)
     */
    private $secondsElapsed;


}

