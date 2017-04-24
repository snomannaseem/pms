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
 * @var \Projects
 *
 * @ORM\ManyToOne(targetEntity="Projects")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="project_id", referencedColumnName="id", nullable=true)
 * })
 */
private $project;

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

