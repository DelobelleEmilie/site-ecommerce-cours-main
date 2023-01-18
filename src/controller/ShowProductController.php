<?php


function ShowProductController($twig,$db)
{
    #import le fichier ProductModel
    include_once '.../src/model/ProductModel.php';
    #Le produit est défini sur nulle
    $product = null;
    #La condition permet de vérifier que l'identifiant du produit est bien défini dans l'URL
    #Si il est bien défini la variable $product reçoit le resultat de la réquete SQL effectuée dans la fonction getOneProduc
    if(isset($_GET['product'])){
        $product=getOneProduct($db,$_GET['product']);
    }
#Permet d'affichier la vue Twig tout en passant la vriable $product qui contient l'ensebme de la base de données
    echo $twig->render('show_product.html.twig',[
        'product'=>$product
    ]);
};
