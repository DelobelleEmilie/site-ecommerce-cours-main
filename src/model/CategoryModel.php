<?php

#la fonction pour tout les produits
function getallCategory($db)
#la fonction query combine à la fois l'exécution de la requête et la mise en mémoire tampon du jeu de résultats
    /*query = db qui prepare la selection de l'id, le label,...
    qui provienne de la classse shop ou la cle primare est id et est défini par where*/
{
    $query = $db->prepare("SELECT id, label FROM shop_category");
#On récupères tout les résultats de la requete et stocker le resultat dans la variable product
    $query->execute();
    /* On récupères touts résultats de la requete et stocker le resultat dans la variable product et retourner le resultat*/
    return $query->fetchall();
}

function getOneCategory($db, $id)
{
    if ($id === null) {
        return null;
    }
    $query = $db->prepare("SELECT id, label FROM shop_category WHERE id=:id");
    $query->execute([
        'id' => $id
    ]);
    return $query->fetch();
}

#la fonction permet de sauvergarde product avec les données db,label,...
function saveCategory($db, $label)
{
    #la fonction query combine à la fois l'exécution de la requête et la mise en mémoire tampon du jeu de résultats
    /*query = db qui prepare l'insersertion des données dans la base shop_product*/
# value = valeur de label, descr,...
    $query = $db->prepare("INSERT INTO shop_category (label)VALUE(:label)");
    #retourne le résultat et implanter des routes pour les données
    return $query->execute([
        'label' => $label
    ]);
}

function updateOneCategory($db, $id, $label)
{
    $query = $db->prepare("UPDATE shop_category SET label=:label WHERE id=:id");
    $query->execute([
        'id' => $id,
        'label' => $label
    ]);
}

function deleteOneCategory($db, $id)
{
    $query = $db->prepare("DELETE FROM shop_category WHERE id=:id");
    $query->execute(['id' => $id]);
    if ($query->rowCount() > 0) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}