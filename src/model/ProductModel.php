<?php


#la fonction pour tout les produits
function getallProduct($db)
#la fonction query combine à la fois l'exécution de la requête et la mise en mémoire tampon du jeu de résultats
/*query = db qui prepare la selection de l'id, le label,...
qui provienne de la classse shop ou la cle primare est id et est défini par where*/
{
    $query = $db->prepare("SELECT id, label, `description`, price, idCategory,image  FROM shop_product");
#On récupères tout les résultats de la requete et stocker le resultat dans la variable product
    $query->execute();
/* On récupères touts résultats de la requete et stocker le resultat dans la variable product et retourner le resultat*/
return $query->fetchall();
}

#la fonction permet de sauvergarde product avec les données db,label,...
function saveProduct($db, $label, $description, $price, $category) 
{
    #la fonction query combine à la fois l'exécution de la requête et la mise en mémoire tampon du jeu de résultats
/*query = db qui prepare l'insersertion des données dans la base shop_product*/
# value = valeur de label, descr,...
    $query = $db->prepare("INSERT INTO shop_product (label, 'description', price, idCategory,image)VALUE(:label, :descr, :price, :idCategory,:image )");
   #retourne le résultat et implanter des routes pour les données
    return $query->execute([
        'label' => $label,
        'descr' => $description,
        'price' => $price,
        'category' => $category,
        'image' => $image
    ]);

    function updateOneProduct($db,$id,$label,$description,$price,$category)
    {
        # mettre à jour une la base de donnée
        $query = $db->prepare("UPDATE shop_product SET label=:label, `description`=:desc,price=:price,idCategory=:$category WHERE id=:id");
        return $query->execute([
            #La requête est constituée de valeurs dynamiques. Ces valeurs seront remplacées par les variables que nous lui passerons en paramètre
            'id'=> $id,
            'label' => $label,
            'descr' => $description,
            'price' => $price,
            'category' => $category,
        ]);
    }
}

function deleteOneProduct($db, $id)
{$query = $db->prepare("DELETE FROM shopcourse_products WHERE id=:id");
    $query->execute(['id' => $id]);
    if ($query->rowCount() > 0)
    {
        $result = true;
    }
    else
    {$result = false;
    }
    return $result;}