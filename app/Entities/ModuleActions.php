<?php


namespace App\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * ModuleActions
 *
 * @ORM\Table(name="module_actions", indexes={@ORM\Index(name="idx_module_permissions_module_id", columns={"module_id"}), @ORM\Index(name="idx_module_permissions_action_id", columns={"action_id"})})
 * @ORM\Entity
 */
class ModuleActions
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
 * @ORM\Column(name="url", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
 */
private $url;

/**
 * @var string
 *
 * @ORM\Column(name="description", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
 */
private $description;

/**
 * @var \Actions
 *
 * @ORM\ManyToOne(targetEntity="Actions")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="action_id", referencedColumnName="id", nullable=true)
 * })
 */
private $action;

/**
 * @var \Modules
 *
 * @ORM\ManyToOne(targetEntity="Modules")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="module_id", referencedColumnName="id", nullable=true)
 * })
 */
private $module;


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
 * Set url
 *
 * @param string $url
 *
 * @return ModuleActions
 */
public function setUrl($url)
{
$this->url = $url;

return $this;
}

/**
 * Get url
 *
 * @return string
 */
public function getUrl()
{
return $this->url;
}

/**
 * Set description
 *
 * @param string $description
 *
 * @return ModuleActions
 */
public function setDescription($description)
{
$this->description = $description;

return $this;
}

/**
 * Get description
 *
 * @return string
 */
public function getDescription()
{
return $this->description;
}

/**
 * Set action
 *
 * @param \Actions $action
 *
 * @return ModuleActions
 */
public function setAction(Actions $action = null)
{
$this->action = $action;

return $this;
}

/**
 * Get action
 *
 * @return \Actions
 */
public function getAction()
{
return $this->action;
}

/**
 * Set module
 *
 * @param \Modules $module
 *
 * @return ModuleActions
 */
public function setModule(\Modules $module = null)
{
$this->module = $module;

return $this;
}

/**
 * Get module
 *
 * @return \Modules
 */
public function getModule()
{
return $this->module;
}
}

