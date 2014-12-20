<?php

namespace remiii\GlobalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Spot
 *
 * @ORM\Table(name="spot_proposal")
 * @ORM\Entity(repositoryClass="remiii\GlobalBundle\Repository\SpotProposalRepository")
 */
class SpotProposal
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     * @Gedmo\Timestampable(on="create")
     * @Assert\DateTime()
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_modified", type="datetime")
     * @Gedmo\Timestampable(on="update")
     * @Assert\DateTime()
     */
    private $lastModified;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var float
     *
     * @ORM\Column(name="x", type="float")
     * @Assert\NotBlank()
     */
    private $x;

    /**
     * @var float
     *
     * @ORM\Column(name="y", type="float")
     * @Assert\NotBlank()
     */
    private $y;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Ip()
     */
    private $ip;

    /**
     * @var array
     *
     * @ORM\Column(name="sport", type="array", nullable=true)
     */
    private $sport;

    /**
     * @var string
     *
     * @ORM\Column(name="sport_extra", type="text", nullable=true)
     */
    private $sportExtra;

    /**
     * @var array
     *
     * @ORM\Column(name="wind", type="array", nullable=true)
     */
    private $wind;

    /**
     * @var string
     *
     * @ORM\Column(name="wind_extra", type="text", nullable=true)
     */
    private $windExtra;

    /**
     * @var array
     *
     * @ORM\Column(name="tide", type="array", nullable=true)
     */
    private $tide;

    /**
     * @var string
     *
     * @ORM\Column(name="tide_extra", type="text", nullable=true)
     */
    private $tideExtra;

    /**
     * @var array
     *
     * @ORM\Column(name="condition_", type="array", nullable=true)
     */
    private $condition;

    /**
     * @var string
     *
     * @ORM\Column(name="condition_extra", type="text", nullable=true)
     */
    private $conditionExtra;

    /**
     * @var array
     *
     * @ORM\Column(name="hazard", type="array", nullable=true)
     */
    private $hazard;

    /**
     * @var string
     *
     * @ORM\Column(name="hazard_extra", type="text", nullable=true)
     */
    private $hazardExtra;

    /**
     * @var array
     *
     * @ORM\Column(name="rule", type="array", nullable=true)
     */
    private $rule;

    /**
     * @var string
     *
     * @ORM\Column(name="rule_extra", type="text", nullable=true)
     */
    private $ruleExtra;

    /**
     * @var array
     *
     * @ORM\Column(name="surface", type="array", nullable=true)
     */
    private $surface;

    /**
     * @var string
     *
     * @ORM\Column(name="surface_extra", type="text", nullable=true)
     */
    private $surfaceExtra;

    /**
     * @var string
     *
     * @ORM\Column(name="marks", type="text", nullable=true)
     */
    private $marks;

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
     * Set created
     *
     * @param \DateTime $created
     * @return spot
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set lastModified
     *
     * @param \DateTime $lastModified
     * @return spot
     */
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * Get lastModified
     *
     * @return \DateTime
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * Set input
     *
     * @param string $input
     * @return spot
     */
    public function setInput($input)
    {
        $this->input = $input;

        return $this;
    }

    /**
     * Get input
     *
     * @return string
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * Set lastModifiedInput
     *
     * @param \DateTime $lastModifiedInput
     * @return spot
     */
    public function setLastModifiedInput($lastModifiedInput)
    {
        $this->lastModifiedInput = $lastModifiedInput;

        return $this;
    }

    /**
     * Get lastModifiedInput
     *
     * @return \DateTime
     */
    public function getLastModifiedInput()
    {
        return $this->lastModifiedInput;
    }

    /**
     * Set x
     *
     * @param float $x
     * @return spot
     */
    public function setX($x)
    {
        $this->x = $x;

        return $this;
    }

    /**
     * Get x
     *
     * @return float
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set y
     *
     * @param float $y
     * @return spot
     */
    public function setY($y)
    {
        $this->y = $y;

        return $this;
    }

    /**
     * Get y
     *
     * @return float
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return spot
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return spot
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
     * Set url
     *
     * @param string $url
     * @return spot
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
     * Set urlInput
     *
     * @param string $urlInput
     * @return Spot
     */
    public function setUrlInput($urlInput)
    {
        $this->urlInput = $urlInput;

        return $this;
    }

    /**
     * Get urlInput
     *
     * @return string
     */
    public function getUrlInput()
    {
        return $this->urlInput;
    }

    /**
     * Set sports
     *
     * @param string $sports
     * @return Spot
     */
    public function setSports($sports)
    {
        $this->sports = $sports;

        return $this;
    }

    /**
     * Get sports
     *
     * @return string
     */
    public function getSports()
    {
        return $this->sports;
    }

    /**
     * Set sportInput
     *
     * @param string $sportInput
     * @return Spot
     */
    public function setSportInput($sportInput)
    {
        $this->sportInput = $sportInput;

        return $this;
    }

    /**
     * Get sportInput
     *
     * @return string
     */
    public function getSportInput()
    {
        return $this->sportInput;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return SpotProposal
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set wind
     *
     * @param string $wind
     * @return SpotProposal
     */
    public function setWind($wind)
    {
        $this->wind = $wind;

        return $this;
    }

    /**
     * Get wind
     *
     * @return string
     */
    public function getWind()
    {
        return $this->wind;
    }

    /**
     * Set sport
     *
     * @param array $sport
     * @return SpotProposal
     */
    public function setSport($sport)
    {
        $this->sport = $sport;

        return $this;
    }

    /**
     * Get sport
     *
     * @return array
     */
    public function getSport()
    {
        return $this->sport;
    }

    /**
     * Set tide
     *
     * @param array $tide
     * @return SpotProposal
     */
    public function setTide($tide)
    {
        $this->tide = $tide;

        return $this;
    }

    /**
     * Get tide
     *
     * @return array
     */
    public function getTide()
    {
        return $this->tide;
    }

    /**
     * Set condition
     *
     * @param array $condition
     * @return SpotProposal
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * Get condition
     *
     * @return array
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * Set hazard
     *
     * @param array $hazard
     * @return SpotProposal
     */
    public function setHazard($hazard)
    {
        $this->hazard = $hazard;

        return $this;
    }

    /**
     * Get hazard
     *
     * @return array
     */
    public function getHazard()
    {
        return $this->hazard;
    }

    /**
     * Set rule
     *
     * @param array $rule
     * @return SpotProposal
     */
    public function setRule($rule)
    {
        $this->rule = $rule;

        return $this;
    }

    /**
     * Get rule
     *
     * @return array
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * Set surface
     *
     * @param array $surface
     * @return SpotProposal
     */
    public function setSurface($surface)
    {
        $this->surface = $surface;

        return $this;
    }

    /**
     * Get surface
     *
     * @return array
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * Set sportExtra
     *
     * @param string $sportExtra
     * @return SpotProposal
     */
    public function setSportExtra($sportExtra)
    {
        $this->sportExtra = $sportExtra;

        return $this;
    }

    /**
     * Get sportExtra
     *
     * @return string
     */
    public function getSportExtra()
    {
        return $this->sportExtra;
    }

    /**
     * Set windExtra
     *
     * @param string $windExtra
     * @return SpotProposal
     */
    public function setWindExtra($windExtra)
    {
        $this->windExtra = $windExtra;

        return $this;
    }

    /**
     * Get windExtra
     *
     * @return string
     */
    public function getWindExtra()
    {
        return $this->windExtra;
    }

    /**
     * Set tideExtra
     *
     * @param string $tideExtra
     * @return SpotProposal
     */
    public function setTideExtra($tideExtra)
    {
        $this->tideExtra = $tideExtra;

        return $this;
    }

    /**
     * Get tideExtra
     *
     * @return string
     */
    public function getTideExtra()
    {
        return $this->tideExtra;
    }

    /**
     * Set conditionExtra
     *
     * @param string $conditionExtra
     * @return SpotProposal
     */
    public function setConditionExtra($conditionExtra)
    {
        $this->conditionExtra = $conditionExtra;

        return $this;
    }

    /**
     * Get conditionExtra
     *
     * @return string
     */
    public function getConditionExtra()
    {
        return $this->conditionExtra;
    }

    /**
     * Set hazardExtra
     *
     * @param string $hazardExtra
     * @return SpotProposal
     */
    public function setHazardExtra($hazardExtra)
    {
        $this->hazardExtra = $hazardExtra;

        return $this;
    }

    /**
     * Get hazardExtra
     *
     * @return string
     */
    public function getHazardExtra()
    {
        return $this->hazardExtra;
    }

    /**
     * Set ruleExtra
     *
     * @param string $ruleExtra
     * @return SpotProposal
     */
    public function setRuleExtra($ruleExtra)
    {
        $this->ruleExtra = $ruleExtra;

        return $this;
    }

    /**
     * Get ruleExtra
     *
     * @return string
     */
    public function getRuleExtra()
    {
        return $this->ruleExtra;
    }

    /**
     * Set surfaceExtra
     *
     * @param string $surfaceExtra
     * @return SpotProposal
     */
    public function setSurfaceExtra($surfaceExtra)
    {
        $this->surfaceExtra = $surfaceExtra;

        return $this;
    }

    /**
     * Get surfaceExtra
     *
     * @return string
     */
    public function getSurfaceExtra()
    {
        return $this->surfaceExtra;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return SpotProposal
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set marks
     *
     * @param string $marks
     * @return SpotProposal
     */
    public function setMarks($marks)
    {
        $this->marks = $marks;

        return $this;
    }

    /**
     * Get marks
     *
     * @return string
     */
    public function getMarks()
    {
        return $this->marks;
    }
}
