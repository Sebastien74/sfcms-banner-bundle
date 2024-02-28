<?php

namespace App\Form\Type\Module\Banner;

use App\Entity\Module\Banner\Category;
use App\Entity\Module\Banner\Teaser;
use App\Form\Widget as WidgetType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * TeaserType.
 *
 * @author Sébastien FOURNIER <contact@sebastien-fournier.com>
 */
class TeaserType extends AbstractType
{
    private bool $isInternalUser;

    /**
     * TeaserType constructor.
     */
    public function __construct(
        private readonly TranslatorInterface $translator,
        private readonly TokenStorageInterface $tokenStorage)
    {
        $user = !empty($this->tokenStorage->getToken()) ? $this->tokenStorage->getToken()->getUser() : null;
        $this->isInternalUser = $user && in_array('ROLE_INTERNAL', $user->getRoles());
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $isNew = !$builder->getData()->getId();

        $adminNameGroup = 'col-12';
        if (!$isNew && $this->isInternalUser) {
            $adminNameGroup = 'col-md-10';
        }
        $adminName = new WidgetType\AdminNameType($this->translator);
        $adminName->add($builder, [
            'adminNameGroup' => $adminNameGroup,
            'slugGroup' => 'col-sm-2',
            'slug-internal' => $this->isInternalUser,
        ]);

        if (!$isNew) {
            $builder->add('categories', EntityType::class, [
                'label' => $this->translator->trans('Catégories', [], 'admin'),
                'required' => false,
                'display' => 'search',
                'class' => Category::class,
                'attr' => [
                    'data-placeholder' => $this->translator->trans('Sélectionnez', [], 'admin'),
                ],
                'choice_label' => function ($entity) {
                    return strip_tags($entity->getAdminName());
                },
                'multiple' => true,
            ]);
        }

        $save = new WidgetType\SubmitType($this->translator);
        $save->add($builder);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Teaser::class,
            'website' => null,
            'translation_domain' => 'admin',
        ]);
    }
}