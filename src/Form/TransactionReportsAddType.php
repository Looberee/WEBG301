<?php

namespace App\Form;

use App\Entity\TransactionReports;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;

class TransactionReportsAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Date_Supply')
            ->add('Order_ID')
            ->add('Customer_ID')
            ->add('Food_ID')
            ->add('Supply_ID')
            ->add('Delivery_ID')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TransactionReports::class,
        ]);
    }
}
