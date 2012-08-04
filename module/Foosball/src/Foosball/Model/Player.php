<?php

namespace Foosball\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Form\Annotation;

/**
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Annotation\Name("player")
 */
class Player /*implements InputFilterAwareInterface*/
{
    public $id;

    /**
     * @Annotation\Attributes({"type":"text" })
     * @Annotation\Validator({"name":"firstname","type":"Regex","options":{"regex":"/^[a-zA-Z][a-zA-Z0-9_-]{1,255}/"}})
     * @Annotation\Options({"label":"Firstname:"})
     */
    public $firstname;

    /**
     * @Annotation\Attributes({"type":"text" })
     * @Annotation\Validator({"name":"lastname","type":"Regex","options":{"regex":"/^[a-zA-Z][a-zA-Z0-9_-]{1,255}/"}})
     * @Annotation\Options({"label":"Lastname:"})
     */
    public $lastname;
    public $email;

    /**
     * @Annotation\Attributes({"type":"text" })
     * @Annotation\Validator({"name":"points","type":"Regex","options":{"regex":"/^[0-9]{1,4}/"}})
     * @Annotation\Options({"label":"Username:"})
     */
    public $points;

    protected $inputFilter;

    /**
     * Used by ResultSet to pass each database row to the entity
     */
    public function exchangeArray($data)
    {
        foreach ($data as $key => $var) {
            $key = str_replace('p_', '', $key);
            if (property_exists($this, $key)) {
                $this->{$key} = $var;
            }
        }
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
/*
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'artist',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'title',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }*/
}

