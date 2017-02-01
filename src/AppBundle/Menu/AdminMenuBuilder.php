<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
final class AdminMenuBuilder
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param RequestStack $requestStack
     *
     * @return ItemInterface
     */
    public function createMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');

        $this->addCustomerSubMenu($menu);
        $this->addConfigurationSubMenu($menu);

        return $menu;
    }

    /**
     * @param ItemInterface $menu
     *
     * @return ItemInterface
     */
    private function addCustomerSubMenu(ItemInterface $menu)
    {
        $customer = $menu
            ->addChild('customer')
            ->setLabel('sylius.ui.customer')
        ;

        $customer->addChild('backend_customer', ['route' => 'sylius_backend_customer_index'])
            ->setLabel('sylius.ui.customers')
            ->setLabelAttribute('icon', 'users');

        return $customer;
    }


    /**
     * @param ItemInterface $menu
     *
     * @return ItemInterface
     */
    private function addConfigurationSubMenu(ItemInterface $menu)
    {
        $configuration = $menu
            ->addChild('configuration')
            ->setLabel('sylius.ui.configuration')
        ;

        $configuration->addChild('backend_address', ['route' => 'app_backend_address_index'])
            ->setLabel('app.ui.addresses')
            ->setLabelAttribute('icon', 'marker');

        $configuration->addChild('backend_admin_user', ['route' => 'sylius_backend_admin_user_index'])
            ->setLabel('sylius.ui.admin_users')
            ->setLabelAttribute('icon', 'lock');

        return $configuration;
    }
}