<?php
namespace Traders\Security;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use System\Helpers\Arr;

/**
 * Created by PhpStorm.
 * User: roeehershko
 * Date: 2/19/16
 * Time: 5:18 PM
 */
class TradersLogin {

    /**
     * @var $doctrine Registry
     */
    private $doctrine;

    /**
     * @var $data array
     */
    private $data = [];

    private $encoder;

    /**
     * @var $token_storage TokenStorage
     */
    private $token_storage;

    public function __construct(Registry $doctrine, TokenStorage $token_storage, $encoder)
    {
        $this->doctrine = $doctrine;
        $this->token_storage = $token_storage;
        $this->encoder = $encoder;
    }

    public function setCredentials($data)
    {
        $this->data = $data;

        return $this;
    }

    public function login()
    {
        /**
         * @var $repo EntityRepository
         */
        $repo = $this->doctrine->getRepository('System:Traders');
        $user = $repo->findOneBy([ 'email' => Arr::get($this->data, 'email') ]);

        if ( ! $user) throw new PreconditionFailedHttpException();

        $encoded_password = $this->encoder->encodePassword($user, Arr::get($this->data, 'password'));

        if($user->getPassword() == $encoded_password)
        {
            $token = new UsernamePasswordToken($user, null, 'users', $user->getRoles());
            $this->token_storage->setToken($token);

            return [
                'status' => 'success',
                'user' => $user
            ];
        }
        else
        {
            // TODO.Lock User After 5 Attempts for 15 minutes
            throw new PreconditionFailedHttpException('Invalid Credentials');
        }
    }
}