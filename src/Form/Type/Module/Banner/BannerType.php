<?php

namespace App\Form\Type\Module\Banner;

use App\Entity\Core\Website;
use App\Entity\Module\Banner\Banner;
use App\Entity\Module\Banner\Size;
use App\Form\Widget as WidgetType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * BannerType
 *
 * @author Sébastien FOURNIER <contact@sebastien-fournier.com>
 */
class BannerType extends AbstractType
{
    private bool $isInternalUser;
    private ?Website $website;

    /**
     * BannerType constructor.
     */
    public function __construct(
        private readonly TranslatorInterface $translator,
        private readonly AuthorizationCheckerInterface $authorizationChecker,
        private readonly EntityManagerInterface $entityManager,
    ) {
        $this->isInternalUser = $this->authorizationChecker->isGranted('ROLE_INTERNAL');
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** @var Banner $data */
        $data = $builder->getData();
        $isNew = !$data->getId();
        $this->website = $options['website'];

        $adminNameGroup = 'col-9';
        if (!$isNew && $this->isInternalUser) {
            $adminNameGroup = 'col-md-7';
        }
        $adminName = new WidgetType\AdminNameType($this->translator);
        $adminName->add($builder, [
            'slug' => $this->isInternalUser,
            'adminNameGroup' => $adminNameGroup,
            'slugGroup' => 'col-sm-2',
            'class' => 'refer-code'
        ]);

        $sizes = $this->entityManager->getRepository(Size::class)->findBy(['website' => $this->website]);
        $displayPlaceholderSizes = count($sizes) === 0 || count($sizes) > 1;
        $builder->add('size', EntityType::class, [
            'label' => $this->translator->trans('Taille', [], 'admin'),
            'placeholder' => $displayPlaceholderSizes ? $this->translator->trans('Sélectionnez', [], 'admin') : false,
            'display' => 'search',
            'attr' => [
                'data-placeholder' => $displayPlaceholderSizes ? $this->translator->trans('Sélectionnez', [], 'admin') : false,
                'group' => "col-md-3",
            ],
            'class' => Size::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('c')
                    ->andWhere('c.website = :website')
                    ->setParameter('website', $this->website)
                    ->orderBy('c.adminName', 'ASC');
            },
            'choice_label' => function ($entity) {
                return strip_tags($entity->getAdminName());
            },
            'constraints' => [new Assert\NotBlank()]
        ]);

        if (!$isNew) {

            $i18ns = new WidgetType\i18nsCollectionType();
            $i18ns->add($builder, [
                'fields' => ['title'],
                'excludes_fields' => ['headerTable'],
                'content_config' => false,
                'disableTitle' => true,
            ]);

            $dates = new WidgetType\PublicationDatesType($this->translator);
            $dates->add($builder, [
                'startGroup' => 'col-md-6 datetime-group mb-4',
                'endGroup' => 'col-md-6 datetime-group mb-4',
                'data-config' => false,
            ]);

            $mediaRelations = new WidgetType\MediaRelationsCollectionType($this->entityManager);
            $mediaRelations->add($builder, ['entry_options' => [
                'onlyMedia' => true,
                'forceI18n' => true,
                'fields' => ['i18n' => ['targetPage' => 'col-md-4', 'targetLink' => 'col-md-8', 'newTab', 'externalLink']],
                'excludes_fields' => ['i18n' => ['targetStyle', 'targetAlignment']]
            ]]);
        }

        $save = new WidgetType\SubmitType($this->translator);
        $save->add($builder, ['btn_both' => true]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Banner::class,
            'website' => NULL,
            'translation_domain' => 'admin'
        ]);
    }
}