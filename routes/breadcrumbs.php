<?php

// rutas utilizadas para mostrar los breadcrumbs

// Dashboard
Breadcrumbs::for('admin', function ($trail) {
    $trail->push('Inicio', url('admin'));
});

// Dashboard > Usuarios
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('admin');
    $trail->push('Usuarios', url('users'));
});

// Dashboard > Usuarios
Breadcrumbs::for('users.show', function ($trail) {
    $trail->parent('users');
    $trail->push('Ver', route('users.show'));
});

// Home > Blog > [Category]
Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category->id));
});

// Home > Blog > [Category] > [Post]
Breadcrumbs::for('post', function ($trail, $post) {
    $trail->parent('category', $post->category);
    $trail->push($post->title, route('post', $post->id));
});
