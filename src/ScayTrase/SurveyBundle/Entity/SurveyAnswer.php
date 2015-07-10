<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 22.05.2015
 * Time: 14:23
 */

namespace ScayTrase\SurveyBundle\Entity;

use ScayTrase\StoredFormsBundle\Entity\Value\AbstractValue;

class SurveyAnswer
{
    /** @var  AbstractValue */
    private $value;
    /** @var  SurveyResult */
    private $parent;

    /**
     * SurveyAnswer constructor.
     *
     * @param AbstractValue $value
     */
    public function __construct(AbstractValue $value)
    {
        $this->value = $value;
    }

    /**
     * @return AbstractValue
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param AbstractValue $value
     */
    public function setValue(AbstractValue $value)
    {
        $this->value = $value;
    }

    /**
     * @return SurveyResult
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param SurveyResult $parent
     */
    public function setParent(SurveyResult $parent)
    {
        $this->parent = $parent;
    }
}
