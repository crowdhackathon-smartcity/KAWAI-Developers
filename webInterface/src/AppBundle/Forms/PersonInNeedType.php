<?php

namespace AppBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class PersonInNeedType extends AbstractType 
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('name',TextType::class,array('label'=>'social.person_in_need.name','placefolder'=>'social.person_in_need.name'))
		->add('surname',TextType::class,array('label'=>'social.person_in_need.name','placefolder'=>'social.person_in_need.name'))
		->add('reason',TextareaType::class,array('label'=>'social.person_in_need.reason','placefolder'=>'social.person_in_need.reason'));
	}
}