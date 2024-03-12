<?php

namespace App\Form\Type\Module\Banner;

use App\Entity\Module\Banner\Size;
use App\Form\Widget as WidgetType;
use App\Service\Interface\CoreLocatorInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * SizeType.
 *
 * @author Sébastien FOURNIER <contact@sebastien-fournier.com>
 */
class SizeType extends AbstractType
{
    private TranslatorInterface $translator;
    private bool $isInternalUser;

    /**
     * SizeType constructor.
     */
    public function __construct(
        private readonly CoreLocatorInterface $coreLocator,
        private readonly AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->translator = $this->coreLocator->translator();
        $this->isInternalUser = $this->authorizationChecker->isGranted('ROLE_INTERNAL');
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $isNew = !$builder->getData()->getId();

        $adminName = new WidgetType\AdminNameType($this->translator);
        $adminName->add($builder, [
            'slug' => $this->isInternalUser,
            'adminNameGroup' => $this->isInternalUser && !$isNew ? 'col-sm-10' : 'col-12',
            'slugGroup' => 'col-sm-2',
            'class' => 'refer-code',
        ]);

        if (!$isNew) {
            $adminName = new WidgetType\MediaSizesType($this->translator);
            $adminName->add($builder, ['displayTitle' => true, 'tabSize' => 12, 'fieldSize' => 6]);
        }

        $save = new WidgetType\SubmitType($this->translator);
        $save->add($builder);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Size::class,
            'website' => null,
            'translation_domain' => 'admin',
        ]);
    }
}
