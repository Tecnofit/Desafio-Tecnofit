<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;

class UserService
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        $data['role'] = 'customer';
        if (!$this->repository->create($data)) {
            return redirect()->back()->with('error', 'Falha ao cadastrar!');
        }

        return redirect()->route('customers.index')->with('success', 'Cadastro realizado com sucesso!');
    }

    public function update(int $id, array $data)
    {
        if (!$user = $this->repository->find($id)) {
            return redirect()->route('customers.index')->with('error', 'Cliente não encontrado!');
        }

        $data['role'] = 'customer';
        if (!$user = $this->repository->update($id, $data)) {
            return redirect()->back()->with('error', 'Falha ao atualizar!');
        }
        return redirect()->route('customers.index')->with('success', 'Atualizado com sucesso!');
    }

    public function delete(int $id)
    {
        if (!$user = $this->repository->find($id)) {
            return redirect()->route('customers.index')->with('error', 'Cliente não encontrado!');
        }

        $response = $this->repository->delete($user);
        if ($response) {
            return redirect()->route('customers.index')->with('success', 'Cliente deletado com sucesso!');
        }
        return redirect()->back()->with('error', 'Falha ao deletar!');
    }
}
