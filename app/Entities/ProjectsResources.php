<?php

namespace App\Entities;

/**
 * ProjectsResources
 */
class ProjectsResources
{
/**
 * @var integer
 */
private $id;

/**
 * @var \Projects
 */
private $project;

/**
 * @var \Users
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

