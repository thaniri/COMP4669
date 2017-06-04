<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'get-all-pictures' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/get/pictures[/]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'get-all-pictures',
                    ],
                ],
            ],
            'view-one-picture' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/get/comments[/]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'view-one-picture',
                    ],
                ],
            ],
            'search' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/get/search',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'search',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'strategies' => ['ViewJsonStrategy'],
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/application/index/index.phtml',
            'error/index'             => __DIR__ . '/../view/application/index/index.phtml',
        ],
    ],
];
