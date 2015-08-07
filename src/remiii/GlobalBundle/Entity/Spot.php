<?php

namespace remiii\GlobalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Spot
 *
 * @ORM\Table(name="spot")
 * @ORM\Entity(repositoryClass="remiii\GlobalBundle\Repository\SpotRepository")
 */
class Spot
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
     * @ORM\Column(name="last_modified", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     * @Assert\DateTime()
     */
    private $lastModified;

    /**
     * @var string
     *
     * @ORM\Column(name="input", type="string", length=255, nullable=true)
     */
    private $input;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_modified_input", type="datetime", nullable=true)
     */
    private $lastModifiedInput;

    /**
     * @var string
     *
     * @ORM\Column(name="sport_input", type="string", length=255, nullable=true)
     */
    private $sportInput;

    /**
     * @var string
     *
     * @ORM\Column(name="url_input", type="string", length=255, nullable=true)
     */
    private $urlInput;

    /**
     * @var float
     *
     * @ORM\Column(name="x", type="float")
     */
    private $x;

    /**
     * @var float
     *
     * @ORM\Column(name="y", type="float")
     */
    private $y;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
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
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

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
     * @ORM\Column(name="condititon_extra", type="text", nullable=true)
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
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255, nullable=true)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="county", type="string", length=255, nullable=true)
     */
    private $county;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="locale", type="string", length=255, nullable=true)
     */
    private $locale;

    ///**
    // * @ORM\OneToMany(targetEntity="SpotPhoto", mappedBy="spot", cascade={"persist", "remove"})
    // */
    //protected $spotPhotos;

    /**
     * @ORM\OneToMany(targetEntity="SpotWebcam", mappedBy="spot", cascade={"persist", "remove"})
     */
    protected $spotWebcams;

    public function __construct()
    {
        //$this->spotPhotos = new ArrayCollection();
        $this->spotWebcams = new ArrayCollection();
    }

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
     * Set sport
     *
     * @param array $sport
     * @return Spot
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
     * Set sportExtra
     *
     * @param string $sportExtra
     * @return Spot
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
     * Set wind
     *
     * @param array $wind
     * @return Spot
     */
    public function setWind($wind)
    {
        $this->wind = $wind;

        return $this;
    }

    /**
     * Get wind
     *
     * @return array
     */
    public function getWind()
    {
        return $this->wind;
    }

    /**
     * Set windExtra
     *
     * @param string $windExtra
     * @return Spot
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
     * Set tide
     *
     * @param array $tide
     * @return Spot
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
     * Set tideExtra
     *
     * @param string $tideExtra
     * @return Spot
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
     * Set condition
     *
     * @param array $condition
     * @return Spot
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
     * Set conditionExtra
     *
     * @param string $conditionExtra
     * @return Spot
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
     * Set hazard
     *
     * @param array $hazard
     * @return Spot
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
     * Set hazardExtra
     *
     * @param string $hazardExtra
     * @return Spot
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
     * Set rule
     *
     * @param array $rule
     * @return Spot
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
     * Set ruleExtra
     *
     * @param string $ruleExtra
     * @return Spot
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
     * Set surface
     *
     * @param array $surface
     * @return Spot
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
     * Set surfaceExtra
     *
     * @param string $surfaceExtra
     * @return Spot
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
     * Add spotWebcams
     *
     * @param \remiii\GlobalBundle\Entity\SpotWebcam $spotWebcams
     * @return Spot
     */
    public function addSpotWebcam(\remiii\GlobalBundle\Entity\SpotWebcam $spotWebcams)
    {
        $this->spotWebcams[] = $spotWebcams;

        return $this;
    }

    /**
     * Remove spotWebcams
     *
     * @param \remiii\GlobalBundle\Entity\SpotWebcam $spotWebcams
     */
    public function removeSpotWebcam(\remiii\GlobalBundle\Entity\SpotWebcam $spotWebcams)
    {
        $this->spotWebcams->removeElement($spotWebcams);
    }

    /**
     * Get spotWebcams
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpotWebcams()
    {
        return $this->spotWebcams;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Spot
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Spot
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set county
     *
     * @param string $county
     * @return Spot
     */
    public function setCounty($county)
    {
        $this->county = $county;

        return $this;
    }

    /**
     * Get county
     *
     * @return string 
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Spot
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set locale
     *
     * @param string $locale
     * @return Spot
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string 
     */
    public function getLocale()
    {
        return $this->locale;
    }
}
