<?php

namespace App\Modules\Security\Services;

use App\Modules\Security\DTO\PasswordResetDTO;
use App\Modules\Security\DTO\PasswordResetVerifyDTO;
use App\Modules\User\Repositories\UserRepository;


abstract class PasswordResetService
{
    const MAX_TRIES_COUNT = 5;
    protected $repository;
    protected $repositoryClass;
    protected $modelClass;
    protected $model;
    protected $userRepository;
    /**
     * @var HashService
     */
    private $hashService;

    public function __construct(
        UserRepository $userRepository,
        HashService $hashService
    )
    {
        $this->userRepository = $userRepository;
        $this->model = app()->make($this->modelClass);
        $this->repository = app()->make($this->repositoryClass);
        $this->hashService = $hashService;
    }

    public function handle(PasswordResetDTO $dto)
    {
        try{
            $this->checkCountGuard($dto);
            $this->checkUserGuard($dto);
            $code = $this->hashService->generateHash();
            $this->store($dto, $code);
            $this->send($dto, $code);
            return ['code' => $code, 'error' => null];
        }catch (\Exception $exception){
            return ['code' => null, 'error' => $exception->getMessage()];//.' '.$exception->getFile().' '.$exception->getLine()];
        }

    }

    public function verify(PasswordResetVerifyDTO $dto)
    {
    }

    protected function store(PasswordResetDTO $dto, string $code)
    {
    }

    protected function checkCountGuard(PasswordResetDTO $dto)
    {
        $count = $this->repository->getCount($dto);
        if ($count >= static::MAX_TRIES_COUNT) {
            throw new \Exception('Max attempts. Try again later');
        }
    }

    protected function generateCode()
    {
    }

    protected function send(PasswordResetDTO $dto, $code)
    {
    }

    protected function checkUserGuard(PasswordResetDTO $dto)
    {
    }

}
