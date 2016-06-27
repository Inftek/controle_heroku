<?php

/**
 * Created by PhpStorm.
 * User: mrs4
 * Date: 26/06/16
 * Time: 22:26
 */
namespace MRS\ControleBundle\Security;

use \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use \Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserVoter
{

    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function securityUser($entity)
    {
        $userID = $this->tokenStorage->getToken()->getUser()->getId();

        $entityId = $entity->getUser()->getId();

        if($userID != $entityId){
            throw new AccessDeniedException('Nao tem permissao para este item');
        }

    }

}