<?php

use AppBundle\Stategies\GenerateUniqueFourDigitNumber;
use AppBundle\Repository\PersonInNeedRepository;
use Symfony\Component\DependencyInjection\Reference;
use AppBundle\Models\PersonInNeedBusinessLogicModel;

/**
 * @var 
 */
$container->register('app.pin_strategy',GenerateUniqueFourDigitNumber::class);

$container->register('app.person_in_need_repository',PersonInNeedRepository::class)
	->setFactory([new Reference("doctrine"),"getRepository"])
	->addArgument('AppBundle:PersonInNeed');

$container->register('app.person_in_need_business_model',PersonInNeedBusinessLogicModel::class)
	->setArguments([new Reference('app.person_in_need_repository'),new Reference('app.pin_strategy')]);


// services:
//     #service_name:
//     #    class: AppBundle\Directory\ClassName
//     #    arguments: ['@another_service_name', 'plain_value', '%parameter_name%']
//   app.pin_strategy:
//    class: AppBundle\Stategies\GenerateUniqueFourDigitNumber
  
//   person_in_need_repository:
//     class: AppBundle\Repository\PersonInNeedRepository
//     factory: ["@doctrine","getRepository"]
//     arguments: ["AppBundle:PersonInNeed"]
    
//   app.person_in_need_business_model:
//     class: AppBundle\Models\PersonInNeedBusinessLogicModel
//     parameters: ['@person_in_need_repository','@app.pin_strategy']