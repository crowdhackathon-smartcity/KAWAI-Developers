<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Stategies\DoNotServeTwicePerVendingMachineStrategy;
use AppBundle\Constants\PersonInNeedConstats;
use AppBundle\Constants\VendingMachineConstants;
use AppBundle\Exceptions\ExceededTimeLimitException;

class ApiController extends Controller
{
	/**
	 * @Route("/api/person_in_need/pin/{pin}",name="get_by_pin")
	 */
	public function getByPin(Request $request,$pin)
	{
		$model=$this->get('app.person_in_need_business_model');
		
		try{
			//I Implement Like this because this Call is needed to use the api call time limit
			/**
			 * @var Ambiguous $vendingMachine
			 */
			$vendingMachine=$this->get('app.vending_machine_business_logic');
			$key=$request->headers->get('key');
			$secret=$request->headers->get('secret');
			
			$vendingMachine=$vendingMachine->verifyVendingMachine($key,$secret);
			
			$person_in_need=$model->getPersonInNeedByPin($pin);
			
			/**
			 * @var DoNotServeTwicePerVendingMachineStrategy $appCallLimitPolicy
			 */
			$appCallLimitPolicy=$this->get('app.api_limit_service');
			$appCallLimitPolicy->applyPolicy([PersonInNeedConstats::PERSON_IN_NEED=>$person_in_need,VendingMachineConstants::VENDING_MACHINE=>$vendingMachine]);
			
			if(empty($person_in_need)){
				return new JsonResponse(['message'=>"This user does not exist"],JsonResponse::HTTP_NOT_FOUND);
			} else {
				$repository=$this->get('app.vending_person_in_need_per_vending_machine');
				$repository->addPersonPerVending($person_in_need,$vendingMachine);
				$normalizers = new \Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer();
				$person_in_need= $normalizers->normalize($person_in_need);
				return new JsonResponse($person_in_need);
			}
		}catch (ExceededTimeLimitException $ex) {
			return new JsonResponse(['message'=>$ex->getMessage()],JsonResponse::HTTP_TOO_MANY_REQUESTS);
		}catch (NoVendingMachineFoundException $nf) {
			return new JsonResponse(['message'=>$nf->getMessage()],JsonResponse::HTTP_UNAUTHORIZED);
		}catch(\Exception $e){
			return new JsonResponse(['message'=>$e->getMessage()],JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
		}
	}
}
