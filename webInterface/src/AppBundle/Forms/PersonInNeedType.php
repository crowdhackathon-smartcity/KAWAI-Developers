<?php

namespace AppBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Entity\PersonInNeed;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Constants\PersonInNeedConstats;

class PersonInNeedType extends AbstractType 
{
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::buildForm()
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add(PersonInNeedConstats::PERSON_IN_NEED_NAME,TextType::class,array('label'=>'app.layout.person_in_need.name'))
		->add(PersonInNeedConstats::PERSON_IN_NEED_SURNAME,TextType::class,array('label'=>'app.layout.person_in_need.surname'))
		->add(PersonInNeedConstats::PERSON_IN_NEED_REASON,TextareaType::class,array('label'=>'app.layout.person_in_need.reason'));
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::configureOptions()
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => PersonInNeed::class,
				'translation_domain' => 'AppBundle'
				
		));
	}
}