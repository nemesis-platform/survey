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

class SurveyResult
{
    /** @var  int|null */
    private $id;
    /** @var  Survey */
    private $survey;
    /** @var  SurveyAnswer[]|ArrayCollection */
    private $answers;
    /** @var  UserInterface|null */
    private $author;
    /** @var  \DateTime */
    private $timeCreated;
    /** @var  \DateTime */
    private $timeUpdated;

    /**
     * SurveyResult constructor.
     */
    public function __construct()
    {
        $this->timeCreated = new \DateTime();
        $this->timeUpdated = new \DateTime();
        $this->answers     = new ArrayCollection();
    }

    /**
     * @return \DateTime
     */
    public function getTimeUpdated()
    {
        return $this->timeUpdated;
    }

    /**
     * @param \DateTime $timeUpdated
     */
    public function setTimeUpdated(\DateTime $timeUpdated)
    {
        $this->timeUpdated = $timeUpdated;
    }

    /**
     * @return \DateTime
     */
    public function getTimeCreated()
    {
        return $this->timeCreated;
    }

    /**
     * @param \DateTime $timeCreated
     */
    public function setTimeCreated(\DateTime $timeCreated)
    {
        $this->timeCreated = $timeCreated;
    }

    /**
     * @return UserInterface|null
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param UserInterface|null $author
     */
    public function setAuthor(UserInterface $author = null)
    {
        $this->author = $author;
    }

    /**
     * @return Survey
     */
    public function getSurvey()
    {
        return $this->survey;
    }

    /**
     * @param Survey $survey
     */
    public function setSurvey($survey)
    {
        $this->survey = $survey;
    }

    /**
     * @return ArrayCollection|SurveyAnswer[]
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    public function addAnswer(SurveyAnswer $answer)
    {


        if ($this->survey->getQuestions()->filter(
            function (SurveyQuestion $question) use ($answer) {
                return $question->getField() === $answer->getValue()->getField();
            }
        )->isEmpty()
        ) {
            return;
        }

        foreach ($this->answers as $storedAnswer) {
            if ($storedAnswer->getValue()->getField() === $answer->getValue()->getField()) {
                $this->answers->removeElement($storedAnswer);
            }
        }

        $this->answers->add($answer);
        $answer->setParent($this);
    }

    public function removeAnswer(SurveyAnswer $answer)
    {
        if ($answer->getParent() === $this) {
            $this->answers->removeElement($answer);
            $answer->setParent(null);
        }
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    public function sanitize()
    {
        foreach ($this->answers as $value) {
            if ($this->survey->getQuestions()->filter(
                function (SurveyQuestion $question) use ($value) {
                    return $question->getField() === $value->getValue()->getField();
                }
            )->isEmpty()
            ) {
                $this->answers->removeElement($value);
            }
        }
    }
}
