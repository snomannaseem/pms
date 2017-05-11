<?php



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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var \Actions
     *
     * @ORM\ManyToOne(targetEntity="Actions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="action_id", referencedColumnName="id")
     * })
     */
    private $action;

    /**
     * @var \Modules
     *
     * @ORM\ManyToOne(targetEntity="Modules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     * })
     */
    private $module;


}

