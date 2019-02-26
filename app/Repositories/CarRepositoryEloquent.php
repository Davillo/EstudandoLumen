<?php
namespace App\Repositories;
use App\Repositories\CarRepositoryInterface;
use Illuminate\Http\Request;
use App\Model\Car;

class CarRepositoryEloquent implements CarRepositoryInterface{
    private $model;

    public function __construct(Car $car){
        $this->model = $car;
    }

    
    public function getAll(){
        return $this->model->all();
    }
    public function get($id){
        return $this->model->find($id);
    }
    public function store(Request $request){
        return $this->model->create($request->all());
    }
    public function update($id, Request $request){
        return $this->model->find($id)->update($request->all());
    }
    public function destroy($id){
        return $this->model->find($id)->delete();
    }
}