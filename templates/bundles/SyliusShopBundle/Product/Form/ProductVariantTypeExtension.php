<?php

declare(strict_types=1);

namespace App\Form\Extension\Product\CustomProductVariantResolverInterface;

use Sylius\Bundle\ProductBundle\Form\Type\ProductOptionChoiceType;
use Sylius\Component\Product\Model\ProductInterface;
use Sylius\Component\Product\Resolver\ProductVariantResolverInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Webmozart\Assert\Assert;

final class CustomProductOptionFieldSubscriber implements EventSubscriberInterface
{
    private ProductVariantResolverInterface $variantResolver;

    public function __construct(ProductVariantResolverInterface $variantResolver)
    {
        $this->variantResolver = $variantResolver;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
        ];
    }

    public function preSetData(FormEvent $event): void
    {
        $product = $event->getData();

        /** @var ProductInterface $product */
        Assert::isInstanceOf($product, ProductInterface::class);

        $form = $event->getForm();

        /** Options should be disabled for configurable product if it has at least one defined variant */
        $disableOptions = (null !== $this->variantResolver->getVariant($product)) && $product->hasVariants();

        $form->add('options', ProductOptionChoiceType::class, [
            'required' => false,
            'disabled' => $disableOptions,
            'multiple' => true,
            'label' => 'sylius.form.product.options',
        ]);
    }
}
