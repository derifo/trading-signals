<?php
namespace Traders\Security;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use System\Entity\Traders;
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
        $this->encoder = $encoder;
        $this->doctrine = $doctrine;
        $this->token_storage = $token_storage;
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

        /**
         * @var $trader Traders
         */
        $trader = $repo->findOneBy([ 'email' => Arr::get($this->data, 'email') ]);

        if ( ! $trader) throw new PreconditionFailedHttpException();

        $encoded_password = $this->encoder->encodePassword($trader, Arr::get($this->data, 'password'));

        if($trader->getPassword() == $encoded_password)
        {
            $this->setTraderToken($trader);

            return [
                'status' => 'success',
                'user' => $trader
            ];
        }
        else
        {
            // TODO.Lock User After 5 Attempts for 15 minutes
            throw new PreconditionFailedHttpException('Invalid Credentials');
        }
    }

    public function setTraderToken(Traders $trader)
    {
        $token = new UsernamePasswordToken($trader, null, 'users', $trader->getRoles());
        $this->token_storage->setToken($token);
    }
}