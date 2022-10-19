<?php

namespace App\Modules\Common\User\Common\Repositories;


use App\Models\User;
use App\Modules\Common\Base\Repositories\BaseRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


class UserRepository extends BaseRepository
{
    protected $modelClass = User::class;

    public function all(
        string $column = 'id',
        string $dir = 'desc',
        array $filter = [],
        int $count = 10
    )
    {
        $builder = $this->model
            ->select(
                'users.id as id',
                'users.name as name',
                'users.lastname as last_name',
                'users.email as email',
                'users.phone as phone',
                'users.status as status',
                DB::raw('DATE_FORMAT(users.created_at, "%d.%m.%Y %H:%i:%s") as date'),
            );

        if(isset($filter['email'])){
            $builder->where('users.email','like', '%'.$filter['email'].'%');
        }

        if(isset($filter['name'])){
            $builder->where('users.name','like', '%'.$filter['name'].'%');
        }

        if(isset($filter['lastname'])){
            $builder->where('users.lastname','like', '%'.$filter['lastname'].'%');
        }

        if(isset($filter['phone'])){
            $builder->where('users.phone','like', '%'.$filter['phone'].'%');
        }

        if(isset($filter['verify_phone'])){
            $builder->where('users.phone_verified_at', $filter['verify_phone']);
        }

        if(isset($filter['country_id'])){
            $builder->where('users.country_id', $filter['country_id']);
        }

        if(isset($filter['status'])){
            $builder->where('users.status', $filter['status']);
        }


        return $builder->orderBy($column, $dir)->groupBy('users.id')->paginate($count);
    }

    public function getUserGroup(int $userGroupId)
    {
        //return UserGroup::where('id', $userGroupId)->first();
    }

    public function getNotConfirmed(Carbon $confirmDate) : Collection
    {
        return User::where([['created_at','<', $confirmDate], ['email_verified_at']])->get();
    }

    public function getByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function getByPhone(string $phone)
    {
        return $this->model->where('phone', $phone)->first();
    }

    public function getReferralCode($id)
    {
        return DB::table('referral_codes')
            ->where('user_id', $id)
            ->first();
    }

    public function getReferralUsers(
        int $userId,
        string $column = 'id',
        string $dir = 'desc',
        array $filter = []
    )
    {
        $builder = $this->model
            ->select(
                [
                    'users.id as id',
                    'users.name as name',
                    'users.lastname as last_name',
                    'users.email as email',
                    'users.phone as phone',
                    'users.created_at as created_at',
                    'users.status as status',
                ])
            ->where('ref_id', $userId);

        if(isset($filter['name'])){
            $builder->where('name', $filter['name']);
        }
        if(isset($filter['last_name'])){
            $builder->where('last_name', $filter['last_name']);
        }

        if(isset($filter['email'])){
            $builder->where('users.email', $filter['email']);
        }

        if(isset($filter['phone'])){
            $builder->where('users.email', $filter['phone']);
        }

        return $builder->orderBy($column, $dir)
            ->paginate(BaseRepository::getBaseCount());
    }

    public function getFull(int $userId, int $countryId, string $language)
    {
        return DB::table('users')
            ->select(
                [
                    'users.id as id',
                    'users.name as name',
                    'users.lastname as lastname',
                    'users.email as email',
                    'users.phone as phone',
                    'users.code as code',
                    'users.created_at as created_at',
                    'users.status as status'
                ])->where('id', $userId)->first();

    }

    public function getAgentByHash(string $hash)
    {
        $user = User::with('agentInfo')->where('hash', $hash)->first();

        if(empty($user)){
            throw ValidationException::withMessages(['hash' => 'Code from email is wrong']);
        }

        return $user;
    }

    public function getByHash(string $hash)
    {
        $user = User::where('hash', $hash)->first();

        if(empty($user)){
            throw ValidationException::withMessages(['hash' => 'Code from email is wrong']);
        }

        return $user;
    }

}
