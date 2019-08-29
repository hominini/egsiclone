<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    /**
     * Guarda un recurso en la base de datos
     *
     * @param \App\Http\Requests\StoreUser $request
     * @return App\User
     */
    public function create($userData)
    {
        // obteniendo los parametros del usuario
        $input = $userData->all();

        // se guarda el usuario
        $user = User::create($input);

        return $user;
    }

    /**
     * Actualiza un recurso en la base de datos
     *
     * @param \App\Http\Requests\StoreUser $request
     * @return App\User
     */
    public function update($userData, $id)
    {
        // se obtiene los datos del usuario
        $input = $userData->all();

        // se busca el usuario a actualizar por medio del id
        $user = User::find($id);

        // se actualiza el usuario
        $user->update($input);

        return $user;
    }
}
