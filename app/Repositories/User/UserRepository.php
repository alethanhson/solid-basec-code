<?php

namespace App\Repositories\User;

use App\Interfaces\User\UserRepositoryInterface;
use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function findByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function getListUserFilter($data)
    {
        $perPage = $data['per_page'];
        $keyWord = $data['key_word'];

        $query = $this->model->select('*');

        if ($keyWord) {
            $query->where('name', 'LIKE', "%{$keyWord}%")
                ->orWhere('email', 'LIKE', "%{$keyWord}%");
        }

        return $query
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);
    }
}
