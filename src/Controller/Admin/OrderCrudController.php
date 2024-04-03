<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add('index', 'detail')
            ->remove(Crud::PAGE_INDEX, Action::NEW);
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Order')
            ->setEntityLabelInPlural('Orders')
            ->setDefaultSort(['id' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateTimeField::new('createdAt', 'Date'),
            TextField::new('reference', 'Reference Number'),
            TextField::new('user.fullname', 'Name'),
            TextField::new('user.email', 'Email'),
            TextField::new('delivery', 'Delivery Address')->onlyOnDetail()->formatValue(function ($value, $entity) {
                // Remove the <br> tags and replace with commas
                return str_replace('<br>', ', ', $entity->getDelivery());
            }),
            MoneyField::new('total')->setCurrency('USD')->hideOnForm(),
            MoneyField::new('carrierPrice', 'Shipping fee')->setCurrency('USD'),
            ChoiceField::new('state', 'Status')->setChoices(
                [
                    'Unpaid' => 0,
                    'Paid' => 1,
                    'Preparation in progress' => 2,
                    'Shipped' => 3,
                    'COD' => 4
                ]
            ),
            ArrayField::new('orderDetails', 'Purchased')->hideOnIndex()->hideOnForm()
        ];
    }
}
