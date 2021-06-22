<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Entity\Conference;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInSingular('Commentaire sur les conférences')
        ->setEntityLabelInPlural('Commentaires sur les conférences')
        ->setSearchFields(['author', 'text', 'email'])
        ->setDefaultSort(['createdAt' => 'DESC']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters->add(EntityFilter::new('conference'));
    }

 
    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('conference', 'conférence');
        yield TextField::new('author', 'auteur');
        yield EmailField::new('email');
        yield TextEditorField::new('text', 'message')
        ->hideOnIndex();

        $createdAt = DateTimeField::new('createdAt', 'date de création')
        ->setFormTypeOptions([
            'html5' => true,
            'years' => range(date('Y'), date('Y')+2),
            'widget' => 'single_text',
        ]);
        if (Crud::PAGE_EDIT === $pageName) {
            yield $createdAt->setFormTypeOption('disabled', true);
        } else {
            yield $createdAt;
        }
    }
}
