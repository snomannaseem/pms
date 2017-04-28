<?php

namespace DoctrineProxies\__CG__\App\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Comments extends \App\Entities\Comments implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'id', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'typeId', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'detail', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'isDeleted', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'createdBy', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'createdOn', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'updatedBy', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'updatedOn', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'deletedBy', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'deletedOn', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'issue'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'id', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'typeId', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'detail', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'isDeleted', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'createdBy', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'createdOn', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'updatedBy', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'updatedOn', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'deletedBy', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'deletedOn', '' . "\0" . 'App\\Entities\\Comments' . "\0" . 'issue'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Comments $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setTypeId($typeId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTypeId', [$typeId]);

        return parent::setTypeId($typeId);
    }

    /**
     * {@inheritDoc}
     */
    public function getTypeId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTypeId', []);

        return parent::getTypeId();
    }

    /**
     * {@inheritDoc}
     */
    public function setDetail($detail)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDetail', [$detail]);

        return parent::setDetail($detail);
    }

    /**
     * {@inheritDoc}
     */
    public function getDetail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDetail', []);

        return parent::getDetail();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsDeleted($isDeleted)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsDeleted', [$isDeleted]);

        return parent::setIsDeleted($isDeleted);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsDeleted()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsDeleted', []);

        return parent::getIsDeleted();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedBy($createdBy)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedBy', [$createdBy]);

        return parent::setCreatedBy($createdBy);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedBy()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedBy', []);

        return parent::getCreatedBy();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedOn($createdOn)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedOn', [$createdOn]);

        return parent::setCreatedOn($createdOn);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedOn()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedOn', []);

        return parent::getCreatedOn();
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedBy($updatedBy)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdatedBy', [$updatedBy]);

        return parent::setUpdatedBy($updatedBy);
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedBy()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdatedBy', []);

        return parent::getUpdatedBy();
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedOn($updatedOn)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdatedOn', [$updatedOn]);

        return parent::setUpdatedOn($updatedOn);
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedOn()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdatedOn', []);

        return parent::getUpdatedOn();
    }

    /**
     * {@inheritDoc}
     */
    public function setDeletedBy($deletedBy)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDeletedBy', [$deletedBy]);

        return parent::setDeletedBy($deletedBy);
    }

    /**
     * {@inheritDoc}
     */
    public function getDeletedBy()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDeletedBy', []);

        return parent::getDeletedBy();
    }

    /**
     * {@inheritDoc}
     */
    public function setDeletedOn($deletedOn)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDeletedOn', [$deletedOn]);

        return parent::setDeletedOn($deletedOn);
    }

    /**
     * {@inheritDoc}
     */
    public function getDeletedOn()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDeletedOn', []);

        return parent::getDeletedOn();
    }

    /**
     * {@inheritDoc}
     */
    public function setIssue(\App\Entities\Issues $issue = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIssue', [$issue]);

        return parent::setIssue($issue);
    }

    /**
     * {@inheritDoc}
     */
    public function getIssue()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIssue', []);

        return parent::getIssue();
    }

}
