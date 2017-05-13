<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use AppBundle\Models\PersonInNeedBusinessLogicModel;

class DataInsertPersonInNeedCommand extends ContainerAwareCommand
{
	const PERSON_NAME_PARAM='name';
	const PERSON_SURNAME_PARAM='surname';
	const PERSON_REASON_PARAM='reason';
	
	protected function configure()
	{
		$this->setName("data:insert:person_in_need")
			->setDescription("Insert a new person in need for development purpoces")
			->setHelp("Insert a new person in need for development purpoces")
			->addOption(self::PERSON_NAME_PARAM,null,InputOption::VALUE_REQUIRED,"The person's name")
			->addOption(self::PERSON_SURNAME_PARAM,null,InputOption::VALUE_REQUIRED,"The person's surname")
			->addOption(self::PERSON_REASON_PARAM,null,InputOption::VALUE_REQUIRED,"The person's reason that needs to be served via vending machine");
	}
	
	protected function execute(InputInterface $input,OutputInterface $output)
	{
		$container=$this->getContainer();
		/**
		 * @var PersonInNeedBusinessLogicModel $personInNeedService
		 */
		$personInNeedService=$container->get('app.person_in_need_business_model');
		
		$name=$input->getOption(self::PERSON_NAME_PARAM);
		$surname=$input->getOption(self::PERSON_SURNAME_PARAM);
		$reason=$input->getOption(self::PERSON_REASON_PARAM);		
		
		
		/**
		 * @var \AppBundle\Entity\PersonInNeed $person
		 */
		$person=$personInNeedService->registerPersonInNeed($name, $surname,$reason);
		
		$output->writeln("Registered User");
		$output->writeln("Name:". $person->getName());
		$output->writeln("Surname:".$person->getSurname());
		$output->writeln("Pin:".$person->getPin());
		
	}
}