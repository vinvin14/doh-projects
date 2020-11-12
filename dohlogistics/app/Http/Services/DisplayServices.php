<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 1:53 PM
 */

namespace App\Http\Services;


class DisplayServices
{
    public function display($orientation, $page, $data, $config)
    {
        switch ($orientation)
        {
            case '!inteface':
                return view('base')
                    ->with('title', $config['title'])
                    ->with('content', $page);
                break;
            case 'interface':
                return view('base')
                    ->with('title', $config['title'])
                    ->with('content',
                        view('interface/body')
                            ->with('sidebar',
                                view('interface/sidebar')
                                    ->with('sidebar', $config['sidebar'])
                                    ->with('sidebar_selected', $config['selected']))
                            ->with('navbar', view('interface/navbar'))
                            ->with('main', view(@$page)
                                ->with('data', @$data)
                                ->with('branchNav', view('library/item/branchNav')
                                    ->with('data', @$data))
                            )
                    );
                break;
            case 'interfaceWSubPage':
                return view('base')
                    ->with('title', $config['title'])
                    ->with('content',
                        view('interface/body')
                            ->with('sidebar',
                                view('interface/sidebar')
                                    ->with('sidebar', $config['sidebar'])
                                    ->with('sidebar_selected', $config['selected']))
                            ->with('navbar', view('interface/navbar'))
                            ->with('main', view(@$page)
                                            ->with('data', @$data)
                                            ->with('subPage', view(@$config['subPage'])
                                            ->with('data', @$data))

                            )
                    );
                break;
            case 'interfaceWSubPageNSubPage2':
                return view('base')
                    ->with('title', $config['title'])
                    ->with('content',
                        view('interface/body')
                            ->with('sidebar',
                                view('interface/sidebar')
                                    ->with('sidebar', $config['sidebar'])
                                    ->with('sidebar_selected', $config['selected']))
                            ->with('navbar', view('interface/navbar'))
                            ->with('main', view(@$page)
                                ->with('data', @$data)
                                ->with('subPage', view(@$config['subPage'])
                                    ->with('subPage2',
                                        @view(@$config['subPage2'])
                                            ->with('data', @$data))
                                    ->with('data', @$data))

                            )
                    );
                break;
        }
    }
}
