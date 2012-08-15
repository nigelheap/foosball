<?php

namespace Foosball\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Player implements InputFilterAwareInterface
{
    public $id;

    public $firstname;

    public $lastname;
    public $email;


    public $points;

    public $password;

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
                'name'     => 'firstname',
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
                'name'     => 'lastname',
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
                'name'     => 'email',
                'required' => 'true',
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'EmailAddress',
                    ),
                    array(
                        'name' => 'Foosball\Validator\Unique',
                        'options' => array(
                            'field' => 'p_email',
                            'id'    => $this->id,
                            'table' => 'fb_player',
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'      => 'password',
                'required'  => 'true',
                'filters'   => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                array('name' => 'Foosball\Validator\PasswordStrength'),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'password_confirm',
                'required' => 'true',
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'Identical',
                        'options' => 
                        array('token' => 'password'),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'      => 'points',
                'required' => 'true',
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'Int',
                    ),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}

