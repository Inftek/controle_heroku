<?php

namespace MRS\ControleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

abstract class User
{

    /**
     * @var \MRS\ControleBundle\Entity\TbCategoria
     *
     * @ORM\ManyToOne(targetEntity="MRS\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
     * })
     */
    protected $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return User
     */
    public function setUser(\MRS\UserBundle\Entity\User $user)
    {
        $this->user = $user;
        return $this;
    }



}

