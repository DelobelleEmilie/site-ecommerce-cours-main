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
        'Adminaddproduct' => "AdminaddproductController",   // Formulaire d'ajout de produit

        // Admin - Category
        'AdminaddCategory' => "AdminaddCategoryController", // Formaulaire d'ajout de catégorie

        'productCategories' => "ProductCategoriesController",
        'adminProduct' => "AdminProductController",
        'admin' => "adminProductController"
    ];

