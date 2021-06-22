<?php

namespace App\Controller\Admin;

use App\Entity\Conference;
use App\Entity\Speaker;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class SpeakerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Speaker::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInSingular('un conférencier')
        ->setEntityLabelInPlural('Les conférenciers')
        ->setDefaultSort(['name' => 'DESC']);
    }
    public function configureFields(string $pageName): iterable
    {
        yield ImageField::new('photo')
            ->setBasePath('uploads/')
            ->setUploadDir('public/uploads/')
            ->setFormType(FileUploadType::class);
        yield TextField::new('name', 'Nom');
        yield TextField::new('surname', 'Prénom');
        yield TextEditorField::new('bio')
            ->hideOnIndex();
    }
}
