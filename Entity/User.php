<?php

namespace Egzakt\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\ExecutionContext;
use Symfony\Component\Security\Core\User\UserInterface;

use Egzakt\SystemBundle\Lib\BaseEntity;

/**
 * User
 */
class User extends BaseEntity implements UserInterface, \Serializable
{
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var string $username
     */
    protected $username;

    /**
     * @var string $password
     */
    protected $password;

    /**
     * @var string $firstname
     */
    protected $firstname;

    /**
     * @var string $lastname
     */
    protected $lastname;

    /**
     * @var string $email
     */
    protected $email;

    /**
     * @var string $facebookId
     */
    protected $facebookId;

    /**
     * @var boolean $active
     */
    protected $active;

    /**
     * @var \DateTime $createdAt
     */
    protected $createdAt;

    /**
     * @var \DateTime $updatedAt
     */
    protected $updatedAt;

    /**
     * @var ArrayCollection
     */
    protected $userRoles;

    /**
     * @var string $salt
     */
    protected $salt;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->userRoles = new ArrayCollection();
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString() {
        if ($this->id) {
            return $this->firstname . ' ' . $this->lastname;
        }

        return 'New ' . $this->getEntityName();
    }

    /**
     * Set Id
     *
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
     * Set facebookId
     *
     * @param string $facebookId
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
    }

    /**
     * Get facebookId
     *
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * Set Facebook Data
     *
     * @param Array $fbdata
     */
    public function setFacebookData($fbdata)
    {
        if (isset($fbdata['id'])) {
            $this->setUsername($fbdata['id']);
            $this->setFacebookId($fbdata['id']);
        }

        if (isset($fbdata['first_name'])) {
            $this->setFirstname($fbdata['first_name']);
        }

        if (isset($fbdata['last_name'])) {
            $this->setLastname($fbdata['last_name']);
        }

        if (isset($fbdata['email'])) {
            $this->setEmail($fbdata['email']);
        }
    }

    /**
     * Set active
     *
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add userRoles
     *
     * @param Role $userRoles
     */
    public function addRole(Role $userRoles)
    {
        $this->userRoles[] = $userRoles;
    }

    /**
     * Set userRoles
     *
     * @param Role $userRoles
     */
    public function setUserRoles($userRoles)
    {
        $this->userRoles = $userRoles;
    }

    /**
     * Get userRoles
     *
     * @return ArrayCollection
     */
    public function getUserRoles()
    {
        return $this->userRoles;
    }

    /**
     * Is Password Valid
     *
     * Validate the password fields
     *
     * @param ExecutionContext $context The context
     */
    public function isPasswordValid(ExecutionContext $context)
    {
        if (!$this->getId() && !$this->getPassword()) {
            $propertyPath = $context->getPropertyPath() . '.password.Password';
            $context->setPropertyPath($propertyPath);
            $context->addViolation('This value should not be blank', array(), null);
        }
    }

    /**
     * Is Roles Valid
     *
     * @param ExecutionContext $context The context
     */
    public function isRolesValid(ExecutionContext $context)
    {
        if (!count($this->userRoles)) {
            $propertyPath = $context->getPropertyPath() . '.userroles';
            $context->setPropertyPath($propertyPath);
            $context->addViolation('This value should not be blank', array(), null);
        }
    }

    /**
     * Get Roles
     *
     * @return array
     */
    public function getRoles()
    {
        $roles = array();

        foreach($this->getUserRoles() as $role) {
            $roles[] = $role->getRoleName();
        }

        return $roles;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set salt
     *
     * @param $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * Erase Credentials
     */
    public function eraseCredentials()
    {
        $this->container->get('security.context')->setToken(null);
    }

    /**
     * Equals
     *
     * @param UserInterface $user A User
     *
     * @return bool
     */
    public function equals(UserInterface $user)
    {
        if (!$user instanceof User) {
            return false;
        }

        if ($this->getUsername() !== $user->getUsername()) {
            return false;
        }

        return true;
    }

    /**
     * Serializes the user.
     *
     * The serialized data have to contain the fields used byt the equals method.
     *
     * @return string
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->password,
            $this->username
        ));
    }

    /**
     * Unserializes the user.
     *
     * @param string $serialized The serialized string
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->password,
            $this->username
        ) = unserialize($serialized);
    }

    /**
     * Add userRoles
     *
     * @param \Egzakt\SystemBundle\Entity\Role $userRoles
     * @return User
     */
    public function addUserRole(\Egzakt\SystemBundle\Entity\Role $userRoles)
    {
        $this->userRoles[] = $userRoles;
    
        return $this;
    }

    /**
     * Remove userRoles
     *
     * @param \Egzakt\SystemBundle\Entity\Role $userRoles
     */
    public function removeUserRole(\Egzakt\SystemBundle\Entity\Role $userRoles)
    {
        $this->userRoles->removeElement($userRoles);
    }
}