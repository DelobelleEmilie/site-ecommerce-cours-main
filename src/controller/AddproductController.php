<?php
#implante le fichier ProductModel
include_once '../src/model/ProductModel.php';
include_once '../src/model/CategoryModel.php';
include_once '../src/service/upload.php';



#Si on saisis le formulaire $_POST contient les données ducoup les produit s'enregistre et raffiche le formulaire vide
function addProductController($twig, $db)
{
    $categories = getallCategory($db);

    #défaut défini à «null»
    $file_name = null;

    #Une variable «$form» est créée et définie en tant que tableau vide «[]»
    $form = [];

    if (!empty($_POST)) {

        $label = htmlspecialchars($_POST['productLabel']);
        $description = htmlspecialchars($_POST['productDescription']);
        $price = htmlspecialchars($_POST['productPrice']);
        if (empty($price)) {
            $price = 0.00;
        }
        $category = htmlspecialchars($_POST['productCategory']);
        ##vérifie qu’une image est bien envoyée

        $file_path = null;

        if (isset($_FILES["productImage"])) {
            $file_path = upload($_FILES["productImage"]);
            var_dump($file_path);
        }

        var_dump($label, $description, $category);

        if (!empty($label) && !empty($description) && !empty($category)) {
            {
                #la variable «$form» se constitue d’une clé «state» pour définir l’état du formulaire.
                #Le tableau est aussi constitué d’une clé «message» danslaquelle nous renseignerons un message personnalisé pour informer l’utilisateur
                $form = [
                    'state' => 'danger',
                    'message' => [$msg]

                ];
                saveProduct($db, $label, $description, $price, $category, $file_path);

                #la variable «$form» est complétéeavec des informations que nous pourrons réutiliser dans la vue Twig.
                echo $twig->render('form_addproduct.html.twig', [
                    #la variable «$form» est passée à la vue Twig sous le nom «form»
                    'form' => $form,
                    'page' => "?page=addProduct"
                ]);
#sinon le produit est sauvergardée
            }
        } else {

            if (empty($label) || empty($description) || empty($category)) {
                $form = [
                    'state' => "success",
                    'message' => "Votre produit a bien était ajoute"
                ];
                echo $twig->render('form_addproduct.html.twig', [
                    'form' => $form
                ]);
            }
        }
    }
    else {
        echo $twig->render('form_addproduct.html.twig', [
            'form' => $form,
            'controller' => 'add',
            'categories' => $categories
        ]);
    }
    #ajout de la condition pour verifier si le formulaire de suppression a été soumis
    if (isset($_POST['btnDeleteProduct'])) {
        #récupération de l'ID du produit à supprimer
        $id = htmlspecialchars($_POST['productId']);
        #utilisation de la fonction appropriée pour supprimer le produit de la base de données
        deleteProduct($db, $id);
        #redirection vers la liste des produits pour afficher la mise à jour
        header("Location: index.php?page=showList");
        exit;
    }

}
