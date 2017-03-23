<?php



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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Projects
     *
     * @ORM\ManyToOne(targetEntity="Projects")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     * })
     */
    private $project;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;


}

