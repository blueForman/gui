<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Gui\Communication\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DeleteForm extends AbstractType
{

    /**
     * @return string
     */
    public function getName()
    {
        return 'delete_form';
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     *
     * @return void
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setRequired('action');
        $resolver->setRequired('fields');

        $resolver->setDefaults([
            'attr' => [
                'style' => 'display:inline;'
            ],
        ]);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAction($options['action']);
        $builder->setMethod(Request::METHOD_DELETE);

        $this->addDeleteField($builder, $options);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return $this
     */
    protected function addDeleteField(FormBuilderInterface $builder, array $options)
    {
        foreach ($options['fields'] as $key => $value) {
            $builder->add($key, 'hidden', [
                'data' => $value
            ]);
        }

        return $this;
    }

}
