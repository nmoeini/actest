<?php
/**
 * @author "Navid Moeini"
 * @date May 2018
 */

namespace App\Services;


use App\Repositories\RepositoryInterface;

class Service implements ServiceInterface
{


    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * Service constructor initiates Repository
     *
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {

        $this->repository = $repository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return mixed
     */
    public function create()
    {

        return $this->repository->create(request()->only($this->repository->getModel()->fillable));
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {

        return $this->repository->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {

        $this->repository->update(request()->only($this->repository->getModel()->fillable), $id);

        return $this->repository->getModel()->find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {

        return $this->repository->delete($id);
    }
}