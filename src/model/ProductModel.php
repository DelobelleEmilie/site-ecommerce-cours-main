<?php


#la fonction pour tout les produits
function getallProduct($db)
#la fonction query combine à la fois l'exécution de la requête et la mise en mémoire tampon du jeu de résultats
/* query = db qui prepare la selection de l'id, le label,...
qui provienne de la classse shop ou la cle primare est id et est défini par where */
{
    $query = $db->prepare("SELECT id, label, `description`, price, idCategory   FROM shop_product");
#On récupères tout les résultats de la requete et stocker le resultat dans la variable product
    $query->execute();
/* On récupères touts résultats de la requete et stocker le resultat dans la variable product et retourner le resultat*/
return $query->fetchall();
}

function getAllProductByCategory($db, $categoryId)
{
    if ($categoryId === null) { return getallProduct($db); }
    $query = $db->prepare("SELECT id, label, `description`, price, idCategory, image  FROM shop_product WHERE idCategory = :idCategory");
    $query->execute([
        'idCategory' => $categoryId
    ]);
    return $query->fetchAll();
}

function getOneProduct($db, $id)
#la fonction query combine à la fois l'exécution de la requête et la mise en mémoire tampon du jeu de résultats
    /*query = db qui prepare la selection de l'id, le label,...
    qui provienne de la classse shop ou la cle primare est id et est défini par where*/
{
    $query = $db->prepare("SELECT id, label, `description`, price, idCategory, image FROM shop_product WHERE id = :id");
#On récupères tout les résultats de la requete et stocker le resultat dans la variable product
    $query->execute([':id' => $id]);
    /* On récupères touts résultats de la requete et stocker le resultat dans la variable product et retourner le resultat*/
    return $query->fetch();
}

#la fonction permet de sauvergarde product avec les données db,label,...
function saveProduct($db, $label, $description, $price, $category, $image)
{
    #la fonction query combine à la fois l'exécution de la requête et la mise en mémoire tampon du jeu de résultats
/*query = db qui prepare l'insersertion des données dans la base shop_product*/
# value = valeur de label, descr,...
    $query = $db->prepare("INSERT INTO shop_product (label, description, price, idCategory, image) VALUES (:label, :descr, :price, :idCategory, :image )");
   #retourne le résultat et implanter des routes pour les données

    return $query->execute([
        'label' => $label,
        'descr' => $description,
        'price' => $price,
        'idCategory' => $category,
        'image' => $image
    ]);
}

function updateOneProduct($db, $id, $label, $description, $price, $category, $file_path)
{
    # mettre à jour une la base de donnée
    $query = $db->prepare("UPDATE shop_product SET label=:label, description=:desc,price=:price,idCategory=:category,image=:image WHERE id=:id");
    return $query->execute([
        #La requête est constituée de valeurs dynamiques. Ces valeurs seront remplacées par les variables que nous lui passerons en paramètre
        'id'=> $id,
        'label' => $label,
        'desc' => $description,
        'price' => $price,
        'category' => $category,
        'image' => $file_path
    ]);
}

function deleteOneProduct($db, $id)
{
    $query = $db->prepare("DELETE FROM shop_product WHERE id=:id");
    $query->execute(['id' => $id]);
    if ($query->rowCount() > 0)
    {
        $result = true;
    }
    else
    {$result = false;
    }
    return $result;}