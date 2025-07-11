<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('breadcrumbs.home', route(('welcome')));
});

Breadcrumbs::for('properties', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('breadcrumbs.properties', route('properties'));
});

Breadcrumbs::for('properties.district', function (BreadcrumbTrail $trail, $properties) {
    $trail->parent('properties');

    if ($properties->transaction_id == 1) {
        $trail->push(
            'breadcrumbs.district',
            route('search.buy', ['query' => $properties->district]),
            [
                'params' => ['district' => $properties->district],
            ]
        );
    } else {
        $trail->push(
            'breadcrumbs.district',
            route('search.rent', ['query' => $properties->district]),
            [
                'params' => ['district' => $properties->district],
            ]
        );
    }
});

Breadcrumbs::for('properties.city', function (BreadcrumbTrail $trail, $properties) {
    $trail->parent('properties.district', $properties);

    if ($properties->transaction_id == 1) {
        $trail->push($properties->city, route('search.buy', ['query' => $properties->city]));
    } else {
        $trail->push($properties->city, route('search.rent', ['query' => $properties->city]));
    }
});

Breadcrumbs::for('search', function (BreadcrumbTrail $trail, $properties) {
    $trail->parent('properties.city', $properties);

    if ($properties->transaction_id == 1) {
        if ($properties->category_id == 1) {
            $trail->push(
                'breadcrumbs.buy-house',
                route('search.buy', ['query' => $properties->city]),
                [
                    'params' => ['city' => $properties->city],
                ]
            );
        } else if ($properties->category_id == 2) {
            $trail->push(
                'breadcrumbs.buy-apart',
                route('search.buy', ['query' => $properties->city]),
                [
                    'params' => ['city' => $properties->city],
                ]
            );
        } else {
            $trail->push(
                'breadcrumbs-buy-land',
                route('search.buy', ['query' => $properties->city]),
                [
                    'params' => ['city' => $properties->city]
                ]
            );
        }
    }

    if ($properties->transaction_id == 2) {
        if ($properties->category_id == 1) {
            $trail->push(
                'breadcrumbs.rent-house',
                route('search.rent', ['query' => $properties->city]),
                [
                    'params' => ['city' => $properties->city]
                ]
            );
        } else if ($properties->category_id == 2) {
            $trail->push(
                'breadcrumbs.rent-apart',
                route('search.rent', ['query' => $properties->city]),
                [
                    'params' => ['city' => $properties->city]
                ]
            );
        } else {
            $trail->push(
                'breadcrumbs.rent-land',
                route('search.rent', ['query' => $properties->city]),
                [
                    'params' => ['city' => $properties->city]
                ]
            );
        }
    }
});

Breadcrumbs::for('properties.show', function (BreadcrumbTrail $trail, $properties) {
    $trail->parent('search', $properties);
    $trail->push('breadcrumbs.announce');
});
