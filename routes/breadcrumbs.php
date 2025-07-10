<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route(('welcome')));
});

Breadcrumbs::for('properties', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Imóveis', route('properties'));
});

Breadcrumbs::for('properties.buy.district', function (BreadcrumbTrail $trail, $properties) {


    $trail->parent('properties');
    $trail->push('Distrito de ' . $properties->district, route('search.buy', ['query' => $properties->district]));
});

Breadcrumbs::for('properties.buy.city', function (BreadcrumbTrail $trail, $properties) {
    $trail->parent('properties.buy.district', $properties);
    $trail->push($properties->city, route('search.buy', ['query' => $properties->city]));
});

Breadcrumbs::for('search.buy', function (BreadcrumbTrail $trail, $properties) {
    $trail->parent('properties.buy.city', $properties);
    if ($properties->category_id == 1) {
        $trail->push('Comprar uma casa em ' . $properties->city, route('search.buy', ['query' => $properties->city]));
    } else if ($properties->category_id == 2) {
        $trail->push('Comprar um apartamento em ' . $properties->city, route('search.buy', ['query' => $properties->city], ['type' => 'apartment']));
    } else {
        $trail->push('Comprar um terreno em ' . $properties->city, route('search.buy', ['query' => $properties->city]));
    }
});

Breadcrumbs::for('properties.show', function (BreadcrumbTrail $trail, $properties) {
    if ($properties->transaction_id == 1) {
        $trail->parent('search.buy', $properties);
    }
    $trail->push('Anúncio', route('properties.show', $properties->slug));
});
