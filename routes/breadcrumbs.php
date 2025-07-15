<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('breadcrumbs.home', route(('welcome')));
});

Breadcrumbs::for('properties', function (BreadcrumbTrail $trail, $properties) {
    $trail->parent('home');
    if ($properties->category_id !== 3) {
        $trail->push('breadcrumbs.properties', route('properties'));
    } else {
        $trail->push('breadcrumbs.lands', route('properties'));
    }
});

Breadcrumbs::for('properties.district', function (BreadcrumbTrail $trail, $properties) {
    $trail->parent('properties', $properties);

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

Breadcrumbs::for('properties.show', function (BreadcrumbTrail $trail, $properties) {
    $trail->parent('properties.city', $properties);
    $trail->push('breadcrumbs.announce');
});
