<?php

$routes =
    [
        // Shop
        'home' => "homeController",                         // Liste des produits mis en avant
        'showProductByCategory' => 'showProductByCategoryController',
        'showProduct' => "showProductController",           // Fiche d'un produit
        'about' => "aboutController",                       // Page à propos
        'contact' => "contactController",                   // Page de contact
        'error' => "errorController",                       // Page d'erreur
        'mentionslegales' => "mentionslegalesController",   // Page des mentions légales

        // Authentication
        'login' => "loginController",                       // Formulaire de connexion
        'register' => "registerController",                 // Formulaire d'inscription
        'logout' => "logoutController",                     // Déconnexion

        // Admin - Product
        'adminProductList' => 'AdminProductListController',
        'adminProductShow' => 'AdminProductShowController',
        'adminProductEdit' => 'AdminProductEditController',
        'adminProductAdd' => 'AdminProductAddController',
        'adminProductDelete' => 'AdminProductDeleteController',

        // Admin - Category
        'adminCategoryList' => 'AdminCategoryListController',
        'adminCategoryEdit' => 'AdminCategoryEditController',
        'adminCategoryAdd' => 'AdminCategoryAddController',
        'adminCategoryDelete' => 'AdminCategoryDeleteController',
        
        // Admin - User
        'adminUserList' => 'AdminUserListController',
        'adminUserShow' => 'AdminUserShowController',
        'adminUserEdit' => 'AdminUserEditController',
        'adminUserAdd' => 'AdminUserAddController',
        'adminUserDelete' => 'AdminUserDeleteController'
    ];

