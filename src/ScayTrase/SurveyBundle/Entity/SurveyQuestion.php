<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 10.06.2015
 * Time: 14:00
 */

namespace ScayTrase\SurveyBundle\Entity;

use ScayTrase\StoredFormsBundle\Entity\Field\AbstractField;

class SurveyQuestion
{
    /** @var  int|null */
    private $id;
    /** @var int */
    private $weight = 0;
    /** @var  AbstractField */
    private $field;
    /** @var  Survey */
    private $survey;

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
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return sprintf('#%d %s', $this->weight, $this->field->getType());
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return AbstractField
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param AbstractField $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }
}
