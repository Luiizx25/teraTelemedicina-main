<?php

namespace App\Http\Middleware;

use Closure;

class AppMenuItemsGenerate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $menuItemsToManager = [
            'toManager.dashboard' => [
                'icon' => 'home',
                'titleOnly' => true,
                'title' => 'Dashboard',
                'route' => 'toManager.dashboard',
                'inRoute' => ['toManager.dashboard'],
            ],

            'toManager.order' => [
                'icon' => 'layers',
                'title' => 'Orders',
                'route-group' => 'toManager/order',
                'sub_menu' => [
                    'toManager.order.index' => [
                        'icon' => 'maximize',
                        'title' => 'Overview',
                        'route' => 'toManager.order.index',
                        'inRoute' => ['toManager.order.index','toManager.order.create','toManager.order.show'],
                    ],
                    'toManager.orderItem.index' => [
                        'icon' => 'align-center',
                        'title' => 'Items',
                        'route' => 'toManager.orderItem.index',
                        'inRoute' => ['toManager.orderItem.index','toManager.orderItem.create','toManager.orderItem.show'],
                    ],
                ]
            ],

            'toManager.service' => [
                'icon' => 'clipboard',
                'title' => 'Services',
                'route-group' => 'toManager/service',
                'sub_menu' => [
                    'serviceType.index' => [
                        'icon' => 'type',
                        'title' => 'Types',
                        'route' => 'toManager.serviceType.index',
                        'inRoute' => ['toManager.serviceType.index'],
                    ],
                    'serviceCategory.index' => [
                        'icon' => 'copy',
                        'title' => 'Categories',
                        'route' => 'toManager.serviceCategory.index',
                        'inRoute' => ['toManager.serviceCategory.index'],
                    ],
                    'service.index' => [
                        'icon' => 'hard-drive',
                        'title' => 'Services',
                        'route' => 'toManager.service.index',
                        'inRoute' => ['toManager.service.index'],
                    ],
                    'serviceVariation.index' => [
                        'icon' => 'server',
                        'title' => 'Variations',
                        'route' => 'toManager.serviceVariation.index',
                        'inRoute' => ['toManager.serviceVariation.index','toManager.serviceVariation.create','toManager.serviceVariation.edit'],
                    ],
                    'servicePreResponse.index' => [
                        'icon' => 'book-open',
                        'title' => 'Pre Responses',
                        'route' => 'toManager.servicePreResponse.index',
                        'inRoute' => ['toManager.servicePreResponse.index','toManager.servicePreResponse.create','toManager.servicePreResponse.edit'],
                    ],
                ]
            ],

            'toManager.customer' => [
                'icon' => 'briefcase',
                'title' => 'Customers',
                'route-group' => 'toManager/customer',
                'sub_menu' => [
                    'toManager.customer.index' => [
                        'icon' => 'maximize',
                        'title' => 'Overview',
                        'route' => 'toManager.customer.index',
                        'inRoute' => ['toManager.customer.index','toManager.customer.create','toManager.customer.show','toManager.customer.edit'],
                    ],
                    'toManager.customerContract.index' => [
                        'icon' => 'sliders',
                        'title' => 'Contracts',
                        'route' => 'toManager.customerContract.index',
                        'inRoute' => ['toManager.customerContract.index','toManager.customerContract.create','toManager.customerContract.show','toManager.customerContract.edit','toManager.customerContractCusCycle.generate'],
                    ],
                    'toManager.customerUser.index' => [
                        'icon' => 'users',
                        'title' => 'Users',
                        'route' => 'toManager.customerUser.index',
                        'inRoute' => ['toManager.customerUser.index','toManager.customerUser.show','toManager.customerUser.create','toManager.customerUser.edit','toManager.customerUser.update','toManager.customerUser.updatePwd',],
                    ],
                ]
            ],

            'toManager.provider' => [
                'icon' => 'pen-tool',
                'title' => 'Providers',
                'route-group' => 'toManager/provider',
                'sub_menu' => [
                    'provider.index' => [
                        'icon' => 'maximize',
                        'title' => 'Overview',
                        'route' => 'toManager.provider.index',
                        'inRoute' => ['toManager.provider.index','toManager.provider.show','toManager.provider.edit','toManager.provider.create','providerUser.index'],
                    ],
                    'providerContract.index' => [
                        'icon' => 'sliders',
                        'title' => 'Contracts',
                        'route' => 'toManager.providerContract.index',
                        'inRoute' => ['toManager.providerContract.index','toManager.providerContract.create','toManager.providerContract.show','toManager.providerContract.edit'],
                    ],
                    'providerType.index' => [
                        'icon' => 'type',
                        'title' => 'Types',
                        'route' => 'toManager.providerType.index',
                        'inRoute' => ['toManager.providerType.index'],
                    ],
                    'providerSpecialty.index' => [
                        'icon' => 'activity',
                        'title' => 'Specialties',
                        'route' => 'toManager.providerSpecialty.index',
                        'inRoute' => ['toManager.providerSpecialty.index'],
                    ],
                ]
            ],
            
            'toManager.financial' => [
                'icon' => 'dollar-sign',
                'titleOnly' => true,
                'title' => 'Financial',
                'route' => 'toManager.financial',
                'inRoute' => ['toManager.financial'],
            ], 
            
            'toManager.log' => [
                'icon' => 'settings',
                'titleOnly' => true,
                'title' => 'Access Log',
                'route' => 'toManager.log',
                'inRoute' => ['toManager.log'],
            ],

            'devider',
            'toManager.settings' => [
                'icon' => 'settings',
                'titleOnly' => true,
                'title' => 'System Admin',
                'route' => 'toManager.SystemAdmin.index',
                'inRoute' => ['toManager.SystemAdmin.index','toManager.UserCustomerSys.show','toManager.UserCustomerSys.edit'],
            ],
        ];

        $menuItemsToCustomer = [
            'toCustomer.dashboard' => [
                'icon' => 'home',
                'titleOnly' => true,
                'title' => 'Dashboard',
                'route' => 'toCustomer.dashboard',
                'inRoute' => ['toCustomer.dashboard'],
            ],
            'toCustomer.order' => [
                'icon' => 'layers',
                'title' => 'Orders',
                'route-group' => 'toCustomer/order',
                'sub_menu' => [
                    'toCustomer.order.index' => [
                        'icon' => 'maximize',
                        'title' => 'Overview',
                        'route' => 'toCustomer.order.index',
                        'inRoute' => ['toCustomer.order.index','toCustomer.order.create','toCustomer.order.show'],
                    ],
                    'toCustomer.orderItem.index' => [
                        'icon' => 'align-center',
                        'title' => 'Items',
                        'route' => 'toCustomer.orderItem.index',
                        'inRoute' => ['toCustomer.orderItem.index','toCustomer.orderItem.create','toCustomer.orderItem.show'],
                    ],
                ]
            ],
            'toCustomer.patient' => [
                'icon' => 'users',
                'title' => 'Patients',
                'route' => 'toCustomer.patient.index',
                'inRoute' => [
                    'toCustomer.patient.index' => ['title'=>'Patients'],
                    'toCustomer.patient.show' => ['title'=>'Patient'],
                    'toCustomer.patient.showByDoc' => ['title'=>'Patient','titleOnly' => true]
                ],
            ],
            'toCustomer.financial' => [
                'icon' => 'dollar-sign',
                'titleOnly' => true,
                'title' => 'Financial',
                'route' => 'toCustomer.financial',
                'inRoute' => ['toCustomer.financial'],
            ],
            'devider',
            'toCustomer.settings' => [
                'icon' => 'settings',
                'titleOnly' => true,
                'title' => 'My System',
                'route' => 'toCustomer.MySystem.index',
                'inRoute' => ['toCustomer.MySystem.index','toCustomer.MySystem.show','toCustomer.MySystem.edit'],
            ],
        ];

        $menuItemsToProvider = [
            'toProvider.dashboard' => [
                'icon' => 'home',
                'titleOnly' => true,
                'title' => 'Dashboard',
                'route' => 'toProvider.dashboard',
                'inRoute' => [
                    'toProvider.dashboard'
                ],
            ],
            'toProvider.orderItem.answer' => [
                'icon' => 'pen-tool',
                'titleOnly' => true,
                'title' => 'Answer',
                'route' => 'toProvider.orderItem.answer',
                'inRoute' => [
                    'toProvider.orderItem.answer',
                    'toProvider.orderItem.report',
                    'toProvider.orderItem.report.process' => ['title'=>'Attending item','titleOnly' => true],
                    'toProvider.orderItem.report.create' => ['title'=>'Attending item','titleOnly' => true],
                ],
            ],
            'toProvider.orderItem.index' => [
                'icon' => 'layers',
                'titleOnly' => true,
                'title' => 'My Items',
                'route' => 'toProvider.orderItem.index',
                'inRoute' => [
                    'toProvider.orderItem.index',
                    'toProvider.orderItem.create',
                    'toProvider.orderItem.show'
                ],
            ],
            'toProvider.financial' => [
                'icon' => 'dollar-sign',
                'titleOnly' => true,
                'title' => 'Financial',
                'route' => 'toProvider.financial',
                'inRoute' => ['toProvider.financial'],
            ],
            'devider',
            'toProvider.settings' => [
                'icon' => 'settings',
                'titleOnly' => true,
                'title' => 'My System',
                'route' => 'toProvider.MySystem.index',
                'inRoute' => ['toProvider.MySystem.index','toProvider.MySystem.show','toProvider.MySystem.edit'],
            ],
        ];

        $profile     = false;
        $profiles    = false;
        $sideMenu    = [];
        $customerSys = false;

        // TO CUSTOMER
        if(auth()->user()->customer->count())
        {
            $profile = 'toCustomer';
            $sideMenu = $menuItemsToCustomer;
            $customerSys = auth()->user()->customer->first()->customerSys;
            $profiles['toCustomer']['side-menu'] = $menuItemsToCustomer;
            $profiles['toCustomer']['profile']  = auth()->user()->customer->first();
        }

        // TO PROVIDER
        if(auth()->user()->provider)
        {
            $profile  = 'toProvider';
            $sideMenu = $menuItemsToProvider;
            $customerSys = auth()->user()->provider->customerSys;
            $profiles['toProvider']['side-menu'] = $menuItemsToProvider;
            $profiles['toProvider']['profile']  = auth()->user()->provider;
        }

        // TO MANAGER
        if(auth()->user()->customerSys->count())
        {
            $profile = 'toManager';
            $sideMenu = $menuItemsToManager;
            $customerSys = auth()->user()->customerSys->first();
            $profiles['toManager']['side-menu'] = $menuItemsToManager;
            $profiles['toManager']['profile']  = auth()->user()->customerSys->first();
        }

        // TO ADMIN
        if(auth()->user()->id < 1000)
        {
            $profile = 'toManager';
            $sideMenu = $menuItemsToManager;
            $customerSys = auth()->user()->customerSys->first();
            //
            $profiles['toCustomer']['side-menu'] = $menuItemsToCustomer;
            $profiles['toCustomer']['profile']  = auth()->user()->customer->first();
            //
            $profiles['toProvider']['side-menu'] = $menuItemsToProvider;
            $profiles['toProvider']['profile']  = auth()->user()->provider;
            //
            $profiles['toManager']['side-menu'] = $menuItemsToManager;
            $profiles['toManager']['profile']  = auth()->user()->customerSys->first();
        }

        // PUT MANAGER
        session()->put('profile', $profile);
        session()->put('profiles', $profiles);
        session()->put('side-menu', $sideMenu);
        session()->put('customer-sys', $customerSys);

        //dd(session()->all());

        return $next($request);
    }
}
