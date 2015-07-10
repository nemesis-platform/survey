<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 22.05.2015
 * Time: 14:12
 */

namespace ScayTrase\SurveyBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

class Survey
{
    /** @var  int|null */
    private $id;
    /** @var null|string */
    private $alias;
    /** @var  SurveyQuestion[]|ArrayCollection */
    private $questions;
    /** @var  bool */
    private $public = false;
    /** @var  bool */
    private $editAllowed = true;
    /** @var  UserInterface */
    private $owner;
    /** @var  bool */
    private $locked = false;
    /** @var  SurveyResult[]|ArrayCollection */
    private $results;
    /** @var  string */
    private $title;

    /**
     * Survey constructor.
     */
    public function __construct()
    {
        $this->alias     = substr(sha1(uniqid()), 0, 6);
        $this->questions = new ArrayCollection();
        $this->results   = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return ArrayCollection|SurveyResult[]
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @return boolean
     */
    public function isLocked()
    {
        return $this->locked;
    }

    /**
     * @param boolean $locked
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;
    }

    /**
     * @return boolean True if survey answer can be modified by the author. If false, new answer is send instead
     *                 Edit is not allowed for public surveys
     */
    public function isEditAllowed()
    {
        return $this->isPublic() ? false : $this->editAllowed;
    }

    /**
     * @param boolean $editAllowed
     */
    public function setEditAllowed($editAllowed)
    {
        $this->editAllowed = $editAllowed;
    }

    /**
     * @return boolean
     */
    public function isPublic()
    {
        return $this->public;
    }

    /**
     * @param boolean $public
     */
    public function setPublic($public)
    {
        $this->public = $public;
    }

    /**
     * @return UserInterface
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param UserInterface $owner
     */
    public function setOwner(UserInterface $owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param null|string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return ArrayCollection|SurveyQuestion[]
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    public function addQuestion(SurveyQuestion $question)
    {
        if (!$this->questions->contains($question)) {
            $this->questions->set($question->getField()->getName(), $question);
            $question->setSurvey($this);
        }
    }

    public function removeQuestion(SurveyQuestion $question)
    {
        if ($this->questions->contains($question)) {
            $this->questions->remove($question);
            $question->setSurvey(null);
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->title;
    }
}
