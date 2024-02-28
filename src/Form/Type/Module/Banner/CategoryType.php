<?php

namespace App\Form\Type\Module\Banner;

use App\Entity\Module\Banner\Category;
use App\Form\Widget as WidgetType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * CategoryType
 *
 * @author Sébastien FOURNIER <contact@sebastien-fournier.com>
 */
class CategoryType extends AbstractType
{
    private bool $isInternalUser;

    /**
     * CategoryType constructor.
     */
    public function __construct(
        private readonly TranslatorInterface $translator,
        private readonly AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->isInternalUser = $this->authorizationChecker->isGranted('ROLE_INTERNAL');
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $isNew = !$builder->getData()->getId();

        $adminName = new WidgetType\AdminNameType($this->translator);
        $adminName->add($builder, [
            'slug' => $this->isInternalUser,
            'adminNameGroup' => $this->isInternalUser ? 'col-10' : 'col-12',
            'slugGroup' => 'col-sm-2',
            'class' => 'refer-code'
        ]);

        if(!$isNew) {
            $adminName = new WidgetType\MediaSizesType($this->translator);
            $adminName->add($builder, ['displayTitle' => true, 'tabSize' => 12, 'fieldSize' => 6]);
        }

        $save = new WidgetType\SubmitType($this->translator);
        $save->add($builder);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
            'website' => NULL,
            'translation_domain' => 'admin'
        ]);
    }
}