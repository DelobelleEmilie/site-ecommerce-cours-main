<?php

$routes =
    [
        // Shop
        'home' => "homeController:0,1,2",                // Liste des produits mis en avant
        'showProductByCategory' => 'showProductByCategoryController:0,1,2',
        'showProduct' => "showProductController:0,1,2",    // Fiche d'un produit
        'about' => "aboutController;0,1,2",                 // Page à propos
        'contact' => "contactController:0,1,2",            // Page de contact
        'error' => "errorController:0,1,2",                // Page d'erreur
        'mentionslegales' => "mentionslegalesController:0,1,2",   //pages mentions légales

        // Authentication
        'login' => "loginController:0,1,2",                       // Formulaire de connexion
        'register' => "registerController:0,1,2",                 // Formulaire d'inscription
        'logout' => "logoutController:0,1,2",                     // Déconnexion

        // Admin - Product
        'adminProductList' => 'AdminProductListController:2',
        'adminProductShow' => 'AdminProductShowController:2',
        'adminProductEdit' => 'AdminProductEditController:2',
        'adminProductAdd' => 'AdminProductAddController:2',
        'adminProductDelete' => 'AdminProductDeleteController:2',

        // Admin - Category
        'adminCategoryList' => 'AdminCategoryListController:2',
        'adminCategoryEdit' => 'AdminCategoryEditController:2',
        'adminCategoryAdd' => 'AdminCategoryAddController:2',
        'adminCategoryDelete' => 'AdminCategoryDeleteController:2',
        
        // Admin - User
        'adminUserList' => 'AdminUserListController:2',
        'adminUserShow' => 'AdminUserShowController:2',
        'adminUserEdit' => 'AdminUserEditController:2',
        'adminUserAdd' => 'AdminUserAddController:2',
        'adminUserDelete' => 'AdminUserDeleteController:2',
        'AdminPasswordController'=>'AdminPasswordController:2',

        //profil
        'profil' => 'ProfilController:1,2', //formulaire modification de profil


    ];

