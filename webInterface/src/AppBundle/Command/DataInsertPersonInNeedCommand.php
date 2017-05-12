<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Repository\PersonInNeedRepository;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class DataInsertPersonInNeedCommand extends ContainerAwareCommand
{
	const PERSON_NAME_PARAM='name';
	const PERSON_SURNAME_PARAM='surname';
	
	protected function configure()
	{
		$this->setName("data:insert:person_in_need")
			->setDescription("Insert a new person in need for development purpoces")
			->setHelp("Insert a new person in need for development purpoces")
			->addOption(self::PERSON_NAME_PARAM,null,InputOption::VALUE_REQUIRED,"")
			->addOption(self::PERSON_SURNAME_PARAM,null,InputOption::VALUE_REQUIRED,"");
	}
	
	protected function execute(InputInterface $input,OutputInterface $output)
	{
		$container=$this->getContainer();
		/**
		 * @var PersonInNeedRepository $personInNeedService
		 */
		$personInNeedService=$container->get('person_in_need_repository');
		
		$name=$input->getOption(self::PERSON_NAME_PARAM);
		$surname=$input->getOption(self::PERSON_SURNAME_PARAM);
		
		$output->writeln($name." ".$surname);
		
		/**
		 * @var \AppBundle\Entity\PersonInNeed $person
		 */
		$person=$personInNeedService->registerPersonInNeed($name, $surname);
		
		$output->writeln("Registered User");
		$output->writeln("Name:". $person->getName());
		$output->writeln("Surname:".$person->getSurname());
		$output->writeln("Pin:".$person->getPin());
		
	}
}