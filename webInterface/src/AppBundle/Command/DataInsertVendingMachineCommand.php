<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;


class DataInsertVendingMachineCommand extends ContainerAwareCommand
{
	const VENDING_MACHINE_NAME='name';

	
	protected function configure()
	{
		$this->setName('data:insert:vending_machine')
			->setDescription('Insert a new Vending machine.')
			->setHelp('Insert a new Vending machine in order to retrieve key and secret.')
			->addOption(self::VENDING_MACHINE_NAME,null,InputOption::VALUE_REQUIRED,"A name for the vending machine");
	}
	
	protected function execute(InputInterface $input,OutputInterface $output)
	{
		$container=$this->getContainer();
		
		/**
		 * @var VendingMachineBusinessModel $vendingMachineModel
		 */
		$vendingMachineModel=$container->get('app.vending_machine_business_logic');
		
		$machine_name=$input->getOption(self::VENDING_MACHINE_NAME);
		
		$vendingMachine=$vendingMachineModel->addVendingMachine($machine_name);
		
		$output->println('Vending Machine Info');
		$output->println('Name: '.$vendingMachine->getMachineName());
		$output->println('Key: '.$vendingMachine->getKey());
		$output->println('Secret: '.$vendingMachine->getSecretUnhashed());
	}
}