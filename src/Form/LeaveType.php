<?php

namespace App\Form;

use App\Entity\Leave;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LeaveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startDate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('endDate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'RTT' => 'RTT',
                    'CP' => 'CP',
                    'Congé exceptionnel' => 'Congé exceptionnel',
                ],
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Demandé' => 'Demandé',
                    'Validé' => 'Validé',
                    'Refusé' => 'Refusé',
                    'Annulé' => 'Annulé',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Leave::class,
        ]);
    }
}
