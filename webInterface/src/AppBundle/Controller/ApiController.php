<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends Controller
{
	/**
	 * @Route("/api/person_in_need/pin/{pin}",name="get_by_pin")
	 */
	public function getByPin(Request $request,$pin)
	{
		$model=$this->get('app.person_in_need_business_model');
		
		try{
			$person_in_need=$model->getPersonInNeedByPin($pin);
			
			if(empty($person_in_need)){
				return new JsonResponse(['message'=>"This user does not exist"],JsonResponse::HTTP_NOT_FOUND);
			} else {
				//$serializer=$this->get('jms_serializer');
				
// 				$person_in_need=$serializer->serialize(array_values($serializer),'json');
				$normalizers = new \Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer();
				$person_in_need= $normalizers->normalize($person_in_need);
				return new JsonResponse($person_in_need);
			}
			
		}catch(\Exception $e){
			return new JsonResponse(['message'=>$e->getMessage()],JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
		}
	}
}
