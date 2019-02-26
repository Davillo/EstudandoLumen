<?php
namespace App\Services;

use Symfony\Component\HttpFoundation\Response;
use App\Repositories\CarRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use App\Model\ValidationCar;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CarService {
    private $carRepository;
  
    public function __construct(CarRepositoryInterface $carRepository)
    {   
       $this->carRepository = $carRepository;
    }

    public function getAll(){        
       $cars = $this->carRepository->getAll();

        try{
          if(count($cars)>0){
            return response()->json($cars,Response::HTTP_OK);
          }else{
            return response()->json([], Response::HTTP_OK);
          }
        }
        catch(\QueryException $e){
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
      
    }

    public function get($id){
        $car = $this->carRepository->get($id);
        if(count($car) > 0) {
         return response()->json($car,Response::HTTP_OK);
        }else{
         return response()->json(null,Response::HTTP_OK); 
        }
     
    }


    public function store(Request $request){
        $validator  = Validator::make(
            $request->all(),
            ValidationCar::RULE_CAR
        );

        if($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }else{
            try{
                $car = $this->carRepository->store($request);
                return response()->json($car,Response::HTTP_CREATED);
            }catch(\Exception $e){
                return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

    }

    public function update($id, Request $request){
        $validator  = Validator::make(
            $request->all(),
            ValidationCar::RULE_CAR
        );

        if($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }else{
            try{
                $car = $this->carRepository->update($id,$request);
                return response()->json($car,Response::HTTP_OK);
            }catch(\Exception $e){
                return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function destroy($id){
        try{
            $this->carRepository->destroy($id);
            return response()->json(null,Response::HTTP_OK);
        }catch(QueryException $e){
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}