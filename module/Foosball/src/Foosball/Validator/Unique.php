<?php

namespace Foosball\Validator;

use Zend\Validator\AbstractValidator;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class Unique extends AbstractValidator
    implements ServiceLocatorAwareInterface
{
    /**
     * Service Locator class
     * @var \Zend\ServiceManager\ServiceManagerInterface
     */
    protected $sm;

    const UNIQUE = 'unique';
    const MISSING_FIELD = 'missing_field';
    const MISSING_TABLE = 'missing_table';

    protected $messageTemplates = array(
        self::UNIQUE => "This %field% is not unique",
        self::MISSING_FIELD => "Please set field option",
        self::MISSING_TABLE => "Please set table option",
    );

    protected $messageVariables = array(
        'field' => array('options' => 'field'),
    );

    protected $options = array(
        'id'    => null, //null field means we don't check the db
        'field' => null, //the field we are checking on in the db
        'table' => null, //the table we are checking on in the db
    );

    /**
     * Sets validator options
     *
     * @param  integer|array|\Traversable $options
     */
    public function __construct($options = array())
    {
        if (!is_array($options)) {
            $options     = func_get_args();
            $temp['field'] = array_shift($options);
            if (!empty($options)) {
                $temp['table'] = array_shift($options);
            }

            if (!empty($options)) {
                $temp['id'] = array_shift($options);
            }

            $options = $temp;
        }

        parent::__construct($options);
    }

    public function getId()
    {
        return $this->options['id'];
    }

    public function getField()
    {
        return $this->options['field'];
    }

    public function getTable()
    {
        return $this->options['table'];
    }

    public function isValid($value)
    {
        $id    = $this->getId();
        $field = $this->getField();
        $table = $this->getTable();

        $this->setValue($value);

        // make sure we have all our required fields
        if ($field === null) {
            $this->error(self::MISSING_FIELD);
            return false;
        }

        if ($table === null) {
            $this->error(self::MISSING_TABLE);
            return false;
        }

        $sm = $this->getServiceManager();
        // var_dump($sm);
        $db = $sm->get('Zend\Db\Adapter\Adapter');

        exit;
    }

    /**
     * Set service manager instance
     *
     * @param  ServiceManager $serviceManager
     * @return void
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceManager)
    {
        var_dump($serviceManager);exit;
        $this->sm = $serviceManager;
    }

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceLocator()
    {
        return $this->sm;
    }
}
