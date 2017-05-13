<?php

use AppBundle\Stategies\GenerateUniqueFourDigitNumber;
use AppBundle\Repository\PersonInNeedRepository;
use Symfony\Component\DependencyInjection\Reference;
use AppBundle\Models\PersonInNeedBusinessLogicModel;
use AppBundle\Stategies\VariableLengthUniqieSrtingStrategy;
use AppBundle\Repository\VendingMachineRepository;
use AppBundle\Models\VendingMachineBusinessModel;
use AppBundle\Repository\PersonInNeedPerVendingRepository;
use AppBundle\Stategies\DoNotServeTwicePerVendingMachineStrategy;

$container->register('app.pin_strategy',GenerateUniqueFourDigitNumber::class);

$container->register('app.vending_person_in_need_per_vending_machine',PersonInNeedPerVendingRepository::class)
	->setFactory([new Reference("doctrine"),"getRepository"])
	->addArgument('AppBundle:PersonInNeedPerVending');

$container->register('app.api_limit_service',DoNotServeTwicePerVendingMachineStrategy::class)
	->setArguments([new Reference('app.vending_person_in_need_per_vending_machine'),'%api_call_limit%']);

$container->register('app.person_in_need_repository',PersonInNeedRepository::class)
	->setFactory([new Reference("doctrine"),"getRepository"])
	->addArgument('AppBundle:PersonInNeed');

$container->register('app.person_in_need_business_model',PersonInNeedBusinessLogicModel::class)
	->setArguments([new Reference('app.person_in_need_repository'),new Reference('app.pin_strategy')]);

$container->register('app.uniqueKeyGenerator',VariableLengthUniqieSrtingStrategy::class)
	->setArguments(['16']);
	
$container->register('app.uniqueSecretGenerator',VariableLengthUniqieSrtingStrategy::class)
	->setArguments(['32']);
	
$container->register('app.vending_machine_repository',VendingMachineRepository::class)
	->setFactory([new Reference("doctrine"),"getRepository"])
	->addArgument('AppBundle:VendingMachine');

$container->register('app.vending_machine_business_logic',VendingMachineBusinessModel::class)
	->setArguments([new Reference('app.uniqueKeyGenerator'),new Reference('app.uniqueSecretGenerator'),new Reference('app.vending_machine_repository')]);



