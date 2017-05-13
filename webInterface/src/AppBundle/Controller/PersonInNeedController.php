<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Forms\PersonInNeedType;
use AppBundle\Entity\PersonInNeed;
use AppBundle\Models\PersonInNeedBusinessLogicModel;
use AppBundle\Constants\PersonInNeedConstats;

class PersonInNeedController extends Controller
{
	/**
	 * @Route("/person_in_need/add",name="add_person_in_need")
	 */
	public function addPersonInNeed(Request $request)
	{
		$form=$this->createForm(PersonInNeedType::class,new PersonInNeed());
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			/**
			 * @var PersonInNeedBusinessLogicModel $dataInsert
			 */
			$dataInsert=$this->get('app.person_in_need_business_model');
			$name=$form->get(PersonInNeedConstats::PERSON_IN_NEED_NAME)->getData();
			$surname=$form->get(PersonInNeedConstats::PERSON_IN_NEED_SURNAME)->getData();
			$reason=$form->get(PersonInNeedConstats::PERSON_IN_NEED_REASON)->getData();
			$dataInsert->registerPersonInNeed($name,$surname,$reason);
// 			return $this->redirectToRoute('person_in_need_view');
		}
		
		return $this->render('social_worker/add_person_in_need.html.twig',array(
			'form'=>$form->createView()																																																																																																																																																						
		));
	}
	
	/**
	 * @Route("/person_in_need/{id}",name="person_in_need_view")
	 */
	public function viewPersonInNeed(Request $request,$id)
	{
		$personInNeedModel=$this->get('app.person_in_need_business_model');
		$person=$personInNeedModel->getPersonById($id);
		return $this->render('social_worker/person.html.twig',array('name'=>$person->getName(),
				'surname'=>$person->getSurname(),
				'pin'=>$person->getPin(),
				'reason'=>$person->getReason()));
	}
}